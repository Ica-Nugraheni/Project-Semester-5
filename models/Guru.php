<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "guru".
 *
 * @property int $id_guru
 * @property string $nip
 * @property string $nama_guru
 * @property string|null $jabatan
 * @property string|null $alamat
 * @property string|null $no_telp
 *
 * @property ArsipDokumenGuru[] $arsipDokumenGurus
 */
class Guru extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guru';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jabatan', 'alamat', 'no_telp'], 'default', 'value' => null],
            [['nip', 'nama_guru'], 'required'],
            [['alamat'], 'string'],
            [['nip'], 'string', 'max' => 30],
            [['nama_guru'], 'string', 'max' => 100],
            [['jabatan'], 'string', 'max' => 50],
            [['no_telp'], 'string', 'max' => 20],
            [['nip'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_guru' => 'Id Guru',
            'nip' => 'Nip',
            'nama_guru' => 'Nama Guru',
            'jabatan' => 'Jabatan',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
        ];
    }

    /**
     * Gets query for [[ArsipDokumenGurus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArsipDokumenGurus()
    {
        return $this->hasMany(ArsipDokumenGuru::class, ['id_guru' => 'id_guru']);
    }

}
