<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArsipDokumenSiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->context->layout = 'admin';
echo $this->render('@app/views/admin/arsip-dokumen-siswa/index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
