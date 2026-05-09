<?php

/** @var yii\web\View $this */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Hero Header -->
<div class="relative bg-[#66BB7A] text-white overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#66BB7A] via-[#5aa769] to-[#4d9559]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="text-center animate-fade-in">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 animate-zoom-in">Contact Us</h1>
            <hr class="bg-white mx-auto mt-4 mb-6" style="width: 90px; height: 3px;">
            <nav aria-label="breadcrumb" class="animate-fade-in-up">
                <ol class="flex justify-center items-center space-x-2 text-green-100">
                    <li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="hover:text-white transition-colors">Home</a></li>
                    <li><i class="fas fa-chevron-right text-xs mx-2"></i></li>
                    <li><a href="#" class="hover:text-white transition-colors">Pages</a></li>
                    <li><i class="fas fa-chevron-right text-xs mx-2"></i></li>
                    <li class="text-white">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
        </div>

<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
    <!-- Success Message -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center animate-fade-in-up">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-green-600 text-4xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Thank You!</h2>
            <p class="text-gray-700 text-lg mb-6">
                Pesan Anda telah diterima. Kami akan merespons secepat mungkin.
            </p>
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-100 text-left">
                    <p class="text-sm text-green-800 mb-2">
                        <strong>Catatan:</strong> Karena aplikasi dalam mode development, email tidak dikirim 
                        tetapi disimpan sebagai file.
                    </p>
                </div>
            <?php endif; ?>
            <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="inline-flex items-center px-6 py-3 bg-[#66BB7A] text-white rounded-full hover:bg-[#5aa769] transition-all duration-300 shadow-lg hover:shadow-xl font-medium mt-6">
                Back to Home
            </a>
        </div>
    </div>
    <?php else: ?>
    <!-- Contact Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up">
                <div class="inline-block relative mb-4">
                    <h6 class="text-[#66BB7A] font-semibold text-sm uppercase tracking-wider relative pl-6">
                        Contact Us
                        <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-4 h-0.5 bg-[#66BB7A]"></span>
                    </h6>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Contact For Any Query</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Jika Anda memiliki pertanyaan bisnis atau pertanyaan lainnya, silakan isi form di bawah ini untuk menghubungi kami.</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Form -->
                <div class="lg:col-span-2 animate-fade-in-up">
                    <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12">
                        <?php $form = ActiveForm::begin([
                            'id' => 'contact-form',
                            'options' => ['class' => 'space-y-6'],
                            'fieldConfig' => [
                                'template' => '<div class="relative">{label}{input}{error}</div>',
                                'labelOptions' => ['class' => 'block text-sm font-medium text-gray-700 mb-2'],
                                'inputOptions' => ['class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] transition-colors'],
                                'errorOptions' => ['class' => 'mt-1 text-sm text-red-600'],
                            ],
                        ]); ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?= $form->field($model, 'name')->textInput([
                                'autofocus' => true,
                                'placeholder' => 'Your Name',
                                'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] transition-colors'
                            ]) ?>
                            
                            <?= $form->field($model, 'email')->textInput([
                                'type' => 'email',
                                'placeholder' => 'Your Email',
                                'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] transition-colors'
                            ]) ?>
                        </div>
                        
                        <?= $form->field($model, 'subject')->textInput([
                            'placeholder' => 'Subject',
                            'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] transition-colors'
                        ]) ?>
                        
                        <?= $form->field($model, 'body')->textarea([
                            'rows' => 6,
                            'placeholder' => 'Leave a message here',
                            'class' => 'appearance-none relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] transition-colors resize-none'
                        ]) ?>
                        
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <?= $form->field($model, 'verifyCode', [
                                'template' => '<div>{label}<div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center mt-2">{image}{input}{error}</div></div>',
                                'labelOptions' => ['class' => 'block text-sm font-medium text-gray-700 mb-3']
                            ])->widget(Captcha::class, [
                                'template' => '<div class="flex items-center">{image}</div>',
                                'options' => [
                                    'class' => 'appearance-none relative block px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#66BB7A] focus:border-[#66BB7A] transition-colors',
                                    'placeholder' => 'Enter verification code'
                                ]
                            ]) ?>
                        </div>
                        
                        <div>
                            <?= Html::submitButton('Send Message', [
                                'class' => 'w-full flex justify-center py-4 px-6 border border-transparent rounded-lg shadow-lg text-white bg-[#66BB7A] hover:bg-[#5aa769] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#66BB7A] transition-all duration-300 font-medium text-lg',
                                'name' => 'contact-button'
                            ]) ?>
                        </div>
                        
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.1s">
                    <!-- Info Card 1 -->
                    <div class="bg-[#66BB7A] text-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-map-marker-alt text-2xl"></i>
                        </div>
                        <h5 class="text-xl font-bold mb-2">Our Office</h5>
                        <p class="text-green-100">123 Street, Jakarta, Indonesia</p>
                    </div>

                    <!-- Info Card 2 -->
                    <div class="bg-gray-800 text-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-phone-alt text-2xl"></i>
                        </div>
                        <h5 class="text-xl font-bold mb-2">Call Us</h5>
                        <p class="text-gray-300">+62 123 456 7890</p>
                        <p class="text-gray-300">+62 987 654 3210</p>
                    </div>
                    
                    <!-- Info Card 3 -->
                    <div class="bg-[#66BB7A] text-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-envelope text-2xl"></i>
                        </div>
                        <h5 class="text-xl font-bold mb-2">Email Us</h5>
                        <p class="text-green-100">info@example.com</p>
                        <p class="text-green-100">support@example.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

<style>
@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes zoom-in {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in { animation: fade-in 1s ease-out; }
.animate-zoom-in { animation: zoom-in 1s ease-out; }
.animate-fade-in-up { animation: fade-in-up 1s ease-out; }
</style>
