@extends('layouts.user_type.guest')

@section('content')

<div class="page-header section-height-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain mt-8">
                    <div class="card-header pb-0 text-left bg-transparent">
                        <h4 class="mb-0">Forgot Password</h4>
                        <p class="text-sm">Masukkan email untuk menerima link reset password.</p>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success text-sm mb-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email" required autofocus>
                                @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                                    Kirim Link Reset Password
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-sm text-primary">Kembali ke Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                    <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" 
                        style="background-image:url('../assets/img/curved-images/curved6.jpg')">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
