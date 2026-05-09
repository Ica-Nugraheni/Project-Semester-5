<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Guru $model */

$this->title = 'Update Guru: ' . $model->id_guru;
$this->params['breadcrumbs'][] = ['label' => 'Gurus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_guru, 'url' => ['view', 'id_guru' => $model->id_guru]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guru-update">
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
