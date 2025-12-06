@extends('layouts.app')
@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light">
    <div class="card rounded shadow-lg p-4" style="max-width:400px;">
        <h3 class="text-danger text-center mb-4">Akun Belum Diapprove</h3>
        <p class="text-center text-secondary">Akun anda sedang menunggu persetujuan Super Admin.<br>Silakan hubungi Super Admin agar akun anda dapat diaktifkan.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-secondary w-100 mt-4">Logout</button>
        </form>
    </div>
</div>
@endsection
