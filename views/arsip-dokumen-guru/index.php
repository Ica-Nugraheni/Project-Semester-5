<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArsipDokumenGuruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/arsip-dokumen-guru/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
