<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserAkun $model */

$this->title = 'Tambah Akun Pengguna';
$this->params['breadcrumbs'][] = ['label' => 'Akun Pengguna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-akun-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
