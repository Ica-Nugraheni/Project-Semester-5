<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\JenisDokumen $model */

$this->title = 'Tambah Jenis Dokumen';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Dokumen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="jenis-dokumen-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
