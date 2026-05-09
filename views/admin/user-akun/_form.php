<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserAkun $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-akun-form">
    <?php $form = ActiveForm::begin(['options' => ['novalidate' => true]]); ?>

    <div class="d-flex justify-content-center" style="padding: 40px 20px;">
        <div class="bg-white" style="width:100%;max-width:900px;border-radius: 8px;box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <!-- Header -->
            <div style="padding: 40px 50px 30px 50px;border-bottom: 1px solid #e9ecef;">
                <h4 class="font-weight-bold mb-2" style="color:#333;font-size: 1.5rem;"><?= Html::encode($model->isNewRecord ? 'Tambah User Akun' : 'Edit User Akun') ?></h4>
                <p class="mb-0" style="color: #6c757d;font-size: 0.95rem;">Masukkan informasi user akun dengan lengkap</p>
            </div>

            <!-- Form Body -->
            <div style="padding: 40px 50px;">
                <div style="max-width: 100%;">
                    <!-- Row 1: Username, Nama Lengkap -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
                        <div>
                            <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Username</label>
                            <?= $form->field($model, 'username', ['options' => ['class' => ''], 'template' => '{input}'])->textInput(['maxlength' => true, 'placeholder' => 'Username', 'class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Nama Lengkap</label>
                            <?= $form->field($model, 'nama_lengkap', ['options' => ['class' => ''], 'template' => '{input}'])->textInput(['maxlength' => true, 'placeholder' => 'Nama Lengkap', 'class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
                        </div>
                    </div>

                    <!-- Row 2: Password, Email -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
                        <div>
                            <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Password</label>
                            <?= $form->field($model, 'password', ['options' => ['class' => ''], 'template' => '{input}'])->passwordInput(['maxlength' => true, 'placeholder' => 'Password', 'class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Email</label>
                            <?= $form->field($model, 'email', ['options' => ['class' => ''], 'template' => '{input}'])->textInput(['maxlength' => true, 'placeholder' => 'Email', 'class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
                        </div>
                    </div>

                    <!-- Row 3: Role -->
                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333; font-size: 0.95rem;">Role</label>
                        <?= $form->field($model, 'role', ['template' => '{input}'])->dropDownList(['admin' => 'Admin', 'petugas' => 'Petugas'], ['prompt' => 'Pilih Role', 'class' => 'form-control', 'style' => 'height: 44px; border: 1px solid #dee2e6; border-radius: 4px; background-color: #f8f9fa; padding: 10px 12px; font-size: 0.95rem;']) ?>
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
