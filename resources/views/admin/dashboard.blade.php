@extends('layouts.app')
@section('title', 'Dasbor Admin - Pengaduan Prasarana Sekolah')

@section('content')
<div class="admin-dashboard">
    <header class="dashboard-header">
        <div class="header-titles">
            <h1>Panel Kendali Admin</h1>
            <p><i class="bi bi-cpu"></i> Status Sistem: <span class="status-online">Berjalan Baik</span> | Total Laporan: <strong>{{ $complaints->count() }}</strong></p>
        </div>
        <div class="header-actions">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.report') }}" target="_blank" class="btn btn-outline-primary">
                    <i class="bi bi-printer"></i> Cetak Laporan PDF
                </a>
            @endif
        </div>
    </header>

    <div class="stats-grid">
        <div class="stat-card warning">
            <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
            <div class="stat-info">
                <h3>Menunggu</h3>
                <p class="stat-value">{{ $pending }}</p>
            </div>
        </div>
        <div class="stat-card info">
            <div class="stat-icon"><i class="bi bi-gear-wide-connected"></i></div>
            <div class="stat-info">
                <h3>Diproses</h3>
                <p class="stat-value">{{ $processing }}</p>
            </div>
        </div>
        <div class="stat-card success">
            <div class="stat-icon"><i class="bi bi-check2-all"></i></div>
            <div class="stat-info">
                <h3>Selesai</h3>
                <p class="stat-value">{{ $resolved }}</p>
            </div>
        </div>
    </div>

    <div class="table-container shadow-soft">
        <div class="table-header">
            <h2><i class="bi bi-list-task"></i> Daftar Pengaduan Masuk</h2>
        </div>

        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelapor</th>
                        <th>Informasi Laporan</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Manajemen Balasan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $c)
                        <tr>
                            <td>
                                <span class="complaint-id">#{{ str_pad($c->id, 4, '0', STR_PAD_LEFT) }}</span>
                                <form action="{{ route('complaints.destroy', $c->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn-icon-delete" onclick="return confirm('Hapus pengaduan ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>

                            <td>
                                <div class="user-info">
                                    <strong>{{ $c->user->name }}</strong>
                                    <span>NIS: {{ $c->user->nik }}</span>
                                </div>
                            </td>

                            <td>
                                <div class="report-content">
                                    <span class="location-tag"><i class="bi bi-geo-alt"></i> {{ $c->location }}</span>
                                    <p class="report-title">{{ $c->title }}</p>
                                    <p class="report-text">{{ Str::limit($c->description, 80) }}</p>
                                </div>
                            </td>

                            <td class="text-center">
                                @if($c->photo)
                                    <a href="{{ asset($c->photo) }}" target="_blank" class="image-preview-link">
                                        <img src="{{ asset($c->photo) }}" class="img-thumbnail">
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('complaints.updateStatus', $c->id) }}" method="POST" class="status-form">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="status-select {{ $c->status }}">
                                        <option value="pending" {{ $c->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $c->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                        <option value="resolved" {{ $c->status == 'resolved' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>

                            <td>
                                <div class="response-manager">
                                    @if($c->responses->count() > 0)
                                        <div class="existing-responses">
                                            @foreach($c->responses as $resp)
                                                <div class="response-bubble">
                                                    <div class="response-top">
                                                        <strong>Admin: {{ $resp->user->username }}</strong>
                                                        <form action="{{ route('responses.destroy', $resp->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="close-btn" onclick="return confirm('Hapus balasan?')">&times;</button>
                                                        </form>
                                                    </div>
                                                    <p>{{ $resp->response }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if($c->status != 'resolved')
                                        <form action="{{ route('responses.store') }}" method="POST" class="quick-reply-form">
                                            @csrf
                                            <input type="hidden" name="complaint_id" value="{{ $c->id }}">
                                            <textarea name="response" placeholder="Balas pengaduan..." required></textarea>
                                            <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-row">Belum ada pengaduan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection