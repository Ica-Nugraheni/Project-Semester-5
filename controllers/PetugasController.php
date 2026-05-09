<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\UserAkun;
use Yii;

/**
 * Dashboard untuk petugas - redirect ke admin dashboard karena sama.
 * Controller ini tetap ada untuk kompatibilitas, tapi akan redirect ke admin/index
 */
class PetugasController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $user = Yii::$app->user->identity;
                            // Hanya admin dan petugas yang bisa akses, akan redirect ke admin dashboard
                            return $user && in_array($user->role, [UserAkun::ROLE_ADMIN, UserAkun::ROLE_PETUGAS]);
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    $user = Yii::$app->user->identity;
                    if ($user) {
                        // Redirect ke dashboard sesuai role
                        if ($user->role === UserAkun::ROLE_PENGAWAS) {
                            return Yii::$app->getResponse()->redirect(['pengawas/index']);
                        }
                    }
                    return Yii::$app->getResponse()->redirect(['site/login']);
                }
            ],
        ];
    }

    public function actionIndex()
    {
        // Redirect ke admin dashboard karena admin dan petugas menggunakan dashboard yang sama
        return $this->redirect(['admin/index']);
    }
}

