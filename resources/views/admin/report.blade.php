<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan Prasarana Sekolah</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">
    <style>
        /* Root */
:root {
    --primary: #111827;
    --border: #D1D5DB;
    --text: #111827;
    --text-muted: #6B7280;
}

/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body */
body {
    font-family: 'Inter', sans-serif;
    color: var(--text);
    background: #fff;
    padding: 2rem;
    line-height: 1.6;
}

/* Judul */
h1 {
    font-family: 'Playfair Display', serif;
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
}

/* Subjudul */
.subtitle {
    text-align: center;
    font-size: 0.9rem;
    color: var(--text-muted);
    margin-bottom: 0.3rem;
}

/* Tombol */
.no-print {
    margin-bottom: 1.5rem;
}

.btn-print {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #111827;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    margin: 0.25rem;
}

.btn-print:hover {
    opacity: 0.85;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1.5rem;
    font-size: 0.85rem;
}

thead {
    background: #F3F4F6;
}

th, td {
    border: 1px solid var(--border);
    padding: 0.6rem;
    vertical-align: top;
}

th {
    text-align: center;
    font-weight: 600;
}

/* Text helper */
.text-center {
    text-align: center;
}

/* Badge */
.badge {
    display: inline-block;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-size: 0.7rem;
    background: #E5E7EB;
    font-weight: 600;
}

/* HR */
hr {
    margin: 0.5rem 0;
    border: none;
    border-top: 1px dashed var(--border);
}

/* Footer tanda tangan */
.signature {
    margin-top: 50px;
    text-align: right;
    font-size: 0.85rem;
}

/* PRINT STYLE */
@media print {
    body {
        padding: 0;
        font-size: 12px;
    }

    .no-print {
        display: none !important;
    }

    table {
        font-size: 11px;
    }

    h1 {
        font-size: 16px;
    }

    .subtitle {
        font-size: 11px;
    }

    .badge {
        background: none;
        border: 1px solid #000;
        color: #000;
    }
}
    </style>
</head>

<body>
    <div class="no-print" style="text-align: center;">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak Dokumen</button>
        <a href="{{ route('admin.dashboard') }}" class="btn-print" style="background: #666;">Kembali ke Dasbor</a>
    </div>

    <h1>Laporan Rekapitulasi Pengaduan Siswa</h1>
    <div class="subtitle">Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</div>
    <div class="subtitle">Dicetak Oleh: {{ Auth::user()->name }} ({{ Auth::user()->role }})</div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal Pelaporan</th>
                <th width="20%">Data Pelapor</th>
                <th width="35%">Isi Aduan & Tanggapan</th>
                <th width="25%">Status & Riwayat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $index => $c)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->date)->translatedFormat('d M Y') }}</td>
                    <td>
                        <b>{{ $c->user->name }}</b><br>
                        NIK: {{ $c->user->nik }}<br>
                        Telp: {{ $c->user->phone }}
                    </td>
                    <td>
                        <b>Judul: {{ $c->title }}</b><br>
                        <p style="margin:5px 0;">{{ $c->description }}</p>
                        <hr>
                        @if($c->responses->count() > 0)
                            <b>Dibalas oleh: {{ $c->responses->last()->user->name }}</b><br>
                            <i>"{{ $c->responses->last()->response }}"</i>
                        @else
                            <i>Belum ada tanggapan</i>
                        @endif
                    </td>
                    <td>
                        Status: <span class="badge">{{ strtoupper($c->status) }}</span><br>
                        Terakhir diubah: {{ $c->updated_at->diffForHumans() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right; font-size: 14px;">
        <p>Mengetahui,</p>
        <p style="margin-top: 80px;">___________________________</p>
        <p>Admin Sistem</p>
    </div>
</body>

</html>