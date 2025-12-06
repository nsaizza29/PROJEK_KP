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
        white-space: normal;
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

    /* Transparent outline button */
    .btn-outline-primary-custom {
        border: 1px solid #0d6efd !important;
        background: transparent !important;
        color: #0d6efd !important;
        padding: 6px 14px !important;
        border-radius: 50px !important;
        font-size: .85rem;
        transition: .25s;
    }
    .btn-outline-primary-custom:hover {
        background: #0d6efd !important;
        color: white !important;
    }
</style>


<div class="row">
    <div class="col-12">

        <div class="card mb-5 border-0 shadow-sm rounded-4">

            {{-- HEADER --}}
            <div class="card-header-custom bg-white d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0">Data Jenis Klaim</h5>

                @if(auth()->user()->role === 'admin')
                  <a href="{{ route('jenis-klaim.create') }}" class="btn btn-primary btn-sm px-3 rounded-pill">
                    + Tambah
                  </a>
                @endif
            </div>

            {{-- BODY --}}
            <div class="card-body">

                <div class="table-wrapper">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 60px">No</th>
                                    <th>Nama Jenis Klaim</th>
                                    <th>Keterangan</th>
                                    <th style="width: 80px">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($jenisKlaim as $i => $jk)
                                <tr>
                                    <td>{{ $jenisKlaim->firstItem() + $i }}</td>
                                    <td>{{ $jk->nama_klaim }}</td>
                                    <td>{{ $jk->keterangan }}</td>

                                    <td>
                                        {{-- EDIT --}}
                                        <a href="{{ route('jenis-klaim.edit', $jk->id) }}"
                                            class="text-primary action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('jenis-klaim.destroy', $jk->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf @method('DELETE')

                                            <button class="text-danger action-btn bg-transparent border-0"
                                                onclick="return confirm('Hapus data ini?')" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-muted">Belum ada data</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-3">
                    {{ $jenisKlaim->links() }}
                </div>

            </div>
        </div>

    </div>
</div>

@endsection


@push('js')
<script>
$(document).ready(function() {
  $('#jenisKlaimTable').DataTable({
    paging: false,
    info: false,
    ordering: true,
    searching: true,
    responsive: true,
    language: { search: "Cari:" },
    dom: 'ft',
    columnDefs: [
      { orderable: false, targets: [3] }
    ]
  });
});
</script>
@endpush
