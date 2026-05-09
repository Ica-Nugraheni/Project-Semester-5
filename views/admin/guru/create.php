<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Guru $model */

$this->title = 'Tambah Data Guru';
$this->params['breadcrumbs'][] = ['label' => 'Data Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="guru-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
