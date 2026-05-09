<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenGuru $model */

$this->title = 'Tambah Arsip Dokumen Guru';
$this->params['breadcrumbs'][] = ['label' => 'Arsip Dokumen Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="arsip-dokumen-guru-create">
    <?= $this->render('_form', [
        'model' => $model,
        'guru' => isset($guru) ? $guru : null,
    ]) ?>
</div>
