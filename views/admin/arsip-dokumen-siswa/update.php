<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenSiswa $model */

$this->title = 'Update Arsip Dokumen Siswa: ' . $model->id_arsip_siswa;
$this->params['breadcrumbs'][] = ['label' => 'Arsip Dokumen Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_arsip_siswa, 'url' => ['view', 'id_arsip_siswa' => $model->id_arsip_siswa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="arsip-dokumen-siswa-update">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
            'siswa' => $siswa,
        ]) ?>
    </div>
</div>
