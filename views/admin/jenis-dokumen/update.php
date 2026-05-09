<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\JenisDokumen $model */

$this->title = 'Update Jenis Dokumen: ' . $model->id_jenis;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jenis, 'url' => ['view', 'id_jenis' => $model->id_jenis]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-dokumen-update">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
