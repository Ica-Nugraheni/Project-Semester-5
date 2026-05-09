<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_dokumen".
 *
 * @property int $id_jenis
 * @property string $nama_jenis
 * @property string|null $deskripsi
 *
 * @property ArsipDokumenGuru[] $arsipDokumenGurus
 * @property ArsipDokumenSiswa[] $arsipDokumenSiswas
 */
class JenisDokumen extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_dokumen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deskripsi'], 'default', 'value' => null],
            [['nama_jenis'], 'required'],
            [['deskripsi'], 'string'],
            [['nama_jenis'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jenis' => 'Id Jenis',
            'nama_jenis' => 'Nama Jenis',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * Gets query for [[ArsipDokumenGurus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArsipDokumenGurus()
    {
        return $this->hasMany(ArsipDokumenGuru::class, ['id_jenis' => 'id_jenis']);
    }

    /**
     * Gets query for [[ArsipDokumenSiswas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArsipDokumenSiswas()
    {
        return $this->hasMany(ArsipDokumenSiswa::class, ['id_jenis' => 'id_jenis']);
    }

}
