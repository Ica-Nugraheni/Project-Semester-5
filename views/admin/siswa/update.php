<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Siswa $model */

$this->title = 'Update Siswa: ' . $model->id_siswa;
$this->params['breadcrumbs'][] = ['label' => 'Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_siswa, 'url' => ['view', 'id_siswa' => $model->id_siswa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siswa-update">
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
