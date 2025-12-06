<?php

namespace App\Http\Controllers;

use App\Models\JenisKlaim;
use Illuminate\Http\Request;

class JenisKlaimController extends Controller
{
    /**
     * Tampilkan daftar semua jenis klaim.
     */
    public function index()
    {
        $this->authorize('viewAny', JenisKlaim::class);
        $jenisKlaim = JenisKlaim::orderBy('created_at', 'desc')->paginate(10);
        return view('jenis_klaim.index', compact('jenisKlaim'));
    }

    /**
     * Tampilkan form untuk menambah jenis klaim baru.
     */
    public function create()
    {
        $this->authorize('create', JenisKlaim::class);
        return view('jenis_klaim.create');
    }

    /**
     * Simpan data jenis klaim baru ke database.
     */
    public function store(Request $request)
    {
        $this->authorize('create', JenisKlaim::class);
        $validated = $request->validate([
            'nama_klaim' => 'required|string|max:255|unique:jenis_klaim,nama_klaim',
            'keterangan' => 'nullable|string|max:500',
        ]);

        JenisKlaim::create($validated);

        return redirect()->route('jenis-klaim.index')
            ->with('success', 'Jenis klaim berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit data jenis klaim.
     */
    public function edit(JenisKlaim $jenisKlaim)
    {
        $this->authorize('update', $jenisKlaim);
        return view('jenis_klaim.edit', compact('jenisKlaim'));
    }

    /**
     * Update data jenis klaim yang dipilih.
     */
    public function update(Request $request, JenisKlaim $jenisKlaim)
    {
        $this->authorize('update', $jenisKlaim);
        $validated = $request->validate([
            'nama_klaim' => 'required|string|max:255|unique:jenis_klaim,nama_klaim,' . $jenisKlaim->id,
            'keterangan' => 'nullable|string|max:500',
        ]);

        $jenisKlaim->update($validated);

        return redirect()->route('jenis-klaim.index')
            ->with('success', 'Jenis klaim berhasil diperbarui.');
    }

    /**
     * Hapus data jenis klaim.
     */
    public function destroy(JenisKlaim $jenisKlaim)
    {
        $this->authorize('delete', $jenisKlaim);
        $jenisKlaim->delete();

        return redirect()->route('jenis-klaim.index')
            ->with('success', 'Jenis klaim berhasil dihapus.');
    }
}
