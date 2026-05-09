<?php

namespace app\controllers;

use app\models\ArsipDokumenGuru;
use app\models\ArsipDokumenGuruSearch;
use app\models\UserAkun;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * ArsipDokumenGuruController implements the CRUD actions for ArsipDokumenGuru model.
 */
class ArsipDokumenGuruController extends Controller
{
    public $layout = 'admin';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'roles' => ['@'], // Semua user yang login bisa read
                        ],
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete'],
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                $user = Yii::$app->user->identity;
                                // Hanya admin dan petugas yang bisa CRUD, pengawas hanya read
                                return $user && in_array($user->role, [UserAkun::ROLE_ADMIN, UserAkun::ROLE_PETUGAS]);
                            }
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ArsipDokumenGuru models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArsipDokumenGuruSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('@app/views/admin/arsip-dokumen-guru/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);



        
    }
        

    /**
     * Displays a single ArsipDokumenGuru model.
     * @param int $id_arsip_guru Id Arsip Guru
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_arsip_guru)
    {
        return $this->render('@app/views/admin/arsip-dokumen-guru/view', [
            'model' => $this->findModel($id_arsip_guru),
        ]);

        
    }

    /**
     * Creates a new ArsipDokumenGuru model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id_guru The ID of the Guru
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_guru = null)
    {
        $model = new ArsipDokumenGuru();
        $guru = null;
        
        // Auto-fill id_guru if provided
        if ($id_guru) {
            $model->id_guru = $id_guru;
            $guru = \app\models\Guru::findOne($id_guru);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Handle file upload
                $file = UploadedFile::getInstance($model, 'file_path');
                if ($file && !$file->error) {
                    $uploadDir = \Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-guru/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    // Sanitize filename
                    $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->baseName) . '.' . $file->extension;
                    $filePath = $uploadDir . $fileName;
                    
                    if ($file->saveAs($filePath)) {
                        $model->file_path = 'uploads/arsip-dokumen-guru/' . $fileName;
                    } else {
                        \Yii::$app->session->addFlash('error', 'Gagal menyimpan file');
                    }
                }
                
                if ($model->save()) {
                    return $this->redirect(['view', 'id_arsip_guru' => $model->id_arsip_guru]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('@app/views/admin/arsip-dokumen-guru/create', [
            'model' => $model,
            'guru' => $guru,
        ]);
    }

    /**
     * Updates an existing ArsipDokumenGuru model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_arsip_guru Id Arsip Guru
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_arsip_guru)
    {
        $model = $this->findModel($id_arsip_guru);
        $guru = \app\models\Guru::findOne($model->id_guru);

        if ($this->request->isPost && $model->load($this->request->post())) {
            // Handle file upload
            $file = UploadedFile::getInstance($model, 'file_path');
            if ($file && !$file->error) {
                // Delete old file if exists
                if ($model->file_path && file_exists(\Yii::getAlias('@webroot') . '/' . $model->file_path)) {
                    unlink(\Yii::getAlias('@webroot') . '/' . $model->file_path);
                }
                
                $uploadDir = \Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-guru/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                // Sanitize filename
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->baseName) . '.' . $file->extension;
                $filePath = $uploadDir . $fileName;
                
                if ($file->saveAs($filePath)) {
                    $model->file_path = 'uploads/arsip-dokumen-guru/' . $fileName;
                } else {
                    \Yii::$app->session->addFlash('error', 'Gagal menyimpan file');
                }
            }
            
            if ($model->save()) {
                return $this->redirect(['view', 'id_arsip_guru' => $model->id_arsip_guru]);
            }
        }

                 return $this->render('@app/views/admin/arsip-dokumen-guru/update', [
                    'model' => $model,
                    'guru'  => $guru,
                ]);
    }

    /**
     * Deletes an existing ArsipDokumenGuru model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_arsip_guru Id Arsip Guru
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_arsip_guru)
    {
        $this->findModel($id_arsip_guru)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArsipDokumenGuru model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_arsip_guru Id Arsip Guru
     * @return ArsipDokumenGuru the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_arsip_guru)
    {
        if (($model = ArsipDokumenGuru::findOne(['id_arsip_guru' => $id_arsip_guru])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
