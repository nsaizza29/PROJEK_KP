@extends('layouts.user_type.auth')

@section('content')

<style>
    /* Global Table Wrapper */
    .table-wrapper {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0px 4px 14px rgba(0,0,0,0.06);
    }

    /* Table Header */
    table thead {
        background: #f8f9fc !important;
        font-weight: 600 !important;
        font-size: .82rem;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    /* Table Cells */
    table td, table th {
        text-align: center !important;
        vertical-align: middle !important;
        padding: 10px 8px !important;
        font-size: .82rem;
    }

    /* Hover */
    tbody tr:hover {
        background: #f7faff !important;
    }

    /* Action Icon Buttons */
    .action-btn {
        font-size: 1rem;
        padding: 4px 6px;
        transition: .2s;
    }
    .action-btn:hover {
        transform: scale(1.15);
    }

    /* Transparent Outline Button */
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

    /* Card Header */
    .card-header-custom {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f1f1;
        background: white;
    }

    /* Badge Role */
    .role-badge {
        padding: 6px 14px;
        font-size: .7rem;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }
</style>


<div class="row">
    <div class="col-12">

        <div class="card border-0 shadow-sm rounded-4 mb-5">

            {{-- HEADER --}}
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0">Data User</h5>

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm px-3 rounded-pill">
              + Tambah
            </a>
                </a>
                @endif
            </div>

            {{-- BODY --}}
            <div class="card-body">

                {{-- Pending Users --}}
                @if(isset($pendingUsers) && count($pendingUsers) > 0)
                <div class="alert alert-warning rounded-3">
                    <strong>Ada user yang menunggu persetujuan:</strong>
                </div>

                <div class="table-wrapper mb-4">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <form action="{{ route('users.approve', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm px-3 rounded-pill">
                                            Approve
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                {{-- Main Table --}}
                <div class="table-wrapper">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="userTable">
                            <thead>
                                <tr>
                                    <th style="width: 50px">No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th style="width: 80px">Role</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($users as $i => $user)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->nip ?? '-' }}</td>
                                    <td>{{ Str::limit($user->alamat ?? '-', 30) }}</td>
                                    <td>{{ $user->no_hp ?? '-' }}</td>

                                    <td>
                                        <span class="role-badge bg-{{ $user->role === 'admin' ? 'primary' : 'info' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>

                                    <td>
                                        {{-- EDIT & DELETE hanya untuk superadmin --}}
                                        @if(auth()->user()->isSuperAdmin())
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-primary action-btn" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Hapus data ini?')"
                                                    class="text-danger action-btn bg-transparent border-0"
                                                    title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection


@push('js')
<script>
$(document).ready(function() {
    $('#userTable').DataTable({
        paging: false,
        info: false,
        ordering: true,
        searching: true,
        responsive: true,
        language: { search: "Cari:" },
        dom: 'ft',
        columnDefs: [
            { orderable: false, targets: [6] }
        ]
    });
});
</script>
@endpush
