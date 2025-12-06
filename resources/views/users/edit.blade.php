@extends('layouts.user_type.auth')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6><i class="fas fa-user-edit me-2"></i>Edit User</h6>
          <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm mb-0">
            <i class="fas fa-arrow-left me-2"></i>Kembali
          </a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="password" class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input class="form-control @error('nip') is-invalid @enderror" type="text" name="nip" id="nip" value="{{ old('nip', $user->nip) }}">
                @error('nip')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input class="form-control @error('no_hp') is-invalid @enderror" type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
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
                  <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
                @error('role')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-taspen-primary">
              <i class="fas fa-save me-2"></i>Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
