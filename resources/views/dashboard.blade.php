@extends('layouts.user_type.auth')

@section('content')

<style>
    /* Card Modern Style */
    .card-header { padding-bottom: 5px !important; }
    .stat-card {
        border: none;
        border-radius: 20px;
        transition: .25s ease;
        background: linear-gradient(145deg, #ffffff, #f4f4f4);
        box-shadow: 4px 4px 15px rgba(0,0,0,0.05), -4px -4px 15px rgba(255,255,255,0.6);
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 6px 6px 18px rgba(0,0,0,0.08);
    }
    .badge-soft {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: .7rem;
        font-weight: 600;
    }
    table thead { background: #f8f9fc !important; font-size: .9rem; letter-spacing: .5px; }
    table tbody tr { transition: 0.2s; }
    table tbody tr:hover { background: #f7faff; }
    .table td { padding: 12px 10px !important; font-size: .8rem; }
    .section-title { font-weight: 700; font-size: .95rem; letter-spacing: .3px; color: #333; }
</style>

@php
    $role = $user->role;
@endphp

{{-- STAT CARDS --}}
@php
    // Statistik untuk semua role
    $totalTasksDone = $role === 'petugas'
        ? \App\Models\Nasabah::where('petugas_id', $user->id)->where('is_checked', true)->count()
        : \App\Models\Nasabah::where('is_checked', true)->count();

    $cards = [
        ['title' => 'Total Nasabah', 'value' => $totalNasabah ?? 0, 'color' => 'success'],
        ['title' => 'Total Jenis Klaim', 'value' => $klaimStats->count() ?? 0, 'color' => 'info'],
        ['title' => 'Tugas Selesai', 'value' => $totalTasksDone, 'color' => 'primary'],
    ];

    if(in_array($role, ['admin','super_admin'])){
        $cards[] = ['title'=>'Total Petugas','value'=>$totalPetugas ?? 0,'color'=>'warning'];
    }
@endphp

<div class="row g-4 mb-5">
    @foreach($cards as $c)
        <div class="col-md-3">
            <div class="card stat-card p-3">
                <div class="small text-muted text-uppercase fw-semibold">{{ $c['title'] }}</div>
                <div class="d-flex align-items-center mt-2">
                    <h2 class="fw-bold text-dark mb-0" style="font-size: 1.5rem;">{{ $c['value'] }}</h2>
                    <span class="badge-soft ms-auto bg-{{ $c['color'] }} bg-opacity-10 text-{{ $c['color'] }}">
                        {{ $c['title'] }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- STATISTIK --}}
<div class="row mt-4">
    {{-- Statistik Per Jenis Klaim --}}
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0">
                <h3 class="section-title">Statistik Per Jenis Klaim</h3>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>Jenis Klaim</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($klaimStats as $stat)
                            <tr>
                                <td class="fw-semibold">{{ $stat->nama_klaim }}</td>
                                <td class="text-center">
                                    <span class="badge-soft bg-info bg-opacity-10 text-info">
                                        {{ $stat->nasabah_count }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-3">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik Per Bulan --}}
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0">
                <h3 class="section-title">Statistik Per Bulan</h3>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($monthlyStats ?? [] as $stat)
                                <tr>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $stat->bulan)->translatedFormat('F Y') }}</td>
                                    <td class="text-center">{{ $stat->total ?? 0 }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-3">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Data Nasabah Terbaru --}}
<div class="card rounded-4 shadow-sm mt-5 border-0">
    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h3 class="section-title mb-0">Data Nasabah Terbaru</h3>
        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-4">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 text-center">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No Taspen</th>
                    <th>Jenis Klaim</th>
                    <th>Bulan Masuk</th>
                    <th>Petugas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentNasabah as $n)
                    <tr>
                        <td>{{ $n->nama }}</td>
                        <td>{{ $n->no_taspen }}</td>
                        <td>{{ $n->jenisKlaim->nama_klaim ?? '-' }}</td>
                        <td>{{ $n->tanggal_masuk }}</td>
                        <td>{{ $n->petugas->name ?? '-' }}</td>
                        <td>
                            @if($n->is_checked)
                                <span class="badge-soft bg-success bg-opacity-10 text-success">Selesai</span>
                            @else
                                <span class="badge-soft bg-warning bg-opacity-10 text-warning">Proses</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
