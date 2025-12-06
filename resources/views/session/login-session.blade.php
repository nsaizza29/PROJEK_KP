@extends('layouts.user_type.guest')

@section('content')

<main class="main-content">
    <div class="container-fluid p-0">
        <div class="row g-0 h-100">
            
            <!-- LEFT COLUMN - FORM -->
            <div class="col-lg-5 col-md-6 d-flex align-items-center justify-content-center bg-white">
                <div class="p-4 p-lg-5 w-100" style="max-width: 480px;">
                    
                    <!-- Logo & Brand -->
                    <div class="text-center mb-3">
                        <div class="logo-container mb-2">
                            <img src="../assets/img/logo_taspen.png" alt="Logo Taspen" class="brand-logo">
                        </div>
                        <h1 class="h4 fw-bold text-primary mb-0">Monitoring Tugas</h1>
                        <div class="divider my-4">
                            <span class="line"></span>
                            <span class="px-3 small text-uppercase text-muted">Login System</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <!-- Welcome Message -->
                    <div class="mb-4">
                        <h2 class="h4 mb-2">Selamat Datang!</h2>
                        <p class="text-muted small">Masukkan kredensial Anda untuk mengakses sistem monitoring</p>
                    </div>

      

                    <!-- Login Form -->
                    <form method="POST" action="/session" id="loginForm">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="form-floating mb-3">
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control form-control-lg rounded-3 border-0 shadow-sm"
                                   placeholder="name@example.com"
                                   required>
                            <label for="email" class="text-muted">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <div class="input-highlight"></div>
                        </div>
                        @error('email')
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
                                    class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-muted"
                                    id="togglePassword">
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

                        <!-- Remember & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                <label class="form-check-label small text-muted" for="rememberMe">
                                    <i class="fas fa-check-circle me-1"></i>Ingat Saya
                                </label>
                            </div>
                            <a href="/login/forgot-password" class="small text-decoration-none text-primary fw-medium">
                                <i class="fas fa-key me-1"></i>Lupa Password?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 py-3 mb-4 shadow-sm hover-lift">
                            <span id="loginText">Masuk ke Sistem</span>
                            <span id="loginSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                        </button>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="small text-muted mb-0">
                                Belum memiliki akun?
                                <a href="/register/" class="text-primary fw-bold text-decoration-none">
                                    Buat akun baru
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

            <!-- RIGHT COLUMN - HERO SECTION -->
            <div class="col-lg-7 col-md-6 d-none d-md-block">
                <div class="hero-section h-100 position-relative overflow-hidden">
                    
                    <!-- Background Image with Overlay -->
                    <div class="hero-bg"></div>
                    
                    <!-- Content Overlay -->
                    <div class="hero-content position-absolute top-0 start-0 w-100 h-70 d-flex flex-column justify-content-center p-5">
                        
                        <!-- System Features -->
                        <div class="feature-container mb-5">
                            <h2 class="display-5 fw-bold text-white mb-4">
                                Sistem Monitoring<br>Tugas Terintegrasi
                            </h2>
                            <p class="lead text-white opacity-90 mb-4">
                                Kelola dan pantau progress tugas secara real-time dengan sistem yang aman dan efisien.
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
                                    <p class="small text-white opacity-75 mb-0">Monitor progress tugas secara langsung</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="feature-card p-3 rounded-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <h5 class="text-white mb-2">Task Management</h5>
                                    <p class="small text-white opacity-75 mb-0">Kelola tugas dengan sistem terstruktur</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="feature-card p-3 rounded-3">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h5 class="text-white mb-2">Secure Platform</h5>
                                    <p class="small text-white opacity-75 mb-0">Data terlindungi dengan enkripsi terbaik</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Floating Elements -->
                    <div class="floating-element el-1"></div>
                    <div class="floating-element el-2"></div>
                    <div class="floating-element el-3"></div>
                    
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Custom Styles -->
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

    /* Brand Logo */
    .brand-logo {
        height: 80px;
        width: auto;
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        transition: transform 0.3s ease;
    }

    .brand-logo:hover {
        transform: scale(1.05);
    }

    .logo-container {
        padding: 0.2rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0, 60, 113, 0.1);
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

    .form-control-lg {
        padding: 1rem 1.5rem;
        font-size: 1rem;
        border: 2px solid transparent !important;
        background: #f8f9fa !important;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus {
        background: white !important;
        box-shadow: 0 0 0 4px rgba(0, 60, 113, 0.1) !important;
        border-color: var(--primary-color) !important;
    }

    .form-control-lg:focus + .input-highlight {
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

    /* Hero Section */
    .hero-section {
        background: var(--gradient-primary);
    }

    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('../assets/img/taspen.jpeg');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        opacity: 0.15;
    }

    .hero-content {
        z-index: 2;
        background: linear-gradient(135deg, 
            rgba(0, 60, 113, 0.95) 0%, 
            rgba(0, 86, 179, 0.85) 100%);
    }

    /* Feature Cards */
    .feature-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
    }

    /* Floating Elements */
    .floating-element {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 1;
    }

    .el-1 {
        width: 150px;
        height: 150px;
        top: 10%;
        right: 10%;
        animation: float 6s ease-in-out infinite;
    }

    .el-2 {
        width: 100px;
        height: 100px;
        bottom: 20%;
        left: 5%;
        animation: float 8s ease-in-out infinite 1s;
    }

    .el-3 {
        width: 80px;
        height: 80px;
        bottom: 10%;
        right: 15%;
        animation: float 7s ease-in-out infinite 2s;
    }

    /* Animations */
    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
        }
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
        
        .brand-logo {
            height: 60px;
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .bg-white {
            background-color: #1a1a1a !important;
        }
        
        .form-control-lg {
            background-color: #2d2d2d !important;
            color: #ffffff;
            border-color: #404040 !important;
        }
        
        .text-muted {
            color: #adb5bd !important;
        }
    }
</style>

<!-- JavaScript for Interactions -->
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    if(togglePassword){
        togglePassword.addEventListener('click', function(){
            const type = passwordInput.getAttribute('type')==='password'?'text':'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }
});
</script>

@endsection