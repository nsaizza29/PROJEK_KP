@extends('layouts.user_type.auth')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/soft-ui-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/styling.css') }}">
@endpush

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card shadow-sm border-0 mb-4">
      
      {{-- Header --}}
      <div class="card-header pb-2 pt-3 d-flex justify-content-between align-items-center border-0">
        <h6 class="mb-0 fw-bold text-secondary">
          <i class="fas fa-edit me-2"></i> Edit Data Nasabah
        </h6>
      </div>

      <div class="card-body">

        {{-- Alert sukses --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('nasabah.update', $nasabah->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- INFORMASI NASABAH --}}
          <h6 class="fw-bold text-secondary mb-3">Informasi Nasabah</h6>

          <div class="row">

            {{-- Nama --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $nasabah->nama) }}" placeholder="Masukkan nama nasabah" required>
              </div>
              @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- No Taspen --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">No Taspen <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-id-card"></i></span>
                <input type="text" name="no_taspen" class="form-control @error('no_taspen') is-invalid @enderror"
                       value="{{ old('no_taspen', $nasabah->no_taspen) }}" placeholder="Masukkan nomor taspen" required>
              </div>
              @error('no_taspen') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

          </div>

          <div class="row">

            {{-- Jenis Klaim --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">Jenis Klaim <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-clipboard-list"></i></span>
                <select name="jenis_klaim_id" class="form-control @error('jenis_klaim_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Jenis Klaim --</option>
                  @foreach($jenisKlaim as $jk)
                    <option value="{{ $jk->id }}" 
                            {{ old('jenis_klaim_id', $nasabah->jenis_klaim_id) == $jk->id ? 'selected' : '' }}>
                      {{ $jk->nama_klaim }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('jenis_klaim_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Tanggal Masuk --}}
            <div class="col-md-6 mb-3">
              <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                <input type="date" name="tanggal_masuk"
                       class="form-control @error('tanggal_masuk') is-invalid @enderror"
                       value="{{ old('tanggal_masuk', $nasabah->tanggal_masuk ? \Carbon\Carbon::parse($nasabah->tanggal_masuk)->format('Y-m-d') : '') }}"
                       required>
              </div>
              @error('tanggal_masuk') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

          </div>

          <hr>

          {{-- PENUGASAN --}}
          <h6 class="fw-bold text-secondary mb-3">Penugasan</h6>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Petugas yang Menangani <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-user-tie"></i></span>
                <select name="petugas_id" class="form-control @error('petugas_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Petugas --</option>
                  @foreach($petugas as $p)
                    <option value="{{ $p->id }}" {{ old('petugas_id', $nasabah->petugas_id) == $p->id ? 'selected' : '' }}>
                      {{ $p->name }} - {{ $p->nip }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('petugas_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          {{-- TOMBOL --}}
          <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('nasabah.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill me-2">
              <i class="fas fa-times me-1"></i>Batal
            </a>
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
