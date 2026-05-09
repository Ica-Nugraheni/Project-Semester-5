<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Guru;
use app\models\JenisDokumen;

$this->title = 'Tentang Sistem';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Hero Header -->
<div class="relative bg-[#66BB7A] text-white overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#66BB7A] via-[#5aa769] to-[#4d9559]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="text-center animate-fade-in">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 animate-zoom-in">Tentang Sistem</h1>
            <hr class="bg-white mx-auto mt-4 mb-6" style="width: 90px; height: 3px;">
            <nav aria-label="breadcrumb" class="animate-fade-in-up">
                <ol class="flex justify-center items-center space-x-2 text-green-100">
                    <li><a href="<?= Url::to(['/site/index']) ?>" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><i class="fas fa-chevron-right text-xs mx-2"></i></li>
                    <li class="text-white">Tentang</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- About Content Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in-up">
                <div class="inline-block relative mb-4">
                    <h6 class="text-[#66BB7A] font-semibold text-sm uppercase tracking-wider relative pl-6">
                        Tentang Sistem
                        <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-4 h-0.5 bg-[#66BB7A]"></span>
                    </h6>
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                    Sistem Manajemen Gudang & Arsip Digital
                </h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Sistem Manajemen Gudang & Arsip adalah platform digital yang dirancang khusus untuk membantu sekolah dalam mengelola arsip dokumen guru dan siswa secara efisien, terorganisir, dan aman. Sistem ini memudahkan proses penyimpanan, pencarian, dan pengelolaan dokumen penting sekolah.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Dengan sistem ini, sekolah dapat melakukan digitalisasi arsip dokumen, mengurangi penggunaan kertas, dan meningkatkan efisiensi dalam pengelolaan dokumen. Semua dokumen tersimpan dengan aman dan dapat diakses kapan saja dengan mudah.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-[#66BB7A] mr-3 text-xl"></i>
                        <h6 class="font-semibold text-gray-900">Manajemen Terpusat</h6>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-[#66BB7A] mr-3 text-xl"></i>
                        <h6 class="font-semibold text-gray-900">Pencarian Cepat</h6>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-[#66BB7A] mr-3 text-xl"></i>
                        <h6 class="font-semibold text-gray-900">Keamanan Data</h6>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-[#66BB7A] mr-3 text-xl"></i>
                        <h6 class="font-semibold text-gray-900">Backup Otomatis</h6>
                    </div>
                </div>
            </div>
            <div class="animate-zoom-in">
                <div class="bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-2xl p-8 shadow-2xl">
                    <div class="aspect-square bg-white bg-opacity-10 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-archive text-white text-9xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block relative mb-4">
                <h6 class="text-[#66BB7A] font-semibold text-sm uppercase tracking-wider relative pl-6">
                    Fitur Utama
                    <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-4 h-0.5 bg-[#66BB7A]"></span>
                </h6>
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Fitur Sistem Manajemen Arsip</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Fitur-fitur unggulan yang memudahkan pengelolaan arsip dokumen</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-folder-open text-[#66BB7A] text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-4">Arsip Dokumen Guru</h4>
                <p class="text-gray-600 leading-relaxed">Kelola dan simpan semua dokumen penting guru dengan sistem kategorisasi yang rapi dan mudah dicari.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-file-alt text-[#66BB7A] text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-4">Arsip Dokumen Siswa</h4>
                <p class="text-gray-600 leading-relaxed">Simpan dan kelola dokumen siswa secara digital dengan sistem pencarian yang cepat dan efisien.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-tags text-[#66BB7A] text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-4">Kategori Dokumen</h4>
                <p class="text-gray-600 leading-relaxed">Organisir dokumen berdasarkan jenis dan kategori untuk memudahkan pencarian dan pengelolaan.</p>
            </div>
            
            <!-- Feature 4 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-search text-[#66BB7A] text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-4">Pencarian Cepat</h4>
                <p class="text-gray-600 leading-relaxed">Temukan dokumen yang Anda cari dengan cepat menggunakan fitur pencarian canggih dan filter.</p>
            </div>
            
            <!-- Feature 5 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-[#66BB7A] text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-4">Keamanan Data</h4>
                <p class="text-gray-600 leading-relaxed">Dokumen Anda terlindungi dengan sistem keamanan berlapis dan akses kontrol yang ketat.</p>
            </div>
            
            <!-- Feature 6 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-download text-[#66BB7A] text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-4">Backup & Restore</h4>
                <p class="text-gray-600 leading-relaxed">Backup otomatis dan restore data untuk memastikan keamanan dan ketersediaan dokumen.</p>
            </div>
        </div>
    </div>
</section>

<!-- Jenis Dokumen Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block relative mb-4">
                <h6 class="text-[#66BB7A] font-semibold text-sm uppercase tracking-wider relative pl-6">
                    Kategori Dokumen
                    <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-4 h-0.5 bg-[#66BB7A]"></span>
                </h6>
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Jenis Dokumen yang Dikelola</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Berbagai jenis dokumen yang dapat diarsipkan dalam sistem</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $jenisDokumen = [];
            try {
                $jenisDokumen = JenisDokumen::find()->limit(8)->all();
            } catch (\Exception $e) {
                // Database tidak tersedia
            }
            
            $defaultJenis = [
                ['nama' => 'Ijazah', 'icon' => 'graduation-cap'],
                ['nama' => 'SK Pengangkatan', 'icon' => 'file-contract'],
                ['nama' => 'Sertifikat', 'icon' => 'certificate'],
                ['nama' => 'KTP', 'icon' => 'id-card'],
                ['nama' => 'Kartu Keluarga', 'icon' => 'users'],
                ['nama' => 'Surat Keterangan', 'icon' => 'file-signature'],
                ['nama' => 'Dokumen Pribadi', 'icon' => 'folder'],
                ['nama' => 'Lainnya', 'icon' => 'file']
            ];
            
            if (empty($jenisDokumen)):
                foreach ($defaultJenis as $jenis): ?>
                    <div class="bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-xl p-6 text-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-<?= $jenis['icon'] ?> text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-lg"><?= $jenis['nama'] ?></h4>
                    </div>
                <?php endforeach;
            else:
                foreach ($jenisDokumen as $jenis): ?>
                    <div class="bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-xl p-6 text-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-file-alt text-3xl"></i>
                        </div>
                        <h4 class="font-semibold text-lg"><?= Html::encode($jenis->nama_jenis) ?></h4>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block relative mb-4">
                <h6 class="text-[#66BB7A] font-semibold text-sm uppercase tracking-wider relative pl-6">
                    Tim Pengelola
                    <span class="absolute left-0 top-1/2 transform -translate-y-1/2 w-4 h-0.5 bg-[#66BB7A]"></span>
                </h6>
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Tim Pengelola Sistem</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Tim yang bertanggung jawab dalam pengelolaan sistem arsip</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $gurus = [];
            try {
                $gurus = Guru::find()->limit(6)->all();
            } catch (\Exception $e) {
                // Database tidak tersedia
            }
            
            if (empty($gurus)):
                // Placeholder
                for ($i = 1; $i <= 3; $i++): ?>
                    <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-24 h-24 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user text-white text-4xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">Petugas Arsip</h4>
                        <p class="text-sm text-gray-600 mb-4">Pengelola Sistem</p>
                    </div>
                <?php endfor;
            else:
                foreach ($gurus as $guru): ?>
                    <div class="bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-24 h-24 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-white font-bold text-2xl"><?= strtoupper(substr($guru->nama_guru, 0, 2)) ?></span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2"><?= Html::encode($guru->nama_guru) ?></h4>
                        <p class="text-sm text-gray-600 mb-4"><?= Html::encode($guru->jabatan ?: 'Petugas Arsip') ?></p>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

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
