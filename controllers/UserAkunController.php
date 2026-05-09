<?php

namespace app\controllers;

use app\models\UserAkun;
use app\models\UserAkunSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * UserAkunController implements the CRUD actions for UserAkun model.
 */
class UserAkunController extends Controller
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
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                $user = Yii::$app->user->identity;
                                // Hanya admin dan petugas yang bisa CRUD user, pengawas hanya read
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
     * Lists all UserAkun models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserAkunSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('@app/views/admin/user-akun/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserAkun model.
     * @param int $id_user Id User
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_user)
    {
        return $this->render('@app/views/admin/user-akun/view', [
            'model' => $this->findModel($id_user),
        ]);
    }

    /**
     * Creates a new UserAkun model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserAkun();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_user' => $model->id_user]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('@app/views/admin/user-akun/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserAkun model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_user Id User
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_user)
    {
        $model = $this->findModel($id_user);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_user' => $model->id_user]);
        }

         return $this->render('@app/views/admin/user-akun/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserAkun model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_user Id User
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_user)
    {
        $this->findModel($id_user)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserAkun model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_user Id User
     * @return UserAkun the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_user)
    {
        if (($model = UserAkun::findOne(['id_user' => $id_user])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
