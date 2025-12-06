<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\User;
use App\Models\JenisKlaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NasabahController extends Controller
{
    /**
     * Tampilkan daftar nasabah dengan filter.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Nasabah::class);
        $user = auth()->user();

        // Query dasar
        $query = Nasabah::with(['petugas', 'jenisKlaim']);

        // Jika user adalah petugas, tampilkan hanya data miliknya
        if ($user->role === 'petugas') {
            $query->where('petugas_id', $user->id);
        }

        // Filter nama
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // Filter nomor Taspen
        if ($request->filled('no_taspen')) {
            $query->where('no_taspen', 'like', '%' . $request->no_taspen . '%');
        }

        // Filter jenis klaim
        if ($request->filled('jenis_klaim_id')) {
            $query->where('jenis_klaim_id', $request->jenis_klaim_id);
        }

        // Filter bulan dan tahun masuk (format input: YYYY-MM)
        if ($request->filled('bulan_masuk')) {
            $bulan = $request->bulan_masuk;
            $query->whereRaw("DATE_FORMAT(tanggal_masuk, '%Y-%m') = ?", [$bulan]);
        }

        // Filter status
        if ($request->filled('status')) {
            if ($request->status === 'selesai') {
                $query->where('is_checked', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_checked', false);
            }
        }

        // Filter khusus admin: berdasarkan petugas
        if ($user->role === 'admin' && $request->filled('petugas_id')) {
            $query->where('petugas_id', $request->petugas_id);
        }

        // Pagination
        $nasabah = $query->orderBy('tanggal_masuk', 'desc')->paginate(15);

        // Data untuk dropdown filter
        $jenisKlaimList = JenisKlaim::select('id', 'nama_klaim')->get();
        $bulanList = Nasabah::selectRaw("DATE_FORMAT(tanggal_masuk, '%Y-%m') as bulan")
            ->distinct()
            ->orderBy('bulan', 'desc')
            ->pluck('bulan');
        $petugas = User::where('role', 'petugas')->get();

        return view('nasabah.index', compact('nasabah', 'jenisKlaimList', 'bulanList', 'petugas'));
    }

    /**
     * Tampilkan form tambah nasabah.
     */
    public function create()
    {
        $this->authorize('create', Nasabah::class);

        $petugas = User::where('role', 'petugas')->get();
        $jenisKlaim = JenisKlaim::all();

        return view('nasabah.create', compact('petugas', 'jenisKlaim'));
    }

    /**
     * Simpan data nasabah baru.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Nasabah::class);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_klaim_id' => 'required|exists:jenis_klaim,id',
            'no_taspen' => 'required|string|unique:nasabah,no_taspen',
            'tanggal_masuk' => 'required|date',
            'tanggal_dikerjakan' => 'nullable|date|after_or_equal:tanggal_masuk',
            'petugas_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Set status otomatis
        $validated['is_checked'] = !empty($validated['tanggal_dikerjakan']);
        $validated['checked_at'] = $validated['is_checked'] ? now() : null;

        Nasabah::create($validated);

        return redirect()->route('nasabah.index')
            ->with('success', 'Data nasabah berhasil ditambahkan.');
    }


    /**
     * Tampilkan form edit nasabah.
     */
    public function edit(Nasabah $nasabah)
    {
        $this->authorize('update', $nasabah);

        $petugas = User::where('role', 'petugas')->get();
        $jenisKlaim = JenisKlaim::all();

        return view('nasabah.edit', compact('nasabah', 'petugas', 'jenisKlaim'));
    }

    /**
     * Update data nasabah.
     */
    public function update(Request $request, Nasabah $nasabah)
    {
        $this->authorize('update', $nasabah);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_klaim_id' => 'required|exists:jenis_klaim,id',
            'no_taspen' => 'required|string|unique:nasabah,no_taspen,' . $nasabah->id,
            'tanggal_masuk' => 'required|date',
            'tanggal_dikerjakan' => 'nullable|date|after_or_equal:tanggal_masuk',
            'petugas_id' => 'nullable|exists:users,id',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $validated['is_checked'] = !empty($validated['tanggal_dikerjakan']);
        $validated['checked_at'] = $validated['is_checked'] ? now() : null;

        $nasabah->update($validated);

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil diperbarui.');
    }

    /**
     * Hapus data nasabah.
     */
    public function destroy(Nasabah $nasabah)
    {
        $this->authorize('delete', $nasabah);

        $nasabah->delete();

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil dihapus.');
    }

    /**
     * Ubah status (selesai/belum).
     */
    public function toggleStatus(Request $request, $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $this->authorize('checklist', $nasabah);
        $statusBaru = $request->input('status');

        // Jika selesai → isi tanggal_dikerjakan dengan waktu sekarang
        if ($statusBaru === 'selesai') {
            $nasabah->keterangan = 'selesai';
            $nasabah->is_checked = true;
            $nasabah->tanggal_dikerjakan = now();
            $nasabah->checked_at = now();
        } else {
            $nasabah->keterangan = 'belum dikerjakan';
            $nasabah->is_checked = false;
            $nasabah->tanggal_dikerjakan = null;
            $nasabah->checked_at = null;
        }

        $nasabah->save();

        return response()->json([
            'success' => true,
            'status' => $nasabah->keterangan,
            'tanggal_dikerjakan' => $nasabah->tanggal_dikerjakan ? $nasabah->tanggal_dikerjakan->format('d-m-Y H:i') : null,
        ]);
    }


    /**
     * Update status manual dari form.
     */
    public function updateStatus(Request $request, $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $this->authorize('checklist', $nasabah);
        $nasabah->keterangan = $request->keterangan;
        $nasabah->tanggal_dikerjakan = $request->keterangan === 'selesai' ? now() : null;
        $nasabah->is_checked = $request->keterangan === 'selesai';
        $nasabah->checked_at = $request->keterangan === 'selesai' ? now() : null;
        $nasabah->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Download data nasabah (CSV).
     */
    public function download(Request $request)
    {
        $user = auth()->user();

        $query = Nasabah::with(['petugas', 'jenisKlaim']);

        if ($user->role === 'petugas') {
            $query->where('petugas_id', $user->id);
        }

        if ($request->filled('bulan')) {
            $query->whereRaw("DATE_FORMAT(tanggal_masuk, '%Y-%m') = ?", [$request->bulan]);
        }

        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->filled('jenis_klaim_id')) {
            $query->where('jenis_klaim_id', $request->jenis_klaim_id);
        }

        if ($request->filled('no_taspen')) {
            $query->where('no_taspen', 'like', '%' . $request->no_taspen . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'selesai') {
                $query->where('is_checked', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_checked', false);
            }
        }

        $nasabah = $query->orderBy('tanggal_masuk', 'desc')->get();

        return new StreamedResponse(function () use ($nasabah) {
            $handle = fopen('php://output', 'w');

            // Tambahkan BOM UTF-8 agar Excel bisa membaca karakter dengan benar
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header CSV
            fputcsv($handle, ['No', 'Nama', 'No Taspen', 'Jenis Klaim', 'Tanggal Masuk', 'Tanggal Dikerjakan', 'Petugas', 'Keterangan', 'Status']);

            $no = 1;
            foreach ($nasabah as $n) {
                fputcsv($handle, [
                    $no++,
                    $n->nama,
                    $n->no_taspen,
                    $n->jenisKlaim->nama_klaim ?? '-',
                    $n->tanggal_masuk,
                    $n->tanggal_dikerjakan ?? '-',
                    $n->petugas->name ?? '-',
                    $n->keterangan ?? '-',
                    $n->is_checked ? 'Selesai' : 'Pending'
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Data_Nasabah_' . date('Y-m-d') . '.csv"',
        ]);
    }
}
