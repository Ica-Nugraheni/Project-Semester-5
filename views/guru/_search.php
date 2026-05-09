<?php
/* @var $this yii\web\View */
/* @var $model app\models\GuruSearch */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/guru/_search', [
    'model' => $model,
]);
