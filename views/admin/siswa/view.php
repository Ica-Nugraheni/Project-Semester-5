<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Siswa $model */

$this->title = $model->id_siswa;
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="siswa-view">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
            <div>
                <?= Html::a('Update', ['update', 'id_siswa' => $model->id_siswa], ['class' => 'btn btn-toska']) ?>
                <?= Html::a('Delete', ['delete', 'id_siswa' => $model->id_siswa], [
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
                'id_siswa',
                'nis',
                'nama_siswa',
                'kelas',
                'jurusan',
                'alamat:ntext',
                'no_telp',
            ],
        ]) ?>
    </div>
</div>
