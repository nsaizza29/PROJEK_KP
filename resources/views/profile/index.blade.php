@extends('layouts.user_type.auth')

@section('content')

<style>
    /* --- CARD CLEAN & SOFT STYLE --- */
    .card-clean {
        border: 1px solid rgba(0,0,0,0.05) !important;
        background: rgba(255,255,255,0.82) !important;
        backdrop-filter: blur(3px);
        border-radius: 20px !important;
        box-shadow: 0 4px 14px rgba(0,0,0,0.06) !important;
    }

    .card-header-clean {
        border-bottom: 1px solid rgba(0,0,0,0.06);
        padding: 18px 22px;
    }

    /* Form style */
    .form-control {
        border-radius: 10px;
        padding: 8px 12px;
        font-size: .85rem;
        border: 1px solid #e2e6ea;
    }
    .form-control:focus {
        border-color: #a1c4fd;
        box-shadow: 0px 0px 0px 3px rgba(161, 196, 253, 0.3);
    }

    textarea.form-control {
        resize: none;
    }

    /* Title section */
    .section-title {
        font-size: .85rem;
        font-weight: 700;
        color: #6c757d;
        text-transform: uppercase;
        margin-bottom: 6px;
        margin-top: 18px;
    }

    hr.soft-line {
        border: 0;
        border-top: 1px solid rgba(0,0,0,0.06);
        margin: 20px 0;
    }

    /* Button primary */
    .btn-taspen-primary {
        background: linear-gradient(90deg, #3b7ddd, #1f62c4);
        color: white;
        border-radius: 12px;
        font-weight: 600;
        border: none;
    }
    .btn-taspen-primary:hover {
        opacity: .9;
        color: white;
    }
</style>


<div class="container-fluid">
    <div class="col-12">

        <div class="card card-clean mb-5">

            <div class="card-header-clean bg-white">
                <p class="mb-0 fw-bold fs-5">Profil Saya</p>
            </div>

            <div class="card-body">

                {{-- SUCCESS ALERT --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="text-center mb-4">

    {{-- AVATAR --}}
    <div class="d-flex justify-content-center">
        <div class="rounded-circle d-flex align-items-center justify-content-center"
            style="width:120px; height:120px; 
                   background: linear-gradient(135deg, #4e73df, #224abe); 
                   box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
            <h1 class="text-white mb-0" style="font-size: 38px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </h1>
        </div>
    </div>

    {{-- NAME --}}
    <h5 class="mt-3 mb-0 fw-bold">{{ auth()->user()->name }}</h5>
    <p class="text-sm text-secondary mb-0">{{ ucfirst(auth()->user()->role) }}</p>

</div>

                    <hr class="soft-line">

                    {{-- INFORMASI USER --}}
                    <p class="section-title">Informasi User</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small">Nama Lengkap *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Email *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label small">NIP</label>
                            <input type="text" name="nip" class="form-control" value="{{ old('nip', auth()->user()->nip) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">No HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', auth()->user()->no_hp) }}">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label class="form-label small">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                    </div>

                    <hr class="soft-line">

                    {{-- UBAH PASSWORD --}}
                    <p class="section-title">Ubah Password (Opsional)</p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small">Password Baru</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Kosongkan jika tidak diubah">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="d-flex justify-content-end mt-3">
                      <button type="submit" class="btn btn-primary btn-sm rounded-pill">
                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                      </button>
                    </div>


                </form>

            </div>
        </div>
    </div>
</div>

@endsection
