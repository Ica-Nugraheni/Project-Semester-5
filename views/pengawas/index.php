<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\ArsipDokumenGuru;
use app\models\ArsipDokumenSiswa;

$this->title = 'Dashboard Pengawas';
?>

<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1 class="welcome-title">
                <i class="fas fa-eye"></i>
                Dashboard Pengawas
            </h1>
            <p class="welcome-subtitle">
                <i class="fas fa-calendar-alt"></i>
                Monitoring dan pengawasan sistem e-arsip dokumen
            </p>
        </div>
        <div class="header-actions">
            <div class="date-display">
                <i class="fas fa-calendar-day"></i>
                <?= date('d F Y') ?>
            </div>
        </div>
    </div>

    <!-- Quick Stats Overview -->
    <div class="quick-stats">
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number"><?= number_format($totalDokumen, 0, ',', '.') ?></div>
                <div class="stat-label">Total Dokumen</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number"><?= number_format(ArsipDokumenGuru::find()->count(), 0, ',', '.') ?></div>
                <div class="stat-label">Dokumen Guru</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number"><?= number_format(ArsipDokumenSiswa::find()->count(), 0, ',', '.') ?></div>
                <div class="stat-label">Dokumen Siswa</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number"><?= number_format($totalUserAktif, 0, ',', '.') ?></div>
                <div class="stat-label">User Aktif</div>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="row" style="margin-top: 20px;">
            <!-- Dokumen Terbaru -->
            <div class="col-md-8">
                <div class="card enhanced documents-card">
                    <div class="card-header">
                        <h4 class="m-0"><i class="fas fa-file-alt"></i> Dokumen Terbaru</h4>
                        <div style="display: flex; gap: 8px;">
                            <?= Html::a('<i class="fas fa-users"></i> Lihat Semua Guru', ['/arsip-dokumen-guru/index'], ['class' => 'btn btn-sm btn-outline-secondary']) ?>
                            <?= Html::a('<i class="fas fa-user-graduate"></i> Lihat Semua Siswa', ['/arsip-dokumen-siswa/index'], ['class' => 'btn btn-sm btn-outline-secondary']) ?>
                        </div>
                    </div>

                    <?php if (!empty($dokumenTerbaru)): ?>
                    <div class="table-responsive">
                        <table class="table enhanced">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> No</th>
                                    <th><i class="fas fa-heading"></i> Judul Dokumen</th>
                                    <th><i class="fas fa-tag"></i> Kategori</th>
                                    <th><i class="fas fa-user"></i> Pemilik</th>
                                    <th><i class="fas fa-calendar"></i> Tanggal</th>
                                    <th><i class="fas fa-download"></i> File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dokumenTerbaru as $index => $item): ?>
                                    <?php
                                    $doc = $item['data'];
                                    $isGuru = $item['type'] === 'guru';
                                    $pemilik = $isGuru ? ($doc->guru ? $doc->guru->nama_guru : '-') : ($doc->siswa ? $doc->siswa->nama_siswa : '-');
                                    $kategori = $doc->jenis ? $doc->jenis->nama_jenis : '-';
                                    ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= Html::encode($doc->judul_dokumen) ?></td>
                                        <td>
                                            <span class="badge primary">
                                                <?= Html::encode($kategori) ?>
                                            </span>
                                        </td>
                                        <td><?= Html::encode($pemilik) ?></td>
                                        <td><?= date('d M Y', strtotime($doc->tanggal_upload)) ?></td>
                                        <td>
                                            <?php if ($doc->file_path): ?>
                                                <?php
                                                $filePath = Yii::getAlias('@webroot') . '/' . $doc->file_path;
                                                if (file_exists($filePath)):
                                                ?>
                                                    <?php if ($isGuru): ?>
                                                        <?= Html::a('<i class="fas fa-download"></i> Download', ['/file/download-guru', 'filename' => basename($doc->file_path)], [
                                                            'class' => 'btn btn-sm btn-link',
                                                            'target' => '_blank'
                                                        ]) ?>
                                                    <?php else: ?>
                                                        <?= Html::a('<i class="fas fa-download"></i> Download', ['/file/download-siswa', 'filename' => basename($doc->file_path)], [
                                                            'class' => 'btn btn-sm btn-link',
                                                            'target' => '_blank'
                                                        ]) ?>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span style="color: #dc3545;"><i class="fas fa-exclamation-triangle"></i> File tidak ditemukan</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Belum ada dokumen</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Statistik Kategori & Quick Links -->
            <div class="col-md-4">
                <div class="card enhanced stats-card">
                    <div class="card-header">
                        <h4 class="m-0"><i class="fas fa-chart-pie"></i> Statistik per Kategori</h4>
                    </div>
                    <div id="kategori-container">
                    <?php if (!empty($kategoriStats)): ?>
                        <?php foreach (array_slice($kategoriStats, 0, 5) as $stat): ?>
                            <div class="progress-item">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <div style="font-size: 13px; font-weight: 500;"><?= Html::encode($stat['jenis']->nama_jenis) ?></div>
                                    <div style="font-size: 12px; color: #6b7280;"><?= $stat['total'] ?> dokumen</div>
                                </div>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width: <?= $stat['persentase'] ?>%"></div>
                                </div>
                                <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">
                                    <?= $stat['persentase'] ?>% dari total
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-chart-bar"></i>
                            <p>Belum ada data kategori</p>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card enhanced links-card" style="margin-top: 16px;">
                    <div class="card-header">
                        <h4 class="m-0"><i class="fas fa-link"></i> Fitur Utama</h4>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <?= Html::a('<i class="fas fa-chalkboard-teacher"></i> Data Guru', ['/guru/index'], [
                            'class' => 'btn btn-sm btn-outline-primary quick-link'
                        ]) ?>
                        <?= Html::a('<i class="fas fa-user-graduate"></i> Data Siswa', ['/siswa/index'], [
                            'class' => 'btn btn-sm btn-outline-primary quick-link'
                        ]) ?>
                        <?= Html::a('<i class="fas fa-file-alt"></i> Arsip Dokumen Guru', ['/arsip-dokumen-guru/index'], [
                            'class' => 'btn btn-sm btn-outline-primary quick-link'
                        ]) ?>
                        <?= Html::a('<i class="fas fa-file-alt"></i> Arsip Dokumen Siswa', ['/arsip-dokumen-siswa/index'], [
                            'class' => 'btn btn-sm btn-outline-primary quick-link'
                        ]) ?>
                        <?= Html::a('<i class="fas fa-chart-line"></i> Laporan', ['/pengawas/laporan'], [
                            'class' => 'btn btn-sm btn-outline-success quick-link'
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Header Styles */
.dashboard-header {
    background: var(--primary);
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.welcome-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 15px;
}

.welcome-title i {
    color: #ffd700;
    font-size: 2.5rem;
}

.welcome-subtitle {
    font-size: 1.1rem;
    margin: 5px 0 0 0;
    opacity: 0.9;
    display: flex;
    align-items: center;
    gap: 10px;
}

.date-display {
    font-size: 1.1rem;
    opacity: 0.9;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Quick Stats Styles */
.quick-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-item {
    background: white;
    border-radius: 15px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    background: var(--primary);
}

.stat-number {
    font-size: 2.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.95rem;
    color: #666;
    font-weight: 500;
}

/* Enhanced Cards */
.card.enhanced {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s ease;
}

.card.enhanced:hover {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.card-header {
    background: var(--light);
    padding: 20px 25px;
    border-bottom: 1px solid #dee2e6;
    margin: -20px -25px 20px -25px;
}

.card-header h4 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header h4 i {
    color: var(--primary);
}

/* Enhanced Table */
.table.enhanced {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.table.enhanced thead th {
    background: var(--primary);
    color: white;
    border: none;
    padding: 15px;
    font-weight: 600;
    font-size: 0.9rem;
}

.table.enhanced tbody tr {
    transition: all 0.3s ease;
}

.table.enhanced tbody tr:hover {
    background: #f8f9fa;
    transform: scale(1.01);
}

.table.enhanced tbody td {
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: middle;
}

/* Progress Items */
.progress-item {
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.progress-item:hover {
    background: #e9ecef;
}

.progress-track {
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: var(--primary);
    border-radius: 4px;
    transition: width 0.8s ease;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6b7280;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

.empty-state p {
    margin: 0;
    font-size: 1.1rem;
}

/* Quick Links */
.quick-link {
    text-align: left !important;
    justify-content: flex-start !important;
    transition: all 0.3s ease !important;
}

.quick-link:hover {
    transform: translateX(5px) !important;
}

/* Badge Enhancements */
.badge.primary {
    background: var(--primary) !important;
    color: white !important;
}

/* Button Enhancements */
.btn-outline-secondary {
    border-color: #d1d5db !important;
    color: #6b7280 !important;
    transition: all 0.3s ease !important;
}

.btn-outline-secondary:hover {
    background: var(--light) !important;
    color: #374151 !important;
    transform: translateY(-2px) !important;
}

.btn-outline-primary {
    border-color: var(--primary) !important;
    color: var(--primary) !important;
    transition: all 0.3s ease !important;
}

.btn-outline-primary:hover {
    background: var(--primary) !important;
    color: white !important;
    transform: translateY(-2px) !important;
}

.btn-outline-success {
    border-color: #10b981 !important;
    color: #10b981 !important;
    transition: all 0.3s ease !important;
}

.btn-outline-success:hover {
    background: #10b981 !important;
    color: white !important;
    transform: translateY(-2px) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }

    .welcome-title {
        font-size: 1.8rem;
    }

    .quick-stats {
        grid-template-columns: 1fr;
    }

    .stat-item {
        padding: 20px;
    }
}
</style>

<script>
function updateMetrics() {
    fetch('<?= Url::to(['pengawas/metrics']) ?>', {
        credentials: 'same-origin'
    })
        .then(response => response.json())
        .then(data => {
            const cards = document.querySelectorAll('.metrics-grid .small-card');
            if (cards.length >= 4) {
                // Total Dokumen
                const totalValue = cards[0].querySelector('.metric-value');
                const totalNote = cards[0].querySelector('.metric-note');
                if (totalValue) totalValue.textContent = data.totalDokumen.toString();
                if (totalNote) totalNote.textContent = data.dokumenBulanIni.toString() + ' dokumen bulan ini';
                
                // Dokumen Guru
                const guruValue = cards[1].querySelector('.metric-value');
                const guruNote = cards[1].querySelector('.metric-note');
                if (guruValue) guruValue.textContent = data.totalDokumenGuru.toString();
                if (guruNote) guruNote.textContent = 'Dari ' + data.totalGuru.toString() + ' guru';
                
                // Dokumen Siswa
                const siswaValue = cards[2].querySelector('.metric-value');
                const siswaNote = cards[2].querySelector('.metric-note');
                if (siswaValue) siswaValue.textContent = data.totalDokumenSiswa.toString();
                if (siswaNote) siswaNote.textContent = 'Dari ' + data.totalSiswa.toString() + ' siswa';
                
                // Total User Aktif
                const userValue = cards[3].querySelector('.metric-value');
                if (userValue) userValue.textContent = data.totalUserAktif.toString();
                
                // Update Kategori
                updateKategori(data.kategoriStats);
            }
        })
        .catch(error => console.error('Error updating metrics:', error));
}

function updateKategori(kategoriStats) {
    const container = document.getElementById('kategori-container');
    if (!container) return;
    
    if (!kategoriStats || kategoriStats.length === 0) {
        container.innerHTML = '<p style="color: #6b7280; text-align: center; padding: 20px;">Belum ada data kategori</p>';
        return;
    }
    
    let html = '';
    kategoriStats.forEach(stat => {
        html += `
            <div class="progress-item" style="margin-bottom: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <div style="font-size: 13px; font-weight: 500;">${stat.nama_jenis}</div>
                    <div style="font-size: 12px; color: #6b7280;">${stat.total} dokumen</div>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: ${stat.persentase}%"></div>
                </div>
                <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">
                    ${stat.persentase}% dari total
                </div>
            </div>
        `;
    });
    container.innerHTML = html;
}

// Update setiap 30 detik
setInterval(updateMetrics, 30000);
</script>
