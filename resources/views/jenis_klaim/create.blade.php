@extends('layouts.user_type.auth')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4 shadow-sm">
      <div class="card-header pb-2 pt-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Jenis Klaim</h6>
        <a href="{{ route('jenis-klaim.index') }}" class="btn btn-outline-secondary btn-sm">
          <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
      </div>

      <div class="card-body">
        <form action="{{ route('jenis-klaim.store') }}" method="POST">
          @csrf

          {{-- INFORMASI JENIS KLAIM --}}
          <h6 class="fw-bold mb-3 text-secondary">Data Jenis Klaim</h6>
          <div class="row">
            {{-- NAMA JENIS KLAIM --}}
            <div class="col-md-6 mb-3">
              <label for="nama_klaim" class="form-label">Nama Jenis Klaim <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                <input
                  type="text"
                  name="nama_klaim"
                  id="nama_klaim"
                  class="form-control @error('nama_klaim') is-invalid @enderror"
                  value="{{ old('nama_klaim') }}"
                  placeholder="Masukkan nama jenis klaim"
                  required
                >
              </div>
              @error('nama_klaim') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- KETERANGAN --}}
            <div class="col-md-6 mb-3">
            <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
            <div class="input-group input-group-sm">
                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                <textarea
                name="keterangan"
                id="keterangan"
                class="form-control @error('keterangan') is-invalid @enderror"
                placeholder="Masukkan keterangan lengkap"
                rows="3"
                required
                >{{ old('keterangan') }}</textarea>
            </div>
            @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>


          {{-- TOMBOL AKSI --}}
          <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('jenis-klaim.index') }}" class="btn btn-outline-secondary btn-sm me-2">
              <i class="fas fa-times me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary btn-sm">
              <i class="fas fa-save me-1"></i> Simpan Data
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
