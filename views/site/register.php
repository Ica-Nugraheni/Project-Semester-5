<?php

/** @var yii\web\View $this */
/** @var app\models\RegisterForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-white to-green-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-[#66BB7A] rounded-full flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
            <p class="mt-2 text-sm text-gray-600">Daftarkan akun Anda untuk mulai menggunakan sistem</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'options' => ['class' => 'space-y-6'],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'block text-sm font-medium text-gray-700 mb-2'],
                    'inputOptions' => ['class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors'],
                    'errorOptions' => ['class' => 'mt-1 text-sm text-red-600'],
                ],
            ]); ?>

            <?= $form->field($model, 'username', [
                'template' => '<div>{label}{input}{error}</div>'
            ])->textInput([
                'autofocus' => true,
                'placeholder' => 'Username',
                'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors'
            ]) ?>

            <?= $form->field($model, 'nama_lengkap', [
                'template' => '<div>{label}{input}{error}</div>'
            ])->textInput([
                'placeholder' => 'Nama Lengkap',
                'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors'
            ]) ?>

            <?= $form->field($model, 'email', [
                'template' => '<div>{label}{input}{error}</div>'
            ])->textInput([
                'type' => 'email',
                'placeholder' => 'email@example.com',
                'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors'
            ]) ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <?= $form->field($model, 'password', [
                    'template' => '<div>{label}{input}{error}</div>'
                ])->passwordInput([
                    'placeholder' => 'Password',
                    'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors'
                ]) ?>

                <?= $form->field($model, 'password_repeat', [
                    'template' => '<div>{label}{input}{error}</div>'
                ])->passwordInput([
                    'placeholder' => 'Ulangi Password',
                    'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors'
                ]) ?>
            </div>

            <?= $form->field($model, 'role', [
                'template' => '<div>{label}{input}{error}</div>'
            ])->dropDownList(
                \app\models\RegisterForm::getRoleOptions(),
                [
                    'prompt' => 'Pilih Role',
                    'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors bg-white'
                ]
            ) ?>

            <!-- <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <?= $form->field($model, 'verifyCode', [
                    'template' => '<div>{label}<div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center mt-2">{image}{input}{error}</div></div>',
                    'labelOptions' => ['class' => 'block text-sm font-medium text-gray-700 mb-3']
                ])->widget(\yii\captcha\Captcha::class, [
                    'template' => '<div class="flex items-center">{image}</div>',
                    'options' => [
                        'class' => 'appearance-none relative block px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] transition-colors',
                        'placeholder' => 'Masukkan kode verifikasi'
                    ]
                ]) ?>
            </div> -->

            <div>
                <?= Html::submitButton('Daftar', [
                    'class' => 'group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#66BB7A] hover:bg-[#5aa769] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#66BB7A] transition-colors shadow-lg hover:shadow-xl',
                    'name' => 'register-button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="<?= Url::to(['/site/login']) ?>" class="font-medium text-[#66BB7A] hover:text-[#5aa769] transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center">
            <a href="<?= Url::to(['/site/index']) ?>" class="text-sm text-[#66BB7A] hover:text-[#5aa769] font-medium transition-colors">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>


