<?php

namespace app\controllers;

use app\models\Guru;
use app\models\GuruSearch;
use app\models\UserAkun;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * GuruController implements the CRUD actions for Guru model.
 */
class GuruController extends Controller
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
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'cetak'],
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
     * Lists all Guru models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GuruSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Guru model.
     * @param int $id_guru Id Guru
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_guru)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_guru),
        ]);
    }

    public function actionCetak()
    {
        $this->layout = 'print'; // Gunakan layout khusus cetak

        $dataProvider = new ActiveDataProvider([
            'query' => Guru::find(),
            'pagination' => false,
        ]);

        return $this->render('cetak', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Guru model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Guru();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_guru' => $model->id_guru]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Guru model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_guru Id Guru
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_guru)
    {
        $model = $this->findModel($id_guru);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_guru' => $model->id_guru]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Guru model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_guru Id Guru
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_guru)
    {
        $this->findModel($id_guru)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Guru model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_guru Id Guru
     * @return Guru the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_guru)
    {
        if (($model = Guru::findOne(['id_guru' => $id_guru])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
