@extends('layouts.app')
@section('title', 'Dasbor Siswa - Pengaduan Prasarana Sekolah')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container">
    
    <div class="header">
        <h1>Dashboard Pengaduan</h1>
        <p>Selamat datang, silakan sampaikan keluhan prasarana Anda.</p>
    </div>

    <div class="main-grid">
        
        <!-- FORM -->
        <div class="stat-card sticky-card">
            <h2>
                <i class="bi bi-pencil-square text-primary"></i> Buat Pengaduan
            </h2>
            <p class="text-muted">Sampaikan laporan dengan detail.</p>

            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Judul Laporan</label>
                    <input type="text" name="title" class="form-control-reply" required>
                </div>

                <div class="form-group">
                    <label>Lokasi Fasilitas</label>
                    <input type="text" name="location" class="form-control-reply" required>
                </div>

                <div class="form-group">
                    <label>Detail Kerusakan</label>
                    <textarea name="description" class="form-control-reply" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Lampiran Foto</label>
                    <input type="file" name="photo" class="form-control-reply" accept="image/*">
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-send"></i> Kirim Pengaduan
                </button>
            </form>
        </div>

        <!-- LIST -->
        <div>
            <div class="section-header">
                <h2>
                    <i class="bi bi-clock-history text-primary"></i> Riwayat Laporan
                </h2>
                <span class="count-badge">
                    {{ $complaints->count() }} Laporan
                </span>
            </div>

            @if($complaints->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h3>Belum Ada Laporan</h3>
                    <p>Laporan yang Anda kirimkan akan muncul di sini.</p>
                </div>
            @else
                <div class="card-grid">
                    @foreach($complaints as $c)

                        @php
                            $statusClass = match($c->status) {
                                'pending' => 'badge-pending',
                                'processing' => 'badge-processing',
                                default => 'badge-done',
                            };

                            $statusText = match($c->status) {
                                'pending' => 'MENUNGGU',
                                'processing' => 'DIPROSES',
                                default => 'SELESAI',
                            };
                        @endphp

                        <div class="stat-card complaint-card">

                            <div class="card-header">
                                <span class="badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>

                                <small>
                                    {{ \Carbon\Carbon::parse($c->date)->locale('id')->translatedFormat('d M Y') }}
                                </small>
                            </div>

                            <h3>{{ $c->title }}</h3>

                            <div class="location">
                                <i class="bi bi-geo-alt text-primary"></i> {{ $c->location }}
                            </div>

                            @if($c->photo)
                                <div class="image-wrapper">
                                    <img src="{{ asset($c->photo) }}">
                                </div>
                            @endif

                            <p class="description">
                                {{ Str::limit($c->description, 90) }}
                            </p>

                            <div class="response-section">
                                @if($c->responses->count() > 0)
                                    <div class="response-box">
                                        <div class="response-title">
                                            Tanggapan Petugas:
                                        </div>
                                        <p>
                                            "{{ $c->responses->last()->response }}"
                                        </p>
                                    </div>
                                @else
                                    <div class="waiting">
                                        <i class="bi bi-hourglass-split"></i> Menunggu tanggapan...
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
@endsection