<?php
/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/user-akun/_search', [
    'model' => $model,
]);
