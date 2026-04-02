<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Pengaduan Prasarana Sekolah</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
       :root {
    --primary: #2563eb;
    --primary-hover: #1d4ed8;
    --primary-light: #dbeafe;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --bg-body: #f8fafc;
    --white: #ffffff;
    --error: #ef4444;
    --success: #10b981;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--bg-body);
    color: var(--text-main);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

/* Background Decor */
.bg-gradient {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 0% 0%, #dbeafe 0%, transparent 30%),
                radial-gradient(circle at 100% 100%, #eff6ff 0%, transparent 30%);
    z-index: -1;
}

.auth-container {
    width: 100%;
    max-width: 420px;
    padding: 20px;
}

/* Card Styling */
.auth-card {
    background: var(--white);
    padding: 2.5rem;
    border-radius: 24px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 
                0 10px 10px -5px rgba(0, 0, 0, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.5);
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.logo-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-light);
    color: var(--primary);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin: 0 auto 1.5rem;
}

h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.auth-header p {
    font-size: 0.95rem;
    color: var(--text-muted);
}

/* Form Styling */
.form-group {
    margin-bottom: 1.25rem;
}

.form-group label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper i {
    position: absolute;
    left: 14px;
    color: var(--text-muted);
}

.input-wrapper input {
    width: 100%;
    padding: 12px 14px 12px 42px;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.2s;
}

.input-wrapper input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px var(--primary-light);
}

/* Button */
.btn {
    width: 100%;
    padding: 14px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-primary {
    background: var(--primary);
    color: white;
    margin-top: 1rem;
}

.btn-primary:hover {
    background: var(--primary-hover);
    transform: translateY(-2px);
}

/* Alerts */
.alert {
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 0.875rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-error { background: #fef2f2; color: var(--error); }
.alert-success { background: #f0fdf4; color: var(--success); }

/* Footer */
.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    font-size: 0.9rem;
    color: var(--text-muted);
}

.auth-footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
}

.copyright {
    text-align: center;
    margin-top: 2rem;
    font-size: 0.8rem;
    color: var(--text-muted);
}
    </style>
</head>

<body>
    <div class="bg-gradient"></div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo-icon">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h1>Selamat Datang</h1>
                <p>Silakan masuk untuk mengelola laporan prasarana sekolah.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i> Username atau password salah.
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="modern-form">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class="bi bi-person"></i>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" 
                               required autofocus placeholder="Masukkan username Anda">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-key"></i>
                        <input type="password" id="password" name="password" required 
                               placeholder="Masukkan password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-full">
                    Masuk Sekarang <i class="bi bi-arrow-right"></i>
                </button>

                <div class="auth-footer">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                </div>
            </form>
        </div>
        
        <p class="copyright">&copy; {{ date('Y') }} Sistem Aspirasi Siswa Made By Sahyu XII RPL 2</p>
    </div>
</body>

</html>