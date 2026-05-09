<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Guru;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenGuru $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="arsip-dokumen-guru-form">
    <?php $form = ActiveForm::begin(['options' => ['novalidate' => true, 'enctype' => 'multipart/form-data']]); ?>

    <div class="d-flex justify-content-center" style="padding: 40px 20px;">
        <div class="bg-white" style="width:100%;max-width:900px;border-radius: 8px;box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <!-- Header -->
            <div style="padding: 40px 50px 30px 50px;border-bottom: 1px solid #e9ecef;">
                <h4 class="font-weight-bold mb-2" style="color:#333;font-size: 1.5rem;"><?= Html::encode($model->isNewRecord ? 'Tambah Arsip Dokumen Guru' : 'Edit Arsip Dokumen Guru') ?></h4>
                <p class="mb-0" style="color: #6c757d;font-size: 0.95rem;">Masukkan informasi arsip dokumen guru</p>
            </div>

            <!-- Form Body -->
            <div style="padding: 40px 50px;">
                <div style="max-width: 100%;">
                    <!-- Row 1: Nama Guru -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Nama Guru</label>
                        <?= $form->field($model, 'id_guru', ['template'=>'{input}'])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\models\Guru::find()->all(),'id_guru','nama_guru'),
                                [
                                    'prompt'=>'Pilih Guru',
                                    'class'=>'form-control',
                                    'style'=>'height:44px;border:1px solid #dee2e6;border-radius:4px;background-color:#f8f9fa;padding:10px 12px;font-size:0.95rem;'
                                ]
                            ) ?>
                    </div>

                    <!-- Row 2: Jenis Dokumen -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Jenis Dokumen</label>
                        <?= $form->field($model, 'id_jenis', ['template'=> '{input}'])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\models\JenisDokumen::find()->all(), 'id_jenis', 'nama_jenis'),
                                [
                                    'prompt' => 'Pilih Jenis Dokumen',
                                    'class' => 'form-control',
                                    'style' => 'height: 44px; border:1px solid #dee2e6; border-radius:4px; background-color:#f8f9fa; padding:10px 12px;font-size:0.95rem;'
                                ]
                            )
                        ?>
                    </div>

                    <!-- Row 3: Judul Dokumen, Tanggal Upload -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
                        <div>
                            <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Judul Dokumen</label>
                            <?= $form->field($model, 'judul_dokumen', ['options' => ['class' => ''], 'template' => '{input}'])->textInput(['maxlength' => true, 'placeholder' => 'Judul Dokumen', 'class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Tanggal Upload</label>
                            <?= $form->field($model, 'tanggal_upload', ['template' => '{input}'])
                                ->input('date', [
                                    'class' => 'form-control',
                                    'style' =>'height:44px;border:1px solid #dee2e6;border-radius:4px;background-color:#f8f9fa;padding:10px 12px;font-size:0.95rem;',
                                ]) ?>
                        </div>
                    </div>

                    <!-- Row 4: Upload File -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Upload File</label>
                        <?= $form->field($model, 'file_path', ['template' => '{input}'])->fileInput(['class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
                    </div>

                    <!-- Row 5: Keterangan -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Keterangan</label>
                        <?= $form->field($model, 'keterangan', ['options' => ['class' => ''], 'template' => '{input}'])->textarea(['rows' => 5, 'placeholder' => 'Keterangan atau catatan penting', 'class' => 'form-control', 'style' => 'border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem; resize: none;']) ?>
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
