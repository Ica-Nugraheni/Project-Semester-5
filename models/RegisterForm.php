<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\UserAkun;

/**
 * RegisterForm form
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $nama_lengkap;
    public $email;
    public $role = UserAkun::ROLE_PENGAWAS; // Default role pengawas
   // public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat', 'nama_lengkap', 'email', 'role'], 'required'],
            [['username', 'password', 'nama_lengkap', 'email'], 'string', 'max' => 100],
            ['username', 'string', 'max' => 50],
            ['username', 'unique', 'targetClass' => UserAkun::class, 'message' => 'Username ini sudah digunakan.'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => UserAkun::class, 'message' => 'Email ini sudah digunakan.'],
            ['password', 'string', 'min' => 6, 'message' => 'Password minimal 6 karakter'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Password tidak sama'],
            ['role', 'in', 'range' => [UserAkun::ROLE_ADMIN, UserAkun::ROLE_PETUGAS, UserAkun::ROLE_PENGAWAS], 'message' => 'Role tidak valid'],
          //  ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha', 'skipOnEmpty' => YII_ENV_TEST || YII_ENV_DEV],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'password_repeat' => 'Ulangi Password',
            'nama_lengkap' => 'Nama Lengkap',
            'email' => 'Email',
            'role' => 'Role',
           // 'verifyCode' => 'Kode Verifikasi',
        ];
    }

    /**
     * Get role options for dropdown
     * @return array
     */
    public static function getRoleOptions()
    {
        return [
            UserAkun::ROLE_ADMIN => 'Admin',
            UserAkun::ROLE_PETUGAS => 'Petugas',
            UserAkun::ROLE_PENGAWAS => 'Pengawas',
        ];
    }

    /**
     * Register user
     *
     * @return bool whether the registration was successful
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new UserAkun();
        $user->username = $this->username;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->nama_lengkap = $this->nama_lengkap;
        $user->email = $this->email;
        $user->role = $this->role; // Gunakan role yang dipilih user, tidak ada default

        if ($user->save()) {
            return true;
        } else {
            // Add model errors to form errors
            foreach ($user->getErrors() as $attribute => $errors) {
                foreach ($errors as $error) {
                    $this->addError($attribute, $error);
                }
            }
            return false;
        }
    }
}


