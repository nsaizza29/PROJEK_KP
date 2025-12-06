@extends('layouts.user_type.auth')

@section('content')

<style>
    /* --- GLOBAL TABLE STYLE --- */
    .table-wrapper {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0px 4px 14px rgba(0,0,0,0.06);
    }

    table thead {
        background: #f8f9fc !important;
        font-weight: 600;
        font-size: .85rem;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    tbody tr:hover {
        background: #f7faff !important;
    }

    table td, table th {
        text-align: center !important;
        vertical-align: middle !important;
        padding: 10px 8px !important;
        font-size: .82rem;
    }

    /* Status Badge */
    .badge-soft {
        padding: 4px 10px;
        border-radius: 50px;
        font-size: .7rem;
        font-weight: 600;
    }

    /* Action buttons */
    .action-btn {
        font-size: 1rem;
        padding: 4px 6px;
        transition: .2s;
    }
    .action-btn:hover {
        transform: scale(1.15);
    }

    /* Card Header */
    .card-header-custom {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f1f1;
    }

    /* Button Filter Icon */
    .btn-filter-icon {
        border: 1px solid #0d6efd;
        background: transparent;
        color: #0d6efd;
        padding: 6px 10px;
        border-radius: 50px;
        transition: .2s;
    }
    .btn-filter-icon:hover {
        background: #0d6efd;
        color: white;
    }

</style>


<div class="row">
  <div class="col-12">
    <div class="card mb-5 border-0 shadow-sm rounded-4">

      {{-- HEADER --}}
      <div class="card-header-custom d-flex justify-content-between align-items-center bg-white">
        <h5 class="fw-bold m-0">Data Nasabah</h5>

        <div class="d-flex gap-2">
          @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
            <a href="{{ route('nasabah.create') }}" class="btn btn-primary btn-sm px-3 rounded-pill">
              + Tambah
            </a>
          @endif

          <a href="{{ route('nasabah.download', request()->query()) }}" class="btn btn-success btn-sm px-3 rounded-pill">
            <i class="fas fa-download me-1"></i> CSV
          </a>
        </div>
      </div>

      {{-- FILTER FORM --}}
      <div class="card-body pb-0">
        <form action="{{ route('nasabah.index') }}" method="GET" class="row g-3" id="filterForm">

          <div class="col-md-3">
            <label class="form-label small">Nama / No Taspen</label>
            <input type="text" name="nama_notaspen" class="form-control form-control-sm"
              value="{{ request('nama_notaspen') }}" placeholder="Cari...">
          </div>

          <div class="col-md-3">
            <label class="form-label small">Jenis Klaim</label>
            <select name="jenis_klaim_id" class="form-control form-control-sm">
              <option value="">-- Semua --</option>
              @foreach($jenisKlaimList as $jenis)
                <option value="{{ $jenis->id }}" {{ request('jenis_klaim_id') == $jenis->id ? 'selected' : '' }}>
                  {{ $jenis->nama_klaim }}
                </option>
              @endforeach
            </select>
          </div>

          @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
          <div class="col-md-3">
            <label class="form-label small">Petugas</label>
            <select name="petugas_id" class="form-control form-control-sm">
              <option value="">-- Semua --</option>
              @foreach($petugas as $p)
                <option value="{{ $p->id }}" {{ request('petugas_id') == $p->id ? 'selected' : '' }}>
                  {{ $p->name }}
                </option>
              @endforeach
            </select>
          </div>
          @endif

          <div class="col-md-2">
            <label class="form-label small">Bulan & Tahun</label>
            <input type="month" name="bulan_tahun" class="form-control form-control-sm"
              value="{{ request('bulan_tahun') }}">
          </div>

          <div class="col-md-1">
              <label class="form-label small d-block">&nbsp;</label>
              <button class="btn btn-filter-icon w-100" title="Filter">
                  <i class="fas fa-filter"></i>
              </button>
          </div>



        </form>
      </div>

      {{-- TABLE --}}
      <div class="card-body mt-0">

        <div class="table-wrapper">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No Taspen</th>
                  <th>Jenis Klaim</th>
                  <th>Tgl Masuk</th>
                  <th>Tgl Dikerjakan</th>
                  <th>Petugas</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($nasabah as $i => $n)
                <tr id="row-{{ $n->id }}">

                  <td>{{ $nasabah->firstItem() + $i }}</td>
                  <td>{{ $n->nama }}</td>
                  <td>{{ $n->no_taspen }}</td>
                  <td>{{ $n->jenisKlaim->nama_klaim ?? '-' }}</td>
                  <td>{{ $n->tanggal_masuk ? $n->tanggal_masuk->format('d-m-Y') : '-' }}</td>
                  <td class="col-tanggal-dikerjakan">
                    {{ $n->tanggal_dikerjakan ? $n->tanggal_dikerjakan->format('d-m-Y') : '-' }}
                  </td>
                  <td>{{ $n->petugas->name ?? '-' }}</td>

                  {{-- STATUS TOGGLE --}}
                  <td>
                    <button class="btn btn-sm btn-status p-0" data-id="{{ $n->id }}" data-status="{{ $n->keterangan }}">
                      @if($n->keterangan === 'selesai')
                        <span class="badge-soft bg-success bg-opacity-10 text-success">Selesai</span>
                      @else
                        <span class="badge-soft bg-warning bg-opacity-10 text-warning">Proses</span>
                      @endif
                    </button>
                  </td>

                  {{-- ACTION --}}
                  <td>
                    <a href="{{ route('nasabah.edit', $n->id) }}" class="text-primary action-btn" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('nasabah.destroy', $n->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button class="text-danger action-btn bg-transparent border-0" title="Hapus"
                        onclick="return confirm('Hapus data ini?')">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>

                </tr>
                @empty

                <tr>
                  <td colspan="9" class="py-4 text-muted">Belum ada data</td>
                </tr>

                @endforelse
              </tbody>

            </table>
          </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
          {{ $nasabah->appends(request()->query())->links() }}
        </div>

      </div>

    </div>
  </div>
</div>


{{-- STATUS TOGGLE SCRIPT --}}
@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.btn-status').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      let id = this.dataset.id;
      let current = this.dataset.status;
      let newStatus = current === 'selesai' ? 'belum dikerjakan' : 'selesai';

      fetch("{{ url('/nasabah') }}/" + id + "/toggle-status", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ status: newStatus })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.dataset.status = data.status;

          this.innerHTML =
            data.status === 'selesai'
              ? '<span class="badge-soft bg-success bg-opacity-10 text-success">Selesai</span>'
              : '<span class="badge-soft bg-warning bg-opacity-10 text-warning">Proses</span>';

          document.querySelector(`#row-${id} .col-tanggal-dikerjakan`).textContent =
            data.tanggal_dikerjakan ?? '-';
        }
      });
    });
  });
});
</script>
@endpush

@endsection
