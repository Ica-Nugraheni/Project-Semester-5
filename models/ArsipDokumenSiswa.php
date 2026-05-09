<?php

namespace app\models;

use Yii;
use app\models\UserAkun;

/**
 * This is the model class for table "arsip_dokumen_siswa".
 *
 * @property int $id_arsip_siswa
 * @property int $id_siswa
 * @property int $id_jenis
 * @property string $judul_dokumen
 * @property string $tanggal_upload
 * @property string|null $file_path
 * @property string|null $keterangan
 * @property int|null $id_user
 *
 * @property JenisDokumen $jenis
 * @property Siswa $siswa
 * @property User $user
 */
class ArsipDokumenSiswa extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arsip_dokumen_siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_path', 'keterangan', 'id_user'], 'default', 'value' => null],
            [['id_siswa', 'id_jenis', 'judul_dokumen', 'tanggal_upload'], 'required'],
            [['id_siswa', 'id_jenis', 'id_user'], 'integer'],
            [['tanggal_upload'], 'safe'],
            [['keterangan'], 'string'],
            [['judul_dokumen'], 'string', 'max' => 150],
            [['file_path'], 'string', 'max' => 255],
            [['id_siswa'], 'exist', 'skipOnError' => true, 'targetClass' => Siswa::class, 'targetAttribute' => ['id_siswa' => 'id_siswa']],
            [['id_jenis'], 'exist', 'skipOnError' => true, 'targetClass' => JenisDokumen::class, 'targetAttribute' => ['id_jenis' => 'id_jenis']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_arsip_siswa' => 'Id Arsip Siswa',
            'id_siswa' => 'Id Siswa',
            'id_jenis' => 'Id Jenis',
            'judul_dokumen' => 'Judul Dokumen',
            'tanggal_upload' => 'Tanggal Upload',
            'file_path' => 'File Path',
            'keterangan' => 'Keterangan',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[Jenis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasOne(JenisDokumen::class, ['id_jenis' => 'id_jenis']);
    }

    /**
     * Gets query for [[Siswa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasOne(Siswa::class, ['id_siswa' => 'id_siswa']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserAkun::class, ['id_user' => 'id_user']);
    }

}
