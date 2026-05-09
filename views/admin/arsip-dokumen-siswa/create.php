<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenSiswa $model */

$this->title = 'Tambah Arsip Dokumen Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Arsip Dokumen Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="arsip-dokumen-siswa-create">
    <?= $this->render('_form', [
        'model' => $model,
        'siswa' => isset($siswa) ? $siswa : null,
    ]) ?>
</div>
