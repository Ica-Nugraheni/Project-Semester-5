<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\GuruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/guru/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
