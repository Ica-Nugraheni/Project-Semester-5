<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\SiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/siswa/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
