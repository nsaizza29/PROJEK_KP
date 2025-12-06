@extends('layouts.user_type.guest')

@section('content')

<main class="main-content">
    <div class="container-fluid p-0">
        <div class="row g-0 h-100">

            <!-- RIGHT COLUMN - HERO SECTION -->
            <div class="col-lg-7 col-md-6 d-none d-md-block">
                <div class="hero-section h-100 position-relative overflow-hidden">
                    
                    <!-- Background Image - LAYER PALING BAWAH -->
                    <div class="hero-bg position-absolute top-0 start-0 w-100 h-100"></div>
                    
                    <!-- Floating Elements - LAYER TENGAH -->
                    <div class="floating-elements position-absolute top-0 start-0 w-100 h-100">
                        <div class="floating-element el-1"></div>
                        <div class="floating-element el-2"></div>
                        <div class="floating-element el-3"></div>
                        <div class="floating-element el-4"></div>
                    </div>

                    <!-- Gradient Overlay - LAYER ATAS FLOATING -->
                    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

                    <!-- Content Overlay - LAYER PALING ATAS -->
                    <div class="hero-content position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-start p-5">
                        
                        <!-- Logo di Atas -->
                        <div class="hero-header mb-5 pt-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/img/logo_taspen.png') }}" alt="Logo Taspen" class="hero-logo me-3">
                                <div>
                                    <h1 class="h3 fw-bold text-white mb-1">Monitoring Tugas</h1>
                                    <p class="text-white opacity-75 mb-0">PT Taspen Persero</p>
                                </div>
                            </div>
                        </div>

                        <!-- System Features -->
                        <div class="feature-container mb-5">
                            <h2 class="display-5 fw-bold text-white mb-4">
                                Bergabung dengan<br>Sistem Monitoring
                            </h2>
                            <p class="lead text-white opacity-90 mb-4">
                                Daftarkan akun untuk mulai menggunakan sistem monitoring tugas yang terintegrasi.
                            </p>
                        </div>

                        <!-- Feature Cards -->
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6">
                                <div class="feature-card p-3 rounded-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h5 class="text-white mb-2">Real-time Tracking</h5>
                                    <p class="small text-white opacity-75 mb-0">Pantau progress tugas secara langsung</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="feature-card p-3 rounded-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h5 class="text-white mb-2">Kolaborasi Tim</h5>
                                    <p class="small text-white opacity-75 mb-0">Kerja sama tim yang lebih efisien</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="feature-card p-3 rounded-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h5 class="text-white mb-2">Keamanan Data</h5>
                                    <p class="small text-white opacity-75 mb-0">Data terlindungi dengan enkripsi</p>
                                </div>
                            </div>
                        </div>

                        <!-- Process Steps -->
                        <div class="process-steps mt-5 pt-4">
                            <h5 class="text-white mb-3 d-flex align-items-center">
                                <i class="fas fa-list-check me-2"></i>Proses Pendaftaran:
                            </h5>
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-bullet me-3">
                                    <i class="fas fa-circle text-white opacity-75"></i>
                                </div>
                                <div class="text-white opacity-90">Isi formulir pendaftaran</div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-bullet me-3">
                                    <i class="fas fa-circle text-white opacity-75"></i>
                                </div>
                                <div class="text-white opacity-90">Verifikasi oleh Super Admin</div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="step-bullet me-3">
                                    <i class="fas fa-circle text-white opacity-75"></i>
                                </div>
                                <div class="text-white opacity-90">Mulai menggunakan sistem</div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>

            <!-- LEFT COLUMN - FORM -->
            <div class="col-lg-5 col-md-6 d-flex align-items-center justify-content-center bg-white">
                <div class="p-4 p-lg-5 w-100" style="max-width: 480px;">
                    
                    <!-- Brand -->
                    <div class="text-center mb-3">
                       <div class="logo-container mb-2">
                            <img src="{{ asset('assets/img/logo_taspen.png') }}" alt="Logo Taspen" class="brand-logo" style="height: 50px;">
                        </div>
                        <h1 class="h4 fw-bold text-primary mb-0">Monitoring Tugas</h1>
                        <div class="divider my-4">
                            <span class="line"></span>
                            <span class="px-3 small text-uppercase text-muted">Register System</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <!-- Welcome Message -->
                    <div class="mb-4">
                        <h2 class="h4 mb-2">Buat Akun Baru</h2>
                        <p class="text-muted small">Isi data berikut untuk mendaftar ke sistem monitoring</p>
                    </div>

                    <!-- Info Alert -->
                    <div class="alert alert-warning alert-dismissible fade show py-2 mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Akun memerlukan verifikasi Super Admin. Anda dapat login setelah akun disetujui.
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                    </div>

                    <!-- Register Form -->
                    <form method="POST" action="{{ route('register.store') }}" id="registerForm">
                        @csrf
                        
                        <!-- Name Field -->
                        <div class="form-floating mb-3">
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control form-control-lg rounded-3 border-0 shadow-sm"
                                   placeholder="Nama Lengkap"
                                   value="{{ old('name') }}"
                                   required>
                            <label for="name" class="text-muted">
                                <i class="fas fa-user me-2"></i>Nama Lengkap
                            </label>
                            <div class="input-highlight"></div>
                        </div>
                        @error('name')
                            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror

                        <!-- Email Field -->
                        <div class="form-floating mb-3">
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control form-control-lg rounded-3 border-0 shadow-sm"
                                   placeholder="name@example.com"
                                   value="{{ old('email') }}"
                                   required>
                            <label for="email" class="text-muted">
                                <i class="fas fa-envelope me-2"></i>Alamat Email
                            </label>
                            <div class="input-highlight"></div>
                        </div>
                        @error('email')
                            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror

                        <!-- Role Selection -->
                        <div class="form-floating mb-3 position-relative">
                            <select name="role" 
                                    id="role" 
                                    class="form-control form-control-lg rounded-3 border-0 shadow-sm pe-5"
                                    style="font-size: 0.9rem;"
                                    required>
                                <option value="" disabled selected style="font-size: 0.9rem;">Pilih jabatan/peran</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }} style="font-size: 0.9rem;">Admin</option>
                                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }} style="font-size: 0.9rem;">Pegawai</option>
                            </select>
                            <label for="role" class="text-muted">
                                <i class="fas fa-briefcase me-2"></i>Jabatan / Peran
                            </label>
                            <div class="input-highlight"></div>
                            <div class="select-arrow position-absolute end-0 translate-middle-y" style="top: 50%; right: 15px; pointer-events: none;">
                                <i class="fas fa-chevron-down text-muted me-2"></i>
                            </div>
                        </div>
                        @error('role')
                        <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                        </div>
                        @enderror

                        <!-- Password Field -->
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="form-control form-control-lg rounded-3 border-0 shadow-sm pe-5"
                                   placeholder="Password"
                                   required>
                            <label for="password" class="text-muted">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <button type="button" 
                                    class="btn btn-link position-absolute end-0 translate-middle-y text-muted"
                                    id="togglePassword"
                                    style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <i class="fas fa-eye"></i>
                            </button>
                            <div class="input-highlight"></div>
                        </div>
                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror

                        <!-- Password Strength Indicator -->
                        <div class="mb-3">
                            <div class="password-strength">
                                <div class="strength-bar"></div>
                            </div>
                            <small class="form-text text-muted d-block mt-1">Minimal 8 karakter dengan huruf dan angka</small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-4 position-relative">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   class="form-control form-control-lg rounded-3 border-0 shadow-sm"
                                   placeholder="Konfirmasi Password"
                                   required>
                            <label for="password_confirmation" class="text-muted">
                                <i class="fas fa-lock me-2"></i>Konfirmasi Password
                            </label>
                            <button type="button" 
                                    class="btn btn-link position-absolute end-0 translate-middle-y text-muted"
                                    id="togglePassword"
                                    style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <i class="fas fa-eye"></i>
                            </button>
                            <div class="input-highlight"></div>
                            <div class="password-match mt-2 small" id="passwordMatch"></div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="agreement" 
                                   id="agreement"
                                   {{ old('agreement') ? 'checked' : '' }}>
                            <label class="form-check-label small text-muted" for="agreement">
                                <i class="fas fa-check-circle me-1"></i>Saya setuju dengan 
                                <a href="#" class="text-primary text-decoration-none">Syarat & Ketentuan</a> 
                                dan 
                                <a href="#" class="text-primary text-decoration-none">Kebijakan Privasi</a>
                            </label>
                            @error('agreement')
                                <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Submit tanpa spinner -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 py-3 mb-4 shadow-sm hover-lift">
                            Daftar Akun
                        </button>


                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="small text-muted mb-0">
                                Sudah memiliki akun?
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                                    Masuk disini
                                </a>
                            </p>
                        </div>
                    </form>

                    <!-- Footer -->
                    <div class="text-center mt-5 pt-4 border-top">
                        <p class="small text-muted mb-0">
                            &copy; {{ date('Y') }} PT Taspen Persero. All rights reserved.
                        </p>
                        <p class="small text-muted">
                            v2.1.0 • Sistem Monitoring Tugas
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* Root Variables */
    :root {
        --primary-color: #003c71;
        --primary-light: #0056b3;
        --secondary-color: #009fe3;
        --accent-color: #ffcc00;
        --success-color: #28a745;
        --gradient-primary: linear-gradient(135deg, #003c71 0%, #0056b3 100%);
        --gradient-accent: linear-gradient(135deg, #009fe3 0%, #00c6ff 100%);
    }

    /* Global Styles */
    body {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        overflow-x: hidden;
    }

    /* Hero Logo */
    .hero-logo {
        height: 60px;
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease;
    }

    .hero-logo:hover {
        transform: scale(1.05);
    }

    /* Hero Section Structure - DIUBAH URUTAN LAYER */
    .hero-section {
        background: var(--gradient-primary);
        position: relative;
        overflow: hidden;
    }

    /* Background Image - LAYER 1 (PALING BAWAH) */
    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("{{ asset('assets/img/taspen.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: 1;
    }

    /* Floating Elements - LAYER 2 (DIATAS BACKGROUND) */
    .floating-elements {
        z-index: 2;
    }

    .floating-element {
        position: absolute;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .el-1 {
        width: 180px;
        height: 180px;
        top: -80px;
        right: -40px;
        animation: float 8s ease-in-out infinite;
    }

    .el-2 {
        width: 120px;
        height: 120px;
        top: -40px;
        left: -30px;
        animation: float 10s ease-in-out infinite 1s;
    }

    .el-3 {
        width: 90px;
        height: 90px;
        top: 20px;
        right: 20%;
        animation: float 9s ease-in-out infinite 2s;
    }

    .el-4 {
        width: 150px;
        height: 150px;
        bottom: -50px;
        left: 15%;
        animation: float 12s ease-in-out infinite 3s;
    }

    /* Gradient Overlay - LAYER 3 (DIATAS FLOATING) */
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, 
            rgba(0, 60, 113, 0.92) 0%, 
            rgba(0, 86, 179, 0.88) 100%);
        z-index: 3;
    }

    /* Content - LAYER 4 (PALING ATAS) */
    .hero-content {
        z-index: 4;
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
    }

    .divider .line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, #dee2e6, transparent);
    }

    /* Form Controls */
    .form-floating {
        position: relative;
    }

    .form-control-lg, .form-select.form-control-lg {
        padding: 1rem 1.5rem;
        font-size: 1rem;
        border: 2px solid transparent !important;
        background: #f8f9fa !important;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus, .form-select.form-control-lg:focus {
        background: white !important;
        box-shadow: 0 0 0 4px rgba(0, 60, 113, 0.1) !important;
        border-color: var(--primary-color) !important;
    }

    .form-control-lg:focus + .input-highlight, 
    .form-select.form-control-lg:focus + .input-highlight {
        opacity: 1;
        transform: scaleX(1);
    }

    .input-highlight {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--gradient-primary);
        opacity: 0;
        transform: scaleX(0);
        transition: all 0.3s ease;
        border-radius: 0 0 3px 3px;
    }

    /* Custom Select Arrow */
    .select-arrow {
        z-index: 5;
        color: #6c757d;
        font-size: 0.875rem;
    }

    /* Toggle Password Button */
    .form-floating.position-relative #togglePassword {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        z-index: 10;
        padding: 0.5rem;
        background: transparent;
        border: none;
        color: #6c757d;
        transition: color 0.3s ease;
    }

    .form-floating.position-relative #togglePassword:hover {
        color: var(--primary-color);
    }

    /* Buttons */
    .btn-primary {
        background: var(--gradient-primary);
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 60, 113, 0.3) !important;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    /* Alert Styling */
    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeaa7;
        color: #856404;
        font-size: 0.95rem;
    }

    /* Feature Cards */
    .feature-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.18);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
    }

    .feature-icon {
        width: 55px;
        height: 55px;
        background: rgba(255, 255, 255, 0.25);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        color: white;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        background: rgba(255, 255, 255, 0.35);
        transform: scale(1.1);
    }

    /* Process Steps */
    .process-steps {
        padding: 1.75rem;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 16px;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .step-bullet {
        width: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-bullet i {
        font-size: 0.6rem;
        vertical-align: middle;
    }

    /* Password Strength */
    .password-strength {
        height: 6px;
        background: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
        margin-top: 0.5rem;
    }

    .strength-bar {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 3px;
        background: #dc3545;
    }

    .password-match {
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .match-success {
        color: #28a745;
    }

    .match-error {
        color: #dc3545;
    }

    /* Animations */
    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-25px) rotate(5deg);
        }
    }

    /* Additional Visual Enhancements */
    .feature-container h2 {
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .floating-element {
        filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.3));
    }

    .hero-content p {
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            display: none !important;
        }
        
        .container-fluid {
            padding: 0;
        }
        
        .p-4 {
            padding: 2rem 1.5rem !important;
        }
        
        .form-floating.position-relative #togglePassword {
            right: 10px;
            padding: 0.3rem;
        }
        
        .select-arrow {
            right: 12px;
        }
        
        .brand-logo {
            height: 40px !important;
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .bg-white {
            background-color: #1a1a1a !important;
        }
        
        .form-control-lg, .form-select.form-control-lg {
            background-color: #2d2d2d !important;
            color: #ffffff;
            border-color: #404040 !important;
        }
        
        .text-muted {
            color: #adb5bd !important;
        }
        
        .alert-warning {
            background-color: #856404;
            border-color: #856404;
            color: #fff3cd;
        }
        
        .form-check-input {
            background-color: #2d2d2d;
            border-color: #6c757d;
        }
        
        .password-strength {
            background-color: #495057;
        }
        
        .select-arrow {
            color: #adb5bd;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('password_confirmation');
    const passwordMatch = document.getElementById('passwordMatch');
    
    // Password match checker
    function checkPasswordMatch() {
        if (!passwordField || !confirmField || !passwordMatch) return;
        const password = passwordField.value;
        const confirm = confirmField.value;
        
        if (!password || !confirm) {
            passwordMatch.textContent = '';
            confirmField.classList.remove('is-valid', 'is-invalid');
            return;
        }
        
        if (password === confirm) {
            passwordMatch.textContent = '✓ Password cocok';
            passwordMatch.className = 'password-match match-success';
            confirmField.classList.remove('is-invalid');
            confirmField.classList.add('is-valid');
        } else {
            passwordMatch.textContent = '✗ Password tidak cocok';
            passwordMatch.className = 'password-match match-error';
            confirmField.classList.remove('is-valid');
            confirmField.classList.add('is-invalid');
        }
    }

    if (passwordField) passwordField.addEventListener('input', checkPasswordMatch);
    if (confirmField) confirmField.addEventListener('input', checkPasswordMatch);

    // Form submission
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const agreement = document.getElementById('agreement');
            if (!agreement.checked) {
                e.preventDefault();
                alert('Anda harus menyetujui Syarat & Ketentuan untuk melanjutkan pendaftaran.');
                agreement.focus();
                return;
            }

            if (passwordField.value !== confirmField.value) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok.');
                return;
            }
            
            // Tidak ada spinner, langsung submit
        });
    }
});

</script>

@endsection