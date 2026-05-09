<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id_user
 * @property string $username
 * @property string $password
 * @property string $nama_lengkap
 * @property string $email
 * @property string $role
 *
 * @property ArsipDokumenGuru[] $arsipDokumenGurus
 * @property ArsipDokumenSiswa[] $arsipDokumenSiswas
 */
class UserAkun extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * ENUM field values
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_PETUGAS = 'petugas';
    const ROLE_PENGAWAS = 'pengawas';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'nama_lengkap', 'email', 'role'], 'required'],
            [['role'], 'string'],
            [['username'], 'string', 'max' => 50],
            [['password', 'nama_lengkap', 'email'], 'string', 'max' => 100],
            ['role', 'in', 'range' => array_keys(self::optsRole())],
            [['username'], 'unique'],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'nama_lengkap' => 'Nama Lengkap',
            'email' => 'Email',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[ArsipDokumenGurus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArsipDokumenGurus()
    {
        return $this->hasMany(ArsipDokumenGuru::class, ['id_user' => 'id_user']);
    }

    /**
     * Gets query for [[ArsipDokumenSiswas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArsipDokumenSiswas()
    {
        return $this->hasMany(ArsipDokumenSiswa::class, ['id_user' => 'id_user']);
    }


    /**
     * column role ENUM value labels
     * @return string[]
     */
    public static function optsRole()
    {
        return [
            self::ROLE_ADMIN => 'admin',
            self::ROLE_PETUGAS => 'petugas',
            self::ROLE_PENGAWAS => 'pengawas',
        ];
    }

    /**
     * @return string
     */
    public function displayRole()
    {
        return self::optsRole()[$this->role];
    }

    /**
     * @return bool
     */
    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setRoleToAdmin()
    {
        $this->role = self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isRolePetugas()
    {
        return $this->role === self::ROLE_PETUGAS;
    }

    public function setRoleToPetugas()
    {
        $this->role = self::ROLE_PETUGAS;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username.
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates a plaintext password against the stored hash.
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Hash password if it's been modified and is not already hashed
            if ($this->isAttributeChanged('password')) {
                // Check if password is already hashed (bcrypt hashes start with $2y$ or $2a$)
                if (!preg_match('/^\$2[ay]\$\d{2}\$/', $this->password)) {
                    $this->password = Yii::$app->security->generatePasswordHash($this->password);
                }
            }
            // Set default role if empty
            if (empty($this->role)) {
                $this->role = self::ROLE_PENGAWAS;
            }
            return true;
        }
        return false;
    }
}
