<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\JenisDokumen $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jenis-dokumen-form">
    <?php $form = ActiveForm::begin(['options' => ['novalidate' => true]]); ?>

    <div class="d-flex justify-content-center" style="padding: 40px 20px;">
        <div class="bg-white" style="width:100%;max-width:900px;border-radius: 8px;box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <!-- Header -->
            <div style="padding: 40px 50px 30px 50px;border-bottom: 1px solid #e9ecef;">
                <h4 class="font-weight-bold mb-2" style="color:#333;font-size: 1.5rem;"><?= Html::encode($model->isNewRecord ? 'Tambah Jenis Dokumen' : 'Edit Jenis Dokumen') ?></h4>
                <p class="mb-0" style="color: #6c757d;font-size: 0.95rem;">Masukkan jenis dokumen baru ke sistem</p>
            </div>

            <!-- Form Body -->
            <div style="padding: 40px 50px;">
                <div style="max-width: 100%;">
                    <!-- Row 1: Nama Jenis Dokumen -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Nama Jenis Dokumen</label>
                        <?= $form->field($model, 'nama_jenis', ['options' => ['class' => ''], 'template' => '{input}'])->textInput(['maxlength' => true, 'placeholder' => 'Nama Jenis Dokumen', 'class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
                    </div>

                    <!-- Row 2: Deskripsi -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Deskripsi</label>
                        <?= $form->field($model, 'deskripsi', ['options' => ['class' => ''], 'template' => '{input}'])->textarea(['rows' => 5, 'placeholder' => 'Deskripsi dokumen', 'class' => 'form-control', 'style' => 'border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem; resize: none;']) ?>
                    </div>

                    <!-- Buttons -->
                    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 40px; padding-top: 20px;">
                        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-outline-secondary', 'style' => 'border: 1px solid #dee2e6; color: #6c757d; padding: 8px 24px; font-weight: 500; border-radius: 4px;']) ?>
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'style' => 'background-color: #0d6efd; color: white; padding: 8px 32px; font-weight: 500; border-radius: 4px; border: none;']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
