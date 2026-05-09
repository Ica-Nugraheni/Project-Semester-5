<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/user-akun/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
