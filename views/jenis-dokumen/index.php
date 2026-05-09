<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\JenisDokumenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/jenis-dokumen/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
