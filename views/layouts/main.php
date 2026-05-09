<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-full">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            important: true,
            theme: {
                extend: {
                    fontFamily: {
                        'heebo': ['Heebo', 'sans-serif'],
                        'roboto': ['Roboto', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#66BB7A',
                        'primary-dark': '#5aa769',
                        'primary-darker': '#4d9559',
                    }
                }
            }
        }
    </script>
    <?php $this->head() ?>
</head>
<body class="bg-white font-roboto antialiased">
<?php $this->beginBody() ?>

<!-- Spinner -->
<div id="spinner" class="fixed inset-0 bg-white z-[9999] flex items-center justify-center transition-opacity duration-300">
    <div class="w-12 h-12 border-4 border-green-200 border-t-[#66BB7A] rounded-full animate-spin"></div>
</div>

<!-- Navigation -->
<nav class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <a href="<?= Url::to(['/site/index']) ?>" class="flex items-center text-2xl font-bold text-gray-900 hover:text-[#66BB7A] transition-colors">
                <i class="fas fa-archive mr-2 text-[#66BB7A]"></i>
                <span>E-Arsip SMAN 1 Dua Koto</span>
            </a>

            <div class="hidden lg:flex items-center space-x-6">
                <a href="<?= Url::to(['/site/index']) ?>" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium relative group">
                    Beranda
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#66BB7A] group-hover:w-full transition-all duration-300"></span>
                </a>
                <div class="relative group">
                    <a href="<?= Url::to(['/site/about']) ?>" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium relative">
                        Profile
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#66BB7A] group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100">
                        <div class="py-2">
                            <a href="<?= Url::to(['/site/about']) ?>#fitur" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Fitur Sistem</a>
                            <a href="<?= Url::to(['/site/about']) ?>#jenis-dokumen" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Jenis Dokumen</a>
                            <a href="<?= Url::to(['/guru/index']) ?>" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Guru</a>
                            <a href="<?= Url::to(['/site/about']) ?>#tentang" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Tentang Sistem</a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <a href="#" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium relative">
                        Informasi
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#66BB7A] group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <div class="absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100">
                        <div class="py-2">
                            <a href="<?= Url::to(['/site/index']) ?>#artikel" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Artikel</a>
                            <a href="<?= Url::to(['/site/index']) ?>#agenda" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Agenda</a>
                            <a href="<?= Url::to(['/site/index']) ?>#pengumuman" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Pengumuman</a>
                            <a href="<?= Url::to(['/site/index']) ?>#prestasi" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Statistik</a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <a href="#" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium relative">
                        Galeri
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#66BB7A] group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <div class="absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100">
                        <div class="py-2">
                            <a href="<?= Url::to(['/site/index']) ?>#galeri" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-[#66BB7A] transition-colors">Galeri Kegiatan</a>
                        </div>
                    </div>
                </div>
                <a href="<?= Url::to(['/site/contact']) ?>" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium relative group">
                    Kontak
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#66BB7A] group-hover:w-full transition-all duration-300"></span>
                </a>

                <?php if (Yii::$app->user->isGuest): ?>
                    <button onclick="openSearchModal()" class="text-gray-600 hover:text-[#66BB7A] transition-colors p-2">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <a href="<?= Url::to(['/site/register']) ?>" class="bg-white text-[#66BB7A] border-2 border-[#66BB7A] px-6 py-2 rounded-full hover:bg-green-50 transition-all shadow-lg hover:shadow-xl font-medium mr-3">
                        Register
                    </a>
                    <a href="<?= Url::to(['/site/login']) ?>" class="bg-[#66BB7A] text-white px-6 py-2 rounded-full hover:bg-[#5aa769] transition-all shadow-lg hover:shadow-xl font-medium">
                        Login
                    </a>
                <?php else: ?>
                    <button onclick="openSearchModal()" class="text-gray-600 hover:text-[#66BB7A] transition-colors p-2">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700 text-sm"><?= Html::encode(Yii::$app->user->identity->username) ?></span>
                        <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'inline']) ?>
                        <?= Html::submitButton('Logout', ['class' => 'bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors font-medium']) ?>
                        <?= Html::endForm() ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <button type="button" class="lg:hidden text-gray-700 hover:text-[#66BB7A] transition-colors" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden lg:hidden pb-4 border-t border-gray-200 mt-4">
            <div class="flex flex-col space-y-3 mt-4">
                <a href="<?= Url::to(['/site/index']) ?>" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium py-2">Beranda</a>
                <a href="<?= Url::to(['/site/about']) ?>" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium py-2">Profile</a>
                <a href="<?= Url::to(['/site/index']) ?>#artikel" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium py-2">Informasi</a>
                <a href="<?= Url::to(['/site/index']) ?>#galeri" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium py-2">Galeri</a>
                <a href="<?= Url::to(['/site/contact']) ?>" class="text-gray-700 hover:text-[#66BB7A] transition-colors font-medium py-2">Kontak</a>
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="<?= Url::to(['/site/login']) ?>" class="bg-[#66BB7A] text-white px-4 py-2 rounded-full hover:bg-[#5aa769] transition-colors font-medium text-center">
                        Login
                    </a>
                <?php else: ?>
                    <div class="flex flex-col space-y-2 pt-2 border-t border-gray-200">
                        <span class="text-gray-700 text-sm"><?= Html::encode(Yii::$app->user->identity->username) ?></span>
                        <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'inline']) ?>
                        <?= Html::submitButton('Logout', ['class' => 'bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors font-medium w-full']) ?>
                        <?= Html::endForm() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="min-h-screen">
    <?= Alert::widget() ?>
    <?= $content ?>
</main>

<!-- Search Modal -->
<div id="searchModal" class="hidden fixed inset-0 bg-black bg-opacity-70 z-[9999] items-center justify-center">
    <div class="absolute top-4 right-4">
        <button onclick="closeSearchModal()" class="text-white hover:text-gray-300 text-2xl">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="max-w-2xl w-full px-4">
        <div class="flex items-center bg-white rounded-full p-2 shadow-xl">
            <input type="text" id="searchInput" placeholder="Type search keyword..." class="flex-1 px-6 py-4 bg-transparent border-none outline-none text-gray-800 placeholder-gray-400">
            <button class="bg-[#66BB7A] text-white px-6 py-4 rounded-full hover:bg-[#5aa769] transition-colors">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-[#66BB7A] text-white mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h5 class="text-white text-lg font-bold mb-6">Menu Lainnya</h5>
                <div class="space-y-3">
                    <a href="<?= Url::to(['/site/index']) ?>" class="block text-green-100 hover:text-white transition-colors">Beranda</a>
                    <a href="<?= Url::to(['/site/index']) ?>#artikel" class="block text-green-100 hover:text-white transition-colors">Artikel</a>
                    <a href="<?= Url::to(['/site/index']) ?>#galeri-kegiatan" class="block text-green-100 hover:text-white transition-colors">Galeri</a>
                    <a href="<?= Url::to(['/site/contact']) ?>" class="block text-green-100 hover:text-white transition-colors">Kontak</a>
                </div>
            </div>

            <div>
                <h5 class="text-white text-lg font-bold mb-6">Temukan Kami</h5>
                <div class="flex space-x-4">
                    <a href="#" class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full hover:bg-white hover:text-[#66BB7A] transition-all duration-300">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full hover:bg-white hover:text-[#66BB7A] transition-all duration-300">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full hover:bg-white hover:text-[#66BB7A] transition-all duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full hover:bg-white hover:text-[#66BB7A] transition-all duration-300">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                    <a href="#" class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full hover:bg-white hover:text-[#66BB7A] transition-all duration-300">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                </div>
                <div class="mt-6 space-y-3 text-green-100">
                    <p class="flex items-center">
                        <i class="fas fa-phone-alt mr-3"></i>
                        <span>085264660883</span>
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-envelope mr-3"></i>
                        <span>info@sman1duakoto.sch.id</span>
                    </p>
                </div>
            </div>

            <div>
                <h5 class="text-white text-lg font-bold mb-6">Download App</h5>
                <p class="text-green-100 mb-4 text-sm">Nikmati Cara Mudah dan Menyenangkan Ketika Membaca Buku, Update Informasi Sekolah Hanya Dalam Genggaman</p>
                <div class="space-y-3">
                    <button class="w-full bg-white text-[#66BB7A] px-6 py-3 rounded-lg hover:bg-green-50 transition-colors font-medium flex items-center justify-center">
                        <i class="fab fa-google-play mr-2"></i>
                        Download Android
                    </button>
                    <button class="w-full bg-white text-[#66BB7A] px-6 py-3 rounded-lg hover:bg-green-50 transition-colors font-medium flex items-center justify-center">
                        <i class="fab fa-apple mr-2"></i>
                        Download iOS
                    </button>
                </div>
            </div>

            <div>
                <h5 class="text-white text-lg font-bold mb-6">Link Terkait</h5>
                <div class="grid grid-cols-3 gap-2">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                        <div class="aspect-square bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition-opacity cursor-pointer">
                            <i class="fas fa-image text-2xl"></i>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-green-500 border-opacity-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-green-100">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    Copyright © <?= date('Y') ?> – <?= Html::encode(Yii::$app->name) ?>. Ica Nugraheni - Politeknik Negeri Padang  <span class="text-red-400">❤</span> by <?= strtolower(str_replace(' ', '', Yii::$app->name)) ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top -->
<button id="backToTop" onclick="scrollToTop()" class="hidden fixed bottom-8 right-8 bg-[#66BB7A] text-white p-4 rounded-full shadow-lg hover:bg-[#5aa769] transition-all z-50 hover:scale-110">
    <i class="bi bi-arrow-up text-xl"></i>
</button>

<script>
window.addEventListener('load', function() {
    document.getElementById('spinner').style.opacity = '0';
    setTimeout(() => {
        document.getElementById('spinner').classList.add('hidden');
    }, 300);
});

function toggleMobileMenu() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
}

function openSearchModal() {
    document.getElementById('searchModal').classList.remove('hidden');
    document.getElementById('searchModal').classList.add('flex');
    setTimeout(() => {
        document.getElementById('searchInput').focus();
    }, 100);
}

function closeSearchModal() {
    document.getElementById('searchModal').classList.add('hidden');
    document.getElementById('searchModal').classList.remove('flex');
}

window.addEventListener('scroll', function() {
    const backToTop = document.getElementById('backToTop');
    if (window.pageYOffset > 300) {
        backToTop.classList.remove('hidden');
    } else {
        backToTop.classList.add('hidden');
    }
});

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 10) {
        navbar.classList.add('shadow-lg');
    } else {
        navbar.classList.remove('shadow-lg');
    }
});
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
