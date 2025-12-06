@extends('layouts.user_type.auth')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/soft-ui-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/styling.css') }}">
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4 shadow-sm">
      <div class="card-header pb-2 pt-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
          <svg width="14" height="14" viewBox="0 0 18 18" class="me-1">
            <rect x="4" y="14" width="10" height="2" rx="1" fill="#ffbb33"/>
            <rect x="8" y="14" width="2" height="-8" fill="#ffbb33"/>
            <polygon points="13,3 15,5 6,14 4,14 4,12" fill="#ffbb33"/>
          </svg>
          Edit Jenis Klaim
        </h6>
        <a href="{{ route('jenis-klaim.index') }}" class="btn btn-outline-secondary btn-sm">
          <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
      </div>

      <div class="card-body">
        {{-- Alert sukses --}}
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        {{-- Form Edit --}}
        <form action="{{ route('jenis-klaim.update', $jenisKlaim->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Informasi --}}
          <p class="text-uppercase text-sm fw-bold">Informasi Jenis Klaim</p>

          <div class="row">
            {{-- Nama Jenis Klaim --}}
            <div class="col-md-6 mb-3">
              <label for="nama_klaim" class="form-label">Nama Jenis Klaim <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                  <i class="fas fa-file-alt text-secondary"></i>
                </span>
                <input type="text"
                       name="nama_klaim"
                       id="nama_klaim"
                       class="form-control @error('nama_klaim') is-invalid @enderror"
                       value="{{ old('nama_klaim', $jenisKlaim->nama_klaim) }}"
                       placeholder="Masukkan nama jenis klaim"
                       required>
              </div>
              @error('nama_klaim') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Keterangan --}}
            <div class="col-md-6 mb-3">
              <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                  <i class="fas fa-align-left text-secondary"></i>
                </span>
                <textarea name="keterangan"
                          id="keterangan"
                          class="form-control @error('keterangan') is-invalid @enderror"
                          placeholder="Masukkan keterangan lengkap"
                          rows="3"
                          required>{{ old('keterangan', $jenisKlaim->keterangan) }}</textarea>
              </div>
              @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          {{-- Tombol Aksi --}}
          <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('jenis-klaim.index') }}" class="btn btn-outline-secondary me-2">
              <i class="fas fa-times me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-taspen-primary">
              <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
