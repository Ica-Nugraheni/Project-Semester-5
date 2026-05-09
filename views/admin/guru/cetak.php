<?php
use yii\helpers\Html;

// Hanya CSS untuk cetak
$css = <<<CSS
    <style>
        @page { margin: 1cm; }
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 16pt; margin-bottom: 5px; }
        .header h3 { font-size: 12pt; margin-top: 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2 !important; font-weight: bold; }
        th, td { border: 1px solid #000; padding: 6px; }
        .ttd { margin-top: 50px; float: right; text-align: center; }
        .no-print { display: none; }
        
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
CSS;

echo $css;
?>

<div class="print-area">
    <div class="header">
        <h1>LAPORAN DATA GURU</h1>
        <h3>TAHUN AJARAN 2024/2025</h3>
        <hr style="border-top: 2px solid #000;">
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>NIP</th>
                <th>Mata Pelajaran</th>
                <th>No. Telepon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $models = $dataProvider->getModels();
            foreach ($models as $index => $model): 
            ?>
            <tr>
                <td align="center"><?= $index + 1 ?></td>
                <td><?= Html::encode($model->nama_guru) ?></td>
                <td><?= Html::encode($model->nip) ?></td>
                <td><?= Html::encode($model->jabatan) ?></td>
                <td><?= Html::encode($model->no_telp) ?></td>
                <td align="center">Aktif</td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($models)): ?>
            <tr>
                <td colspan="6" align="center">Tidak ada data</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<!-- Tombol cetak hanya muncul di browser -->
<div class="no-print" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
    <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
        🖨️ Cetak Halaman Ini
    </button>
    <button onclick="window.close()" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">
        ✕ Tutup
    </button>
</div>