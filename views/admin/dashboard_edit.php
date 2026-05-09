<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \yii\web\View $this */
/* @var $models app\models\DashboardConfig[] */

$this->title = 'Edit Dashboard';
?>
<div class="container-fluid">
    <h3>Edit Dashboard</h3>

    <?php $form = ActiveForm::begin(); ?>

    <table class="table table-sm">
        <thead>
            <tr>
                <th style="width:40px">#</th>
                <th>Key</th>
                <th>Label</th>
                <th>Value</th>
                <th>Note</th>
                <th style="width:80px">Visible</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $i => $m): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><code><?= Html::encode($m->key) ?></code></td>
                <td>
                    <?= Html::activeTextInput($m, "[{$m->id}]label", ['class'=>'form-control']) ?>
                </td>
                <td>
                    <?= Html::activeTextInput($m, "[{$m->id}]value", ['class'=>'form-control']) ?>
                </td>
                <td>
                    <?= Html::activeTextInput($m, "[{$m->id}]note", ['class'=>'form-control']) ?>
                </td>
                <td>
                    <?= Html::activeCheckbox($m, "[{$m->id}]visible") ?>
                    <?= Html::activeHiddenInput($m, "[{$m->id}]sort") ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div style="display:flex;gap:8px">
        <?= Html::submitButton('Save', ['class'=>'btn btn-toska']) ?>
        <?= Html::a('Cancel', ['index'], ['class'=>'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
