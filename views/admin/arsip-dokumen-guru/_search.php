<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenGuruSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="arsip-dokumen-guru-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_arsip_guru') ?>

    <?= $form->field($model, 'id_guru') ?>

    <?= $form->field($model, 'id_jenis') ?>

    <?= $form->field($model, 'judul_dokumen') ?>

    <?= $form->field($model, 'tanggal_upload') ?>
    <?= $form->field($model, 'file_path') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?= $form->field($model, 'id_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
