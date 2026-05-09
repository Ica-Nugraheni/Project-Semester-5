<?php

namespace app\controllers;

use app\models\ArsipDokumenSiswa;
use app\models\ArsipDokumenSiswaSearch;
use app\models\UserAkun;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * ArsipDokumenSiswaController implements the CRUD actions for ArsipDokumenSiswa model.
 */
class ArsipDokumenSiswaController extends Controller
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
     * Lists all ArsipDokumenSiswa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArsipDokumenSiswaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('@app/views/admin/arsip-dokumen-siswa/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArsipDokumenSiswa model.
     * @param int $id_arsip_siswa Id Arsip Siswa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_arsip_siswa)
    {
        return $this->render('@app/views/admin/arsip-dokumen-siswa/view', [
            'model' => $this->findModel($id_arsip_siswa),
        ]);
    }

    /**
     * Creates a new ArsipDokumenSiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id_siswa The ID of the Siswa
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_siswa = null)
    {
        $model = new ArsipDokumenSiswa();
        $siswa = null;
        
        // Auto-fill id_siswa if provided
        if ($id_siswa) {
            $model->id_siswa = $id_siswa;
            $siswa = \app\models\Siswa::findOne($id_siswa);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Handle file upload
                $file = UploadedFile::getInstance($model, 'file_path');
                if ($file && !$file->error) {
                    $uploadDir = \Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-siswa/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    // Sanitize filename
                    $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->baseName) . '.' . $file->extension;
                    $filePath = $uploadDir . $fileName;
                    
                    if ($file->saveAs($filePath)) {
                        $model->file_path = 'uploads/arsip-dokumen-siswa/' . $fileName;
                    } else {
                        \Yii::$app->session->addFlash('error', 'Gagal menyimpan file');
                    }
                }
                
                if ($model->save()) {
                    return $this->redirect(['view', 'id_arsip_siswa' => $model->id_arsip_siswa]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('@app/views/admin/arsip-dokumen-siswa/create', [
            'model' => $model,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Updates an existing ArsipDokumenSiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_arsip_siswa Id Arsip Siswa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_arsip_siswa)
    {
        $model = $this->findModel($id_arsip_siswa);
        $siswa = \app\models\Siswa::findOne($model->id_siswa);

        if ($this->request->isPost && $model->load($this->request->post())) {
            // Handle file upload
            $file = UploadedFile::getInstance($model, 'file_path');
            if ($file && !$file->error) {
                // Delete old file if exists
                if ($model->file_path && file_exists(\Yii::getAlias('@webroot') . '/' . $model->file_path)) {
                    unlink(\Yii::getAlias('@webroot') . '/' . $model->file_path);
                }
                
                $uploadDir = \Yii::getAlias('@webroot') . '/uploads/arsip-dokumen-siswa/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                // Sanitize filename
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->baseName) . '.' . $file->extension;
                $filePath = $uploadDir . $fileName;
                
                if ($file->saveAs($filePath)) {
                    $model->file_path = 'uploads/arsip-dokumen-siswa/' . $fileName;
                } else {
                    \Yii::$app->session->addFlash('error', 'Gagal menyimpan file');
                }
            }
            
            if ($model->save()) {
                return $this->redirect(['view', 'id_arsip_siswa' => $model->id_arsip_siswa]);
            }
        }
        
        return $this->render('@app/views/admin/arsip-dokumen-siswa/update', [
            'model' => $model,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Deletes an existing ArsipDokumenSiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_arsip_siswa Id Arsip Siswa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_arsip_siswa)
    {
        $this->findModel($id_arsip_siswa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArsipDokumenSiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_arsip_siswa Id Arsip Siswa
     * @return ArsipDokumenSiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_arsip_siswa)
    {
        if (($model = ArsipDokumenSiswa::findOne(['id_arsip_siswa' => $id_arsip_siswa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
