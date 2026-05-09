<?php
/** @var \yii\web\View $this */
use app\assets\AdminAsset;
use app\models\UserAkun;
use yii\helpers\Html;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="admin-layout">
    <aside class="admin-sidebar">
        <?php 
        $cur = Yii::$app->controller->id; 
        $currentRole = Yii::$app->user->identity->role ?? null;
        // Semua role menggunakan dashboard backend
        $dashboardUrl = \yii\helpers\Url::to(['/admin/index']);
        $dashboardActive = ($cur == 'admin');
        ?>
        <div class="brand">
            <div class="brand-logo">E</div>
            <div class="brand-text">
                <div class="brand-title">E-Arsip Dokumen Sekolah</div>
                <div class="brand-sub">Tata Usaha - Tata Usaha</div>
            </div>
        </div>
        <nav>
            <a class="<?= $dashboardActive ? 'active' : '' ?>" href="<?= $dashboardUrl ?>">Dashboard</a>
            <a class="<?= $cur=='guru' ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['/guru/index']) ?>">Data Guru</a>
            <a class="<?= $cur=='siswa' ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['/siswa/index']) ?>">Data Siswa</a>
            <a class="<?= $cur=='jenis-dokumen' ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['/jenis-dokumen/index']) ?>">Kategori Dokumen</a>
            <a class="<?= $cur=='arsip-dokumen-guru' ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['/arsip-dokumen-guru/index']) ?>">Arsip Dokumen Guru</a>
            <a class="<?= $cur=='arsip-dokumen-siswa' ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['/arsip-dokumen-siswa/index']) ?>">Arsip Dokumen Siswa</a>
            <?php if ($currentRole !== UserAkun::ROLE_PENGAWAS): ?>
            <a class="<?= $cur=='user-akun' ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['/user-akun/index']) ?>">Manajemen User</a>
            <?php 
            $isPageSettings = (Yii::$app->controller->id == 'admin' && isset(Yii::$app->controller->action) && Yii::$app->controller->action->id == 'page-settings');
            ?>
            <a class="<?= $isPageSettings ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['/admin/page-settings']) ?>">Pengaturan Halaman</a>
            <?php endif; ?>
        </nav>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <div class="top-left"><?= Html::encode($this->title ?: 'Admin Panel') ?></div>
            <div class="top-right">
                <?= Html::a('LogOut', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </header>

        <main class="admin-content">
            <?= $content ?>
        </main>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
