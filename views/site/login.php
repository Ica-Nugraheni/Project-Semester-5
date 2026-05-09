<?php

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-white to-green-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-[#66BB7A] rounded-full flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Masuk ke Akun</h2>
            <p class="mt-2 text-sm text-gray-600">Silakan masuk dengan kredensial Anda</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
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

            <?= $form->field($model, 'password', [
                'template' => '<div>{label}{input}{error}</div>'
            ])->passwordInput([
                'placeholder' => 'Password',
                'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] focus:z-10 sm:text-sm transition-colors'
            ]) ?>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <?= $form->field($model, 'rememberMe', [
                        'template' => '<div class="flex items-center">{input} {label}</div>',
                        'labelOptions' => ['class' => 'ml-2 block text-sm text-gray-900 cursor-pointer']
                    ])->checkbox([
                        'class' => 'h-4 w-4 text-[#66BB7A] focus:ring-[#66BB7A] border-gray-300 rounded cursor-pointer'
                    ]) ?>
                </div>
            </div>

            <div>
                <?= Html::submitButton('Masuk', [
                    'class' => 'group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-[#66BB7A] hover:bg-[#5aa769] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#66BB7A] transition-colors shadow-lg hover:shadow-xl',
                    'name' => 'login-button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

           

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-sm text-gray-600 mb-2">
                Belum punya akun? 
                <a href="<?= Url::to(['/site/register']) ?>" class="font-medium text-[#66BB7A] hover:text-[#5aa769] transition-colors">
                    Daftar di sini
                </a>
            </p>
        </div>

        <!-- Back to Home -->
        <div class="text-center">
            <a href="<?= Url::to(['/site/index']) ?>" class="text-sm text-[#66BB7A] hover:text-[#5aa769] font-medium transition-colors">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
