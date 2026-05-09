<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Guru;
use app\models\JenisDokumen;
use app\models\ArsipDokumenGuru;
use app\models\ArsipDokumenSiswa;

$this->title = 'Beranda';
?>

<!-- Hero Section -->
<div class="relative bg-[#66BB7A] text-white overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#66BB7A] via-[#5aa769] to-[#4d9559]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="text-center animate-fade-in">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Selamat Datang Di Website E-Arsip Dokumen SMA Negeri 1 Dua Koto
            </h1>
            <p class="text-lg sm:text-xl text-green-100 mb-8 max-w-3xl mx-auto leading-relaxed">
                Sistem Manajemen Gudang & Arsip Dokumen Sekolah - Kelola arsip dokumen dengan mudah, aman, dan terorganisir
            </p>
        </div>
    </div>
</div>

<!-- Layanan Unggulan Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Layanan Unggulan <?= Html::encode(Yii::$app->name) ?></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-6">
            <a href="<?= Url::to(['/site/about']) ?>#jenis-dokumen" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-tags text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Jenis Dokumen</span>
            </a>
            <a href="<?= Url::to(['/site/index']) ?>#arsip-digital" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-archive text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Arsip Digital</span>
            </a>
            <a href="<?= Url::to(['/site/about']) ?>#fitur" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-cogs text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Fitur Sistem</span>
            </a>
            <a href="#" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-download text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Download</span>
            </a>
            <a href="<?= Url::to(['/site/about']) ?>#tentang" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-info-circle text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Tentang</span>
            </a>
            <a href="<?= Url::to(['/site/index']) ?>#agenda" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-calendar-alt text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Agenda</span>
            </a>
            <a href="<?= Url::to(['/site/index']) ?>#pengumuman" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-bullhorn text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Pengumuman</span>
            </a>
            <a href="<?= Url::to(['/site/index']) ?>#galeri" class="group flex flex-col items-center p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-[#66BB7A] transition-colors">
                    <i class="fas fa-images text-[#66BB7A] text-2xl group-hover:text-white"></i>
                </div>
                <span class="text-sm font-semibold text-gray-900 text-center">Galeri</span>
            </a>
        </div>
    </div>
</div>

<!-- Artikel dan Berita Section -->
<section id="artikel" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Artikel dan Berita</h2>
            <p class="text-gray-600">Aktivitas terbaru <?= Html::encode(Yii::$app->name) ?></p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Artikel 1 -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                <div class="h-48 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] flex items-center justify-center">
                    <i class="fas fa-newspaper text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <span class="inline-block px-3 py-1 bg-green-100 text-[#66BB7A] text-xs font-semibold rounded-full mb-3">Berita</span>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#66BB7A] transition-colors">Pelatihan Sistem Manajemen Arsip Digital</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Pelatihan penggunaan sistem manajemen arsip digital untuk meningkatkan efisiensi pengelolaan dokumen sekolah.</p>
                    <a href="#" class="text-[#66BB7A] font-medium hover:text-[#5aa769] transition-colors inline-flex items-center">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Artikel 2 -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                <div class="h-48 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <span class="inline-block px-3 py-1 bg-green-100 text-[#66BB7A] text-xs font-semibold rounded-full mb-3">Informasi</span>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#66BB7A] transition-colors">Digitalisasi Arsip Dokumen Sekolah</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Program digitalisasi arsip dokumen untuk mengurangi penggunaan kertas dan meningkatkan efisiensi penyimpanan.</p>
                    <a href="#" class="text-[#66BB7A] font-medium hover:text-[#5aa769] transition-colors inline-flex items-center">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Artikel 3 -->
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                <div class="h-48 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] flex items-center justify-center">
                    <i class="fas fa-shield-alt text-white text-6xl"></i>
                </div>
                <div class="p-6">
                    <span class="inline-block px-3 py-1 bg-green-100 text-[#66BB7A] text-xs font-semibold rounded-full mb-3">Keamanan</span>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#66BB7A] transition-colors">Keamanan Data Arsip Digital</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Sistem keamanan berlapis untuk melindungi dokumen penting sekolah dari akses tidak sah.</p>
                    <a href="#" class="text-[#66BB7A] font-medium hover:text-[#5aa769] transition-colors inline-flex items-center">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Arsip Digital Section (mengganti Buku Digital) -->
<section id="arsip-digital" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Arsip Digital</h2>
            <p class="text-gray-600">Koleksi Arsip Digital <?= Html::encode(Yii::$app->name) ?></p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php
            $jenisDokumen = [];
            try {
                $jenisDokumen = JenisDokumen::find()->limit(5)->all();
            } catch (\Exception $e) {
                // Database tidak tersedia
            }
            
            $defaultJenis = [
                ['nama' => 'Ijazah', 'count' => '10+'],
                ['nama' => 'SK Pengangkatan', 'count' => '5+'],
                ['nama' => 'Sertifikat', 'count' => '15+'],
                ['nama' => 'KTP', 'count' => '20+'],
                ['nama' => 'Kartu Keluarga', 'count' => '8+']
            ];
            
            $displayJenis = !empty($jenisDokumen) ? $jenisDokumen : $defaultJenis;
            $index = 0;
            
            foreach ($displayJenis as $jenis): 
                $nama = is_array($jenis) ? $jenis['nama'] : $jenis->nama_jenis;
                $count = is_array($jenis) ? $jenis['count'] : '0';
            ?>
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                    <div class="h-48 bg-gradient-to-br from-green-400 to-[#66BB7A] flex items-center justify-center">
                        <i class="fas fa-file-alt text-white text-5xl"></i>
                    </div>
                    <div class="p-4">
                        <span class="text-xs text-gray-500 mb-2 block">Arsip</span>
                        <div class="flex items-center mb-2">
                            <span class="text-white bg-[#66BB7A] px-2 py-1 rounded text-xs font-semibold"><?= $count ?></span>
                        </div>
                        <h4 class="font-semibold text-gray-900 text-sm mb-1"><?= Html::encode($nama) ?></h4>
                    </div>
                </div>
            <?php 
                $index++;
                if ($index >= 5) break;
            endforeach; ?>
        </div>
    </div>
</section>

<!-- Agenda Section -->
<section id="agenda" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Agenda</h2>
            <p class="text-gray-600">Agenda <?= Html::encode(Yii::$app->name) ?></p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Agenda 1 -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold text-[#66BB7A]">6</div>
                        <div class="text-sm text-gray-600">Mei 2024</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Senin</div>
                    </div>
                </div>
                <h4 class="font-bold text-gray-900 mb-2">Rapat Koordinasi Pengelolaan Arsip</h4>
                <p class="text-sm text-gray-600 mb-4">Ruang Arsip <?= Html::encode(Yii::$app->name) ?></p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-2"></i>
                    <span>09.00 - Selesai</span>
                </div>
            </div>
            
            <!-- Agenda 2 -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold text-[#66BB7A]">15</div>
                        <div class="text-sm text-gray-600">Mei 2024</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Rabu</div>
                    </div>
                </div>
                <h4 class="font-bold text-gray-900 mb-2">Pelatihan Sistem Digitalisasi Arsip</h4>
                <p class="text-sm text-gray-600 mb-4">Aula Sekolah</p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-2"></i>
                    <span>08.00 - 12.00</span>
                </div>
            </div>
            
            <!-- Agenda 3 -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <div class="text-3xl font-bold text-[#66BB7A]">25</div>
                        <div class="text-sm text-gray-600">Mei 2024</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500">Sabtu</div>
                    </div>
                </div>
                <h4 class="font-bold text-gray-900 mb-2">Audit Arsip Dokumen</h4>
                <p class="text-sm text-gray-600 mb-4">Ruang Arsip</p>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-2"></i>
                    <span>10.00 - Selesai</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Prestasi Section (diubah menjadi Statistik) -->
<section id="prestasi" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Statistik Sistem</h2>
            <p class="text-gray-600">Statistik <?= Html::encode(Yii::$app->name) ?></p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Statistik 1 -->
            <div class="bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-2xl p-8 text-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-4xl"></i>
                </div>
                <span class="text-sm font-semibold mb-2 block">Dokumen</span>
                <h4 class="text-2xl font-bold mb-2">
                    <?php
                    try {
                        $count = ArsipDokumenGuru::find()->count() + ArsipDokumenSiswa::find()->count();
                        echo $count > 0 ? $count : '500+';
                    } catch (\Exception $e) {
                        echo '500+';
                    }
                    ?>
                </h4>
                <p class="text-green-100 text-sm">Dokumen Tersimpan</p>
            </div>
            
            <!-- Statistik 2 -->
            <div class="bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-2xl p-8 text-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-4xl"></i>
                </div>
                <span class="text-sm font-semibold mb-2 block">Pengguna</span>
                <h4 class="text-2xl font-bold mb-2">
                    <?php
                    try {
                        $count = Guru::find()->count();
                        echo $count > 0 ? $count : '50+';
                    } catch (\Exception $e) {
                        echo '50+';
                    }
                    ?>
                </h4>
                <p class="text-green-100 text-sm">Data Terkelola</p>
            </div>
            
            <!-- Statistik 3 -->
            <div class="bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-2xl p-8 text-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tags text-4xl"></i>
                </div>
                <span class="text-sm font-semibold mb-2 block">Kategori</span>
                <h4 class="text-2xl font-bold mb-2">
                    <?php
                    try {
                        $count = JenisDokumen::find()->count();
                        echo $count > 0 ? $count : '10+';
                    } catch (\Exception $e) {
                        echo '10+';
                    }
                    ?>
                </h4>
                <p class="text-green-100 text-sm">Jenis Dokumen</p>
            </div>
        </div>
    </div>
</section>

<!-- Guru & Tendik Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Guru & Tendik</h2>
            <p class="text-gray-600">Jajaran Guru <?= Html::encode(Yii::$app->name) ?></p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php
            $gurus = [];
            try {
                $gurus = Guru::find()->limit(5)->all();
            } catch (\Exception $e) {
                // Database tidak tersedia
            }
            
            if (empty($gurus)):
                for ($i = 1; $i <= 5; $i++): ?>
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900 text-sm mb-1">Guru</h4>
                        <p class="text-xs text-gray-600">Guru Mata Pelajaran</p>
                    </div>
                <?php endfor;
            else:
                foreach ($gurus as $guru): ?>
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-white font-bold text-xl"><?= strtoupper(substr($guru->nama_guru, 0, 2)) ?></span>
                        </div>
                        <h4 class="font-semibold text-gray-900 text-sm mb-1"><?= Html::encode($guru->nama_guru) ?></h4>
                        <p class="text-xs text-gray-600">Guru Mata Pelajaran</p>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
        
        <div class="text-center mt-8">
            <a href="<?= Url::to(['/guru/index']) ?>" class="inline-flex items-center px-6 py-3 bg-[#66BB7A] text-white rounded-full hover:bg-[#5aa769] transition-all duration-300 shadow-lg hover:shadow-xl font-medium">
                Lihat Semua Guru
            </a>
        </div>
    </div>
</section>

<!-- Pengumuman Section -->
<section id="pengumuman" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Pengumuman</h2>
            <p class="text-gray-600">Pengumuman <?= Html::encode(Yii::$app->name) ?></p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pengumuman 1 -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#66BB7A] hover:shadow-2xl transition-all duration-300">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-bullhorn text-[#66BB7A]"></i>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 mb-2 block">Pengumuman</span>
                        <h4 class="font-bold text-gray-900 mb-2">Pengumuman Digitalisasi Arsip 2024</h4>
                        <p class="text-sm text-gray-600">Informasi mengenai program digitalisasi arsip dokumen sekolah tahun 2024.</p>
                    </div>
                </div>
            </div>
            
            <!-- Pengumuman 2 -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#66BB7A] hover:shadow-2xl transition-all duration-300">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-bullhorn text-[#66BB7A]"></i>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 mb-2 block">Pengumuman</span>
                        <h4 class="font-bold text-gray-900 mb-2">Pelatihan Sistem Manajemen Arsip</h4>
                        <p class="text-sm text-gray-600">Pendaftaran pelatihan penggunaan sistem manajemen arsip digital untuk staf sekolah.</p>
                    </div>
                </div>
            </div>
            
            <!-- Pengumuman 3 -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#66BB7A] hover:shadow-2xl transition-all duration-300">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-bullhorn text-[#66BB7A]"></i>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500 mb-2 block">Pengumuman</span>
                        <h4 class="font-bold text-gray-900 mb-2">Update Sistem Manajemen Arsip</h4>
                        <p class="text-sm text-gray-600">Pembaruan fitur dan perbaikan sistem manajemen arsip untuk meningkatkan performa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galeri Section -->
<section id="galeri" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Galeri Kegiatan</h2>
            <p class="text-gray-600">Galeri Kegiatan <?= Html::encode(Yii::$app->name) ?></p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="relative group overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-square bg-gradient-to-br from-[#66BB7A] to-[#5aa769] flex items-center justify-center">
                        <i class="fas fa-image text-white text-4xl"></i>
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        
        <div class="text-center mt-8">
            <a href="#" class="inline-flex items-center px-6 py-3 bg-[#66BB7A] text-white rounded-full hover:bg-[#5aa769] transition-all duration-300 shadow-lg hover:shadow-xl font-medium">
                Lihat Semua
            </a>
        </div>
    </div>
</section>

<!-- Testimonial Section (mengganti Cerita Alumni) -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Testimoni Pengguna</h2>
            <p class="text-gray-600">Pengalaman beberapa pengguna sistem kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-full flex items-center justify-center mr-4">
                        <span class="text-white font-bold text-xl">AK</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Admin Sekolah</h4>
                        <p class="text-sm text-gray-600">Pengguna Sistem</p>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed">"Sistem ini sangat membantu dalam mengelola arsip dokumen. Pencarian dokumen menjadi lebih cepat dan mudah."</p>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#66BB7A] to-[#5aa769] rounded-full flex items-center justify-center mr-4">
                        <span class="text-white font-bold text-xl">PS</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Petugas Arsip</h4>
                        <p class="text-sm text-gray-600">Pengguna Sistem</p>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed">"Dengan sistem ini, pengelolaan arsip dokumen menjadi lebih terorganisir dan efisien. Sangat direkomendasikan!"</p>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-fade-in { animation: fade-in 1s ease-out; }

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
