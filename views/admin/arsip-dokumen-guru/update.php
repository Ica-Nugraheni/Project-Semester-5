<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenGuru $model */

$this->title = 'Update Arsip Dokumen Guru: ' . $model->id_arsip_guru;
$this->params['breadcrumbs'][] = ['label' => 'Arsip Dokumen Gurus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_arsip_guru, 'url' => ['view', 'id_arsip_guru' => $model->id_arsip_guru]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="arsip-dokumen-guru-update">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

       <?= $this->render('_form', [
            'model' => $model,
            'guru' => $guru,
        ]) ?>



    </div>
</div>
