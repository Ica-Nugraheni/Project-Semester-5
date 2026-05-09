<?php

namespace app\controllers;

use app\models\JenisDokumen;
use app\models\JenisDokumenSearch;
use app\models\UserAkun;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JenisDokumenController implements the CRUD actions for JenisDokumen model.
 */
class JenisDokumenController extends Controller
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
     * Lists all JenisDokumen models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JenisDokumenSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JenisDokumen model.
     * @param int $id_jenis Id Jenis
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_jenis)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_jenis),
        ]);
    }

    /**
     * Creates a new JenisDokumen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JenisDokumen();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_jenis' => $model->id_jenis]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JenisDokumen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_jenis Id Jenis
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_jenis)
    {
        $model = $this->findModel($id_jenis);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_jenis' => $model->id_jenis]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JenisDokumen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_jenis Id Jenis
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_jenis)
    {
        $this->findModel($id_jenis)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JenisDokumen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_jenis Id Jenis
     * @return JenisDokumen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_jenis)
    {
        if (($model = JenisDokumen::findOne(['id_jenis' => $id_jenis])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
