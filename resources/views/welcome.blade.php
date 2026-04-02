<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaduan Prasarana Sekolah</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
    --primary: #2563eb;
    --primary-hover: #1d4ed8;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --bg-soft: #f8fafc;
    --white: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--bg-soft);
    color: var(--text-main);
    line-height: 1.6;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    overflow: hidden;
}

/* Background Gradient Decor */
.bg-gradient {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at top right, #dbeafe 0%, transparent 40%),
                radial-gradient(circle at bottom left, #eff6ff 0%, transparent 40%);
    z-index: -1;
}

.container {
    width: 100%;
    max-width: 600px;
    padding: 2rem;
    text-align: center;
}

/* Status Badge */
.status-badge {
    display: inline-block;
    padding: 6px 16px;
    background: #dbeafe;
    color: var(--primary);
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 50px;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Card Styling */
.hero-card {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    padding: 3rem 2rem;
    border-radius: 24px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 
                0 10px 10px -5px rgba(0, 0, 0, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.5);
}

h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    color: #0f172a;
}

h1 span {
    color: var(--primary);
}

p {
    color: var(--text-muted);
    font-size: 1.1rem;
    margin-bottom: 2.5rem;
    max-width: 90%;
    margin-left: auto;
    margin-right: auto;
}

/* Button Group */
.cta-group {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
    box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
}

.btn-primary:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 12px 20px -3px rgba(37, 99, 235, 0.4);
}

.btn-outline {
    background-color: transparent;
    color: var(--text-main);
    border: 2px solid #e2e8f0;
}

.btn-outline:hover {
    background-color: #f1f5f9;
    border-color: #cbd5e1;
    transform: translateY(-2px);
}

footer {
    margin-top: 2rem;
    font-size: 0.85rem;
    color: var(--text-muted);
}

/* Responsif Mobile */
@media (max-width: 480px) {
    h1 { font-size: 1.8rem; }
    .cta-group { flex-direction: column; }
    .btn { width: 100%; }
}
    </style>
</head>

<body>
    <div class="bg-gradient"></div>

    <div class="container">
        <header>
            <div class="status-badge">Sistem Informasi Prasarana</div>
        </header>

        <main class="hero-card">
            <h1>Layanan Pengaduan <br><span>Prasarana Sekolah</span></h1>
            
            <p>Sampaikan keluhan terkait kerusakan fasilitas sekolah dengan cepat dan transparan. Kami berkomitmen untuk menciptakan lingkungan belajar yang nyaman bagi setiap siswa.</p>

            <div class="cta-group">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Masuk ke Sistem</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline">Daftar Akun Baru</a>
                    @endif
                @endauth
            </div>
        </main>

        <footer>
            <p>&copy; {{ date('Y') }}Sistem Aspirasi Siswa Made By Sahyu XII RPL 2</p>
        </footer>
    </div>
</body>
</html>