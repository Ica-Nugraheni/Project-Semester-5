<?php
use yii\helpers\Html;

$this->title = 'Dashboard';
?>

<div class="dashboard-petugas">
    <div class="card" style="margin-bottom:16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
                <div style="font-size:20px;font-weight:700;color:#1f2937;">Laporan Singkat</div>
                <div style="color:#6b7280;font-size:13px;">Ringkasan aktivitas petugas</div>
            </div>
            <div style="font-size:13px;color:#6b7280;">Hari ini</div>
        </div>
    </div>

    <div class="grid-4" style="margin-bottom:16px;">
        <div class="card mini-card">
            <div class="mini-icon" style="background:#e0f2fe;color:#0284c7;">📥</div>
            <div>
                <div style="color:#6b7280;font-size:12px;">Upload Hari Ini</div>
                <div style="font-size:18px;font-weight:700;">12</div>
            </div>
        </div>
        <div class="card mini-card">
            <div class="mini-icon" style="background:#ecfdf3;color:#16a34a;">📦</div>
            <div>
                <div style="color:#6b7280;font-size:12px;">Dokumen Selesai</div>
                <div style="font-size:18px;font-weight:700;">38</div>
            </div>
        </div>
        <div class="card mini-card">
            <div class="mini-icon" style="background:#fef3c7;color:#d97706;">⏳</div>
            <div>
                <div style="color:#6b7280;font-size:12px;">Butuh Tinjauan</div>
                <div style="font-size:18px;font-weight:700;">7</div>
            </div>
        </div>
        <div class="card mini-card">
            <div class="mini-icon" style="background:#f5f3ff;color:#7c3aed;">👤</div>
            <div>
                <div style="color:#6b7280;font-size:12px;">Pengguna Aktif</div>
                <div style="font-size:18px;font-weight:700;">5</div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom:16px;min-height:200px;">
        <div class="card-title">Aktivitas Upload Minggu Ini</div>
        <div class="placeholder-chart">[Chart Column]</div>
    </div>

    <div class="card">
        <div class="card-title">Dokumen Terbaru</div>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nama Dokumen</th>
                        <th>Kategori</th>
                        <th>Uploader</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>SK Guru 2024</td><td>SK Guru</td><td>Admin TU</td><td>12 Jun</td><td><span style="color:#16a34a;">Tersimpan</span></td></tr>
                    <tr><td>Surat Tugas A</td><td>Surat Tugas</td><td>Petugas A</td><td>11 Jun</td><td><span style="color:#f59e0b;">Tinjau</span></td></tr>
                    <tr><td>Ijazah Siswa X</td><td>Ijazah</td><td>Petugas B</td><td>11 Jun</td><td><span style="color:#16a34a;">Tersimpan</span></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.dashboard-petugas .card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 16px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
}
.grid-4 { display:grid; grid-template-columns: repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
.mini-card { display:flex; align-items:center; gap:12px; }
.mini-icon { width:44px; height:44px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700; }
.card-title { font-weight:600; color:#1f2937; margin-bottom:12px; }
.placeholder-chart { background:#f3f4f6; border:1px dashed #e5e7eb; border-radius:8px; height:140px; display:flex; align-items:center; justify-content:center; color:#9ca3af; }
.table-responsive { width:100%; overflow-x:auto; }
.table { width:100%; border-collapse: collapse; }
.table th, .table td { padding:8px 10px; border-bottom:1px solid #e5e7eb; font-size:13px; }
.table th { background:#f9fafb; font-weight:600; color:#374151; }
</style>

