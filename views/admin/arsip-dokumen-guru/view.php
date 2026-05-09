<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\UserAkun;

/** @var yii\web\View $this */
/** @var app\models\ArsipDokumenGuru $model */

$this->title = $model->id_arsip_guru;
$this->params['breadcrumbs'][] = ['label' => 'Arsip Dokumen Gurus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="arsip-dokumen-guru-view">
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
            <h4 class="m-0"><?= Html::encode($this->title) ?></h4>
            <div>
                <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role !== UserAkun::ROLE_PENGAWAS): ?>
                    <?= Html::a('Update', ['update', 'id_arsip_guru' => $model->id_arsip_guru], ['class' => 'btn btn-toska']) ?>
                    <?= Html::a('Delete', ['delete', 'id_arsip_guru' => $model->id_arsip_guru], [
                        'class' => 'btn btn-outline-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_arsip_guru',
                'id_guru',
                'id_jenis',
                'judul_dokumen',
                'tanggal_upload',
                [
                    'attribute' => 'file_path',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->file_path) {
                            $filePath = Yii::getAlias('@webroot') . '/' . $model->file_path;
                            if (file_exists($filePath)) {
                                return Html::a('Download File', ['/file/download-guru', 'filename' => basename($model->file_path)], ['target' => '_blank', 'class' => 'btn btn-sm btn-primary']);
                            } else {
                                return 'File tidak ditemukan';
                            }
                        }
                        return '-';
                    },
                ],
                'keterangan:ntext',
                'id_user',
            ],
        ]) ?>
    </div>
</div>
