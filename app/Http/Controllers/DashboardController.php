<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\User;
use App\Models\JenisKlaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // Ambil semua jenis klaim
    $klaimStats = \App\Models\JenisKlaim::withCount('nasabah')->get(['id', 'nama_klaim']);

    if (in_array($user->role, ['admin', 'super_admin'])) {
        $totalNasabah = \App\Models\Nasabah::count();
        $totalPetugas = \App\Models\User::where('role', 'petugas')->count();
        $recentNasabah = \App\Models\Nasabah::with(['petugas', 'jenisKlaim'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
        $monthlyStats = \App\Models\Nasabah::select(
            DB::raw("DATE_FORMAT(tanggal_masuk, '%Y-%m') as bulan"),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('bulan')
        ->orderByDesc('bulan')
        ->limit(6)
        ->get();

        return view('dashboard', compact(
            'totalNasabah', 'totalPetugas', 'klaimStats', 'recentNasabah', 'monthlyStats', 'user'
        ));
    } else { // petugas
        $myTasks = \App\Models\Nasabah::where('petugas_id', $user->id)
            ->with('jenisKlaim', 'petugas')
            ->orderByDesc('created_at')
            ->get();

        $totalTasks = $myTasks->count();
        $completedTasks = $myTasks->where('is_checked', true)->count();
        $pendingTasks = $totalTasks - $completedTasks;
        $lastWorkedAt = $myTasks->whereNotNull('tanggal_dikerjakan')->sortByDesc('tanggal_dikerjakan')->first()?->tanggal_dikerjakan;

        // Statistik untuk petugas
        $totalNasabah = $myTasks->count();
        $recentNasabah = $myTasks->sortByDesc('created_at')->take(10);

        return view('dashboard', compact(
            'myTasks', 'totalTasks', 'completedTasks', 'pendingTasks', 'lastWorkedAt',
            'totalNasabah', 'klaimStats', 'recentNasabah', 'user'
        ));
    }
}

}
