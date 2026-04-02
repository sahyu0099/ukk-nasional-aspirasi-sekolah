<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SuaraSiswa</title>
    
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
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--bg-body);
    color: var(--text-main);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 40px 0;
}

.bg-gradient {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: radial-gradient(circle at 10% 20%, #dbeafe 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, #eff6ff 0%, transparent 40%);
    z-index: -1;
}

.auth-container { width: 100%; max-width: 600px; padding: 0 20px; }

.auth-card {
    background: var(--white);
    padding: 2.5rem;
    border-radius: 24px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.5);
}

.auth-header { text-align: center; margin-bottom: 2rem; }

.logo-icon {
    width: 56px; height: 56px;
    background: var(--primary-light);
    color: var(--primary);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin: 0 auto 1rem;
}

h1 { font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: #0f172a; }
.auth-header p { font-size: 0.9rem; color: var(--text-muted); margin-top: 0.5rem; }

/* Grid for Form Rows */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group label {
    display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; color: #475569;
}

.input-wrapper { position: relative; display: flex; align-items: center; }
.input-wrapper i { position: absolute; left: 12px; color: var(--text-muted); font-size: 0.9rem; }

.input-wrapper input {
    width: 100%;
    padding: 10px 12px 10px 38px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.input-wrapper input:focus {
    outline: none; border-color: var(--primary); box-shadow: 0 0 0 4px var(--primary-light);
}

.btn {
    width: 100%; padding: 12px; border-radius: 10px;
    font-weight: 600; border: none; cursor: pointer;
    transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px;
}

.btn-primary { background: var(--primary); color: white; margin-top: 1rem; }
.btn-primary:hover { background: var(--primary-hover); transform: translateY(-1px); }

.alert-error {
    background: #fff1f2; color: var(--error);
    padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem;
}
.alert-error ul { list-style: none; font-size: 0.8rem; }

.auth-footer { text-align: center; margin-top: 1.5rem; font-size: 0.85rem; color: var(--text-muted); }
.auth-footer a { color: var(--primary); text-decoration: none; font-weight: 600; }

.copyright { text-align: center; margin-top: 2rem; font-size: 0.75rem; color: var(--text-muted); }

/* Responsive */
@media (max-width: 500px) {
    .form-row { grid-template-columns: 1fr; }
    .auth-card { padding: 1.5rem; }
}
    </style>
</head>

<body>
    <div class="bg-gradient"></div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h1>Daftar Akun</h1>
                <p>Bergabunglah untuk membantu kami menjaga fasilitas sekolah tetap prima.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li><i class="bi bi-x-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="modern-form">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="nik">NIK / NIS</label>
                        <div class="input-wrapper">
                            <i class="bi bi-card-heading"></i>
                            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required autofocus placeholder="16 Digit NIK/NIS">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <i class="bi bi-person-badge"></i>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Nama sesuai kartu identitas">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="bi bi-at"></i>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required placeholder="User_id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <div class="input-wrapper">
                            <i class="bi bi-telephone"></i>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="08xxxx">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <div class="input-wrapper">
                            <i class="bi bi-shield-lock"></i>
                            <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Sandi</label>
                        <div class="input-wrapper">
                            <i class="bi bi-shield-check"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi sandi">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-full">
                    Buat Akun Sekarang <i class="bi bi-chevron-right"></i>
                </button>

                <div class="auth-footer">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>
        </div>
        
        <p class="copyright">&copy; {{ date('Y') }} SuaraSiswa - Manajemen Prasarana</p>
    </div>
</body>

</html>