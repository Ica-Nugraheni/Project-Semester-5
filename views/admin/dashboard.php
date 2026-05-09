<?php
use yii\helpers\Html;
use app\models\DashboardConfig;

$this->title = 'Dashboard';
?>
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1 class="welcome-title">
                <i class="fas fa-tachometer-alt"></i>
                Selamat Datang di Dashboard Admin
            </h1>
            <p class="welcome-subtitle">
                <i class="fas fa-calendar-alt"></i>
                <?= date('l, d F Y', strtotime('today')) ?>
            </p>
        </div>
        <div class="header-actions">
            <?php if (!Yii::$app->user->isGuest): ?>
                <?= Html::a('<i class="fas fa-edit"></i> Edit Dashboard', ['admin/edit-dashboard'], ['class'=>'btn btn-primary btn-lg']) ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Stats Overview -->
    <div class="quick-stats">
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number">87</div>
                <div class="stat-label">Total Guru</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number">1,234</div>
                <div class="stat-label">Total Siswa</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number">2,847</div>
                <div class="stat-label">Total Dokumen</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number">2,459</div>
                <div class="stat-label">Dokumen Diproses</div>
            </div>
        </div>
    </div>

    <?php
    // Try loading dashboard widgets from DB; fallback to hard-coded if none found
    try {
        $widgets = DashboardConfig::find()->where(['visible' => 1])->orderBy(['sort' => SORT_ASC])->all();
    } catch (\Throwable $e) {
        // Table may not exist (migration not run) or other DB error; fall back to defaults
        $widgets = [];
        \Yii::error('Dashboard config load failed: ' . $e->getMessage(), __METHOD__);
    }
    ?>

    <div class="metrics-grid enhanced">
        <?php if (!empty($widgets)):
            // show up to 4 widgets in the grid
            $shown = 0;
            foreach ($widgets as $w):
                if ($shown >= 4) break;
        ?>
            <div class="small-card enhanced">
                <div class="card-content">
                    <div class="metric-label"><?= Html::encode($w->label) ?></div>
                    <div class="metric-value"><?= Html::encode($w->value) ?></div>
                    <div class="metric-note"><?= Html::encode($w->note) ?></div>
                </div>
                <div class="metric-icon enhanced">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        <?php
                $shown++;
            endforeach;
            // if less than 4, you may render placeholders or leave empty
        else:
        ?>
        <div class="small-card enhanced">
            <div class="card-content">
                <div class="metric-label">Total Guru</div>
                <div class="metric-value">87</div>
                <div class="metric-note">+3 guru baru bulan ini</div>
            </div>
            <div class="metric-icon enhanced">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>

        <div class="small-card enhanced">
            <div class="card-content">
                <div class="metric-label">Total Siswa</div>
                <div class="metric-value">1,234</div>
                <div class="metric-note">+32 siswa baru tahun ini</div>
            </div>
            <div class="metric-icon enhanced">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>

        <div class="small-card enhanced">
            <div class="card-content">
                <div class="metric-label">Total Dokumen</div>
                <div class="metric-value">2,847</div>
                <div class="metric-note">+128 dokumen bulan ini</div>
            </div>
            <div class="metric-icon enhanced">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>

        <div class="small-card enhanced">
            <div class="card-content">
                <div class="metric-label">Dokumen Diterapkan</div>
                <div class="metric-value">2,459</div>
                <div class="metric-note">+1.2% dari total dokumen</div>
            </div>
            <div class="metric-icon enhanced">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="dashboard-content">
        <div class="row" style="margin-top:18px">
            <div class="col-md-6">
                <div class="card enhanced activity-card">
                    <div class="card-header">
                        <h4><i class="fas fa-history"></i> Aktivitas Terbaru</h4>
                    </div>
                    <div class="dashboard-activity">
                        <ul>
                            <li><strong>Tata Usaha</strong> menambah data guru baru - Drs. Ahmad Fauzi <span class="card-sub">5 menit lalu</span></li>
                            <li><strong>Tata Usaha</strong> mengunggah surat tugas mengajar <span class="card-sub">1 jam lalu</span></li>
                        </ul>
                    </div>
                </div>

                <div class="card progress-row progress-card enhanced">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-pie"></i> Statistik Dokumen per Kategori</h4>
                    </div>
                    <div class="table-header">
                        <h4 class="m-0">Data Dokumen</h4>
                        <div style="display:flex;gap:8px;align-items:center">
                            <input class="top-search" placeholder="Search..." />
                            <?= Html::a('<i class="fas fa-plus"></i> Create', ['/arsip-dokumen-guru/create'], ['class' => 'btn btn-toska']) ?>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                            <div><i class="fas fa-file-contract"></i> Surat Tugas</div>
                            <div class="card-sub">81%</div>
                        </div>
                        <div class="progress-track"><div class="progress-fill" style="width:81%"></div></div>
                    </div>

                    <div class="progress-item">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                            <div><i class="fas fa-graduation-cap"></i> Ijazah</div>
                            <div class="card-sub">97%</div>
                        </div>
                        <div class="progress-track"><div class="progress-fill" style="width:97%"></div></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card enhanced pending-card">
                    <div class="card-header">
                        <h4><i class="fas fa-clock"></i> Dokumen Menunggu Diproses</h4>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:10px">
                        <div class="pending-item high-priority">
                            <div>
                                <div style="font-weight:700"><i class="fas fa-exclamation-triangle"></i> SK Pengangkatan Guru Baru</div>
                                <div style="font-size:12px;color:var(--muted)">Prioritas: Tinggi</div>
                            </div>
                            <div style="display:flex;gap:8px;align-items:center">
                                <span class="badge primary">5 dokumen</span>
                                <?= Html::a('<i class="fas fa-eye"></i> Lihat', ['arsip-dokumen-guru/index'], ['class' => 'btn btn-sm btn-outline']) ?>
                            </div>
                        </div>

                        <div class="pending-item medium-priority">
                            <div>
                                <div style="font-weight:700"><i class="fas fa-tasks"></i> Surat Tugas Mengajar Semester Genap</div>
                                <div style="font-size:12px;color:var(--muted)">Prioritas: Sedang</div>
                            </div>
                            <div style="display:flex;gap:8px;align-items:center">
                                <span class="badge primary">12 dokumen</span>
                                <?= Html::a('<i class="fas fa-eye"></i> Lihat', ['arsip-dokumen-guru/index'], ['class' => 'btn btn-sm btn-outline']) ?>
                            </div>
                        </div>

                        <div class="pending-item low-priority">
                            <div>
                                <div style="font-weight:700"><i class="fas fa-certificate"></i> Sertifikat Pelatihan Guru</div>
                                <div style="font-size:12px;color:var(--muted)">Prioritas: Rendah</div>
                            </div>
                            <div style="display:flex;gap:8px;align-items:center">
                                <span class="badge primary">3 dokumen</span>
                                <?= Html::a('<i class="fas fa-eye"></i> Lihat', ['arsip-dokumen-guru/index'], ['class' => 'btn btn-sm btn-outline']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card table-wrap enhanced" style="margin-top:12px">
                    <div class="card-header">
                        <h4 class="m-0"><i class="fas fa-file-alt"></i> Data Dokumen Terbaru</h4>
                        <div style="display:flex;gap:8px;align-items:center">
                            <input class="top-search" placeholder="Search..." />
                            <?= Html::a('<i class="fas fa-plus"></i> Create', ['/arsip-dokumen-guru/create'], ['class' => 'btn btn-toska']) ?>
                        </div>
                    </div>

                    <table class="table enhanced">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="fas fa-heading"></i> Judul</th>
                                <th><i class="fas fa-tag"></i> Jenis</th>
                                <th><i class="fas fa-calendar"></i> Tanggal</th>
                                <th><i class="fas fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dokumenTerbaru)): ?>
                                <?php foreach ($dokumenTerbaru as $index => $doc): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= Html::encode($doc['judul']) ?></td>
                                        <td><?= Html::encode($doc['jenis']) ?></td>
                                        <td><?= Html::encode($doc['tanggal']) ?></td>
                                        <td>
                                            <?php if ($doc['type'] === 'guru'): ?>
                                                <?= Html::a('<i class="fas fa-external-link-alt"></i> Open', ['file/view-guru', 'filename' => $doc['filename']], ['class' => 'btn btn-sm', 'style' => 'background:var(--primary);color:#fff;border-radius:6px;border:none;padding:6px 10px', 'target' => '_blank']) ?>
                                            <?php else: ?>
                                                <?= Html::a('<i class="fas fa-external-link-alt"></i> Open', ['file/view-siswa', 'filename' => $doc['filename']], ['class' => 'btn btn-sm', 'style' => 'background:var(--primary);color:#fff;border-radius:6px;border:none;padding:6px 10px', 'target' => '_blank']) ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;"><i class="fas fa-inbox"></i> Belum ada dokumen</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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

.header-actions .btn {
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    font-weight: 600;
    padding: 12px 25px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.header-actions .btn:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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

/* Enhanced Metrics Grid */
.metrics-grid.enhanced {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.small-card.enhanced {
    background: white;
    border-radius: 15px;
    padding: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.small-card.enhanced:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.card-content {
    flex: 1;
}

.metric-label {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 5px;
    font-weight: 500;
}

.metric-value {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}

.metric-note {
    font-size: 0.8rem;
    color: #888;
}

.metric-icon.enhanced {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    background: var(--primary);
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

/* Activity Card */
.activity-card .dashboard-activity ul li {
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.activity-card .dashboard-activity ul li:hover {
    background: #f8f9fa;
    padding-left: 10px;
    border-radius: 5px;
}

/* Progress Card */
.progress-card .progress-item {
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.progress-card .progress-item:hover {
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

/* Pending Documents */
.pending-card .pending-item {
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.pending-item:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.high-priority {
    background: var(--light);
    border-left: 4px solid var(--primary);
}

.medium-priority {
    background: var(--light);
    border-left: 4px solid var(--primary);
}

.low-priority {
    background: var(--light);
    border-left: 4px solid var(--primary);
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

/* Button Enhancements */
.btn-toska {
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    border: none !important;
    border-radius: 25px !important;
    padding: 8px 20px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}

.btn-toska:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}

/* Badge Enhancements */
.badge {
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-weight: 600 !important;
    font-size: 0.8rem !important;
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

    .metrics-grid.enhanced {
        grid-template-columns: 1fr;
    }

    .stat-item {
        padding: 20px;
    }
}
</style>
