@extends('layouts.user_type.auth')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4 shadow-sm border-0">

      {{-- HEADER --}}
      <div class="card-header pb-2 pt-3 d-flex justify-content-between align-items-center border-0">
        <h6 class="mb-0 fw-bold">
          <i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Data Nasabah
        </h6>
    
      </div>

      <div class="card-body pt-0">

        <form action="{{ route('nasabah.store') }}" method="POST">
          @csrf

          {{-- INFORMASI NASABAH --}}
          <h6 class="fw-bold mt-4 mb-3 text-secondary">Informasi Nasabah</h6>
          <div class="row">

            {{-- NAMA --}}
            <div class="col-md-6 mb-3">
              <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                <input type="text" name="nama" id="nama"
                  class="form-control @error('nama') is-invalid @enderror"
                  value="{{ old('nama') }}" placeholder="Masukkan nama nasabah" required>
              </div>
              @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- NO TASPEN --}}
            <div class="col-md-6 mb-3">
              <label for="no_taspen" class="form-label">No Taspen <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-id-card"></i></span>
                <input type="text" name="no_taspen" id="no_taspen"
                  class="form-control @error('no_taspen') is-invalid @enderror"
                  value="{{ old('no_taspen') }}" placeholder="Masukkan nomor taspen" required>
              </div>
              @error('no_taspen') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

          </div>

          <div class="row">

            {{-- JENIS KLAIM --}}
            <div class="col-md-6 mb-3">
              <label for="jenis_klaim_id" class="form-label">Jenis Klaim <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-clipboard-list"></i></span>
                <select name="jenis_klaim_id" id="jenis_klaim_id"
                  class="form-select @error('jenis_klaim_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Jenis Klaim --</option>
                  @foreach($jenisKlaim as $jk)
                    <option value="{{ $jk->id }}" {{ old('jenis_klaim_id') == $jk->id ? 'selected' : '' }}>
                      {{ $jk->nama_klaim }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('jenis_klaim_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- TANGGAL MASUK --}}
            <div class="col-md-6 mb-3">
              <label for="tanggal_masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-calendar-alt"></i></span>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                  class="form-control @error('tanggal_masuk') is-invalid @enderror"
                  value="{{ old('tanggal_masuk') }}" required>
              </div>
              @error('tanggal_masuk') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

          </div>

          <hr class="my-4">

          {{-- PENUGASAN --}}
          <h6 class="fw-bold mb-3 text-secondary">Penugasan</h6>
          <div class="row">

            <div class="col-md-6 mb-3">
              <label for="petugas_id" class="form-label">Petugas Penanggung Jawab <span class="text-danger">*</span></label>
              <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-user-tie"></i></span>
                <select name="petugas_id" id="petugas_id"
                  class="form-select @error('petugas_id') is-invalid @enderror" required>
                  <option value="">-- Pilih Petugas --</option>
                  @foreach($petugas as $p)
                    <option value="{{ $p->id }}" {{ old('petugas_id') == $p->id ? 'selected' : '' }}>
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
