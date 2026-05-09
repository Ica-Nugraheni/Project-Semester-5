<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserAkun $model */

$this->title = 'Update User Akun: ' . $model->id_user;
$this->params['breadcrumbs'][] = ['label' => 'User Akun', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_user, 'url' => ['view', 'id_user' => $model->id_user]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="User-Akun-update">
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
