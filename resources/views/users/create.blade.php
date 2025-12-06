@extends('layouts.user_type.auth')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6><svg width="15" height="15" viewBox="0 0 20 20" style="margin-right:5px"><circle cx="10" cy="10" r="8" fill="#4CAF50"/><rect x="9" y="5" width="2" height="10" fill="#fff"/><rect x="5" y="9" width="10" height="2" fill="#fff"/></svg>Tambah User Baru</h6>
          <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm mb-0">
            <svg width="14" height="14" viewBox="0 0 20 20" style="margin-right:2px" xmlns="http://www.w3.org/2000/svg"><polyline points="14,4 6,10 14,16" fill="none" stroke="#6c757d" stroke-width="2"/></svg>Kembali
          </a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
          @csrf
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input class="form-control @error('nip') is-invalid @enderror" type="text" name="nip" id="nip" value="{{ old('nip') }}">
                @error('nip')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input class="form-control @error('no_hp') is-invalid @enderror" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                @error('no_hp')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                  <option value="">Pilih Role</option>
                  <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="petugas" {{ old('role') === 'petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
                @error('role')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3">{{ old('alamat') }}</textarea>
                @error('alamat')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-taspen-primary">
              <svg width="14" height="14" viewBox="0 0 20 20" style="margin-right:2px"><rect x="4" y="2" width="12" height="16" rx="2" fill="#fff" stroke="#5e72e4"/><rect x="7" y="12" width="6" height="2" rx="1" fill="#5e72e4"/></svg>Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
