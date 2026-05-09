<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\JenisDokumen $model */

$this->title = $model->id_jenis;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Dokumens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jenis-dokumen-view">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
            <div>
                <?= Html::a('Update', ['update', 'id_jenis' => $model->id_jenis], ['class' => 'btn btn-toska']) ?>
                <?= Html::a('Delete', ['delete', 'id_jenis' => $model->id_jenis], [
                    'class' => 'btn btn-outline-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_jenis',
                'nama_jenis',
                'deskripsi:ntext',
            ],
        ]) ?>
    </div>
</div>
