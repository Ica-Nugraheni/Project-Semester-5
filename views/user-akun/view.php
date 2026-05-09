<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/user-akun/view', [
    'model' => $model,
]);
