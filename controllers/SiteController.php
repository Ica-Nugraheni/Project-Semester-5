<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\UserAkun;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
           // 'captcha' => [
              //  'class' => 'yii\captcha\CaptchaAction',
              //  'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
          //  ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            // Semua user diarahkan ke dashboard backend
            return $this->redirect(['admin/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Semua user diarahkan ke dashboard backend setelah login
            $user = Yii::$app->user->identity;
            if ($user) {
                // Hapus returnUrl dari session
                $returnUrlParam = Yii::$app->user->returnUrlParam;
                Yii::$app->session->remove($returnUrlParam);
                
                // Set returnUrl ke dashboard admin
                Yii::$app->user->setReturnUrl(['admin/index']);
                // Redirect ke dashboard backend
                return $this->redirect(['admin/index'], 302);
            }
            // Fallback jika role tidak dikenali
            return $this->redirect(['admin/index'], 302);
        }
        

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Register action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->register()) {
                Yii::$app->session->setFlash('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
                return $this->redirect(['login']);
            } else {
                // Get first error message for flash
                $errors = $model->getFirstErrors();
                if (!empty($errors)) {
                    Yii::$app->session->setFlash('error', 'Registrasi gagal: ' . reset($errors));
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
