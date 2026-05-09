<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Guru $model */

$this->title = $model->id_guru;
$this->params['breadcrumbs'][] = ['label' => 'Gurus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="guru-view">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
            <div>
                <?= Html::a('Update', ['update', 'id_guru' => $model->id_guru], ['class' => 'btn btn-toska']) ?>
                <?= Html::a('Delete', ['delete', 'id_guru' => $model->id_guru], [
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
                'id_guru',
                'nip',
                'nama_guru',
                'jabatan',
                'alamat:ntext',
                'no_telp',
            ],
        ]) ?>
    </div>
</div>
