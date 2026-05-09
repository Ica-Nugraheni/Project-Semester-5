<?php
use yii\helpers\Html;

$this->title = 'Laporan Sistem';
?>

<div class="container-fluid">
    <!-- Header -->
    <div class="card" style="margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0 0 4px 0;">
                    Laporan Sistem E-Arsip
                </h1>
                <p style="color: #6b7280; font-size: 14px; margin: 0;">
                    Ringkasan dan statistik keseluruhan sistem
                </p>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="font-size: 13px; color: #6b7280;">
                    <?= date('d F Y') ?>
                </div>
                <?= Html::a('Cetak Laporan', ['#'], [
                    'class' => 'btn btn-sm btn-primary',
                    'onclick' => 'window.print()'
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Ringkasan -->
    <div class="metrics-grid" style="margin-bottom: 20px;">
        <div class="small-card">
            <div>
                <div class="metric-label">Total Dokumen</div>
                <div class="metric-value"><?= number_format($totalDokumen, 0, ',', '.') ?></div>
                <div class="metric-note">Dokumen tersimpan</div>
            </div>
            <div class="metric-icon" style="background: #dbeafe; color: #2563eb;">📊</div>
        </div>

        <div class="small-card">
            <div>
                <div class="metric-label">Total Guru</div>
                <div class="metric-value"><?= number_format($totalGuru, 0, ',', '.') ?></div>
                <div class="metric-note">Data guru aktif</div>
            </div>
            <div class="metric-icon" style="background: #fef3c7; color: #d97706;">👨‍🏫</div>
        </div>

        <div class="small-card">
            <div>
                <div class="metric-label">Total Siswa</div>
                <div class="metric-value"><?= number_format($totalSiswa, 0, ',', '.') ?></div>
                <div class="metric-note">Data siswa aktif</div>
            </div>
            <div class="metric-icon" style="background: #ecfdf3; color: #16a34a;">👨‍🎓</div>
        </div>

        <div class="small-card">
            <div>
                <div class="metric-label">Total User</div>
                <div class="metric-value"><?= number_format($totalUser, 0, ',', '.') ?></div>
                <div class="metric-note">Semua pengguna sistem</div>
            </div>
            <div class="metric-icon" style="background: #f3e8ff; color: #9333ea;">👥</div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <!-- Tren Dokumen per Bulan -->
        <div class="col-md-8">
            <div class="card">
                <h4 style="margin: 0 0 16px 0; font-weight: 600; color: #1f2937;">Tren Upload Dokumen (6 Bulan Terakhir)</h4>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Total Dokumen</th>
                                <th>Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $maxTotal = max(array_column($laporanBulan, 'total'));
                            foreach ($laporanBulan as $laporan):
                            ?>
                                <tr>
                                    <td><?= Html::encode($laporan['bulan']) ?></td>
                                    <td><?= number_format($laporan['total'], 0, ',', '.') ?></td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                 style="width: <?= $maxTotal > 0 ? ($laporan['total'] / $maxTotal) * 100 : 0 ?>%"
                                                 aria-valuenow="<?= $laporan['total'] ?>" aria-valuemin="0" aria-valuemax="<?= $maxTotal ?>">
                                                <?= $maxTotal > 0 ? round(($laporan['total'] / $maxTotal) * 100, 1) : 0 ?>%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Distribusi per Kategori -->
        <div class="col-md-4">
            <div class="card">
                <h4 style="margin: 0 0 16px 0; font-weight: 600; color: #1f2937;">Distribusi Dokumen per Kategori</h4>

                <?php if (!empty($kategoriStats)): ?>
                    <?php
                    $totalKategori = array_sum(array_column($kategoriStats, 'total'));
                    foreach ($kategoriStats as $stat):
                        $persentase = $totalKategori > 0 ? round(($stat['total'] / $totalKategori) * 100, 1) : 0;
                    ?>
                        <div class="progress-item" style="margin-bottom: 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <div style="font-size: 13px; font-weight: 500;"><?= Html::encode($stat['kategori']) ?></div>
                                <div style="font-size: 12px; color: #6b7280;"><?= $stat['total'] ?> dokumen</div>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width: <?= $persentase ?>%"></div>
                            </div>
                            <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">
                                <?= $persentase ?>% dari total
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: #6b7280; text-align: center; padding: 20px;">Belum ada data kategori</p>
                <?php endif; ?>
            </div>

            <!-- Ringkasan Sistem -->
            <div class="card" style="margin-top: 16px;">
                <h4 style="margin: 0 0 16px 0; font-weight: 600; color: #1f2937;">Ringkasan Sistem</h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="font-size: 14px; color: #6b7280;">Rata-rata dokumen per bulan</span>
                        <span style="font-size: 14px; font-weight: 600; color: #1f2937;">
                            <?= count($laporanBulan) > 0 ? number_format(array_sum(array_column($laporanBulan, 'total')) / count($laporanBulan), 1, ',', '.') : 0 ?>
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="font-size: 14px; color: #6b7280;">Kategori dokumen aktif</span>
                        <span style="font-size: 14px; font-weight: 600; color: #1f2937;"><?= count($kategoriStats) ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="font-size: 14px; color: #6b7280;">Status sistem</span>
                        <span style="font-size: 14px; font-weight: 600; color: #16a34a;">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
}

.small-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.small-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.metric-label {
    color: #6b7280;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 4px;
}

.metric-value {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 4px;
}

.metric-note {
    color: #9ca3af;
    font-size: 12px;
}

.metric-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
}

.progress-item {
    margin-bottom: 12px;
}

.progress-track {
    width: 100%;
    height: 8px;
    background: #f3f4f6;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #66BB7A 0%, #5aa769 100%);
    border-radius: 4px;
    transition: width 0.3s ease;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f9fafb;
    font-weight: 600;
    color: #374151;
    padding: 12px;
    text-align: left;
    font-size: 12px;
    text-transform: uppercase;
    border-bottom: 2px solid #e5e7eb;
}

.table td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 13px;
    color: #1f2937;
}

.table tbody tr:hover {
    background: #f9fafb;
}

.btn-primary {
    background: #2563eb;
    color: #fff;
    border: 1px solid #2563eb;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
}

.btn-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
    color: #fff;
}

@media print {
    .btn, .card:first-child {
        display: none !important;
    }
}
</style>