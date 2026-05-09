<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property int $id_siswa
 * @property string $nis
 * @property string $nama_siswa
 * @property string|null $kelas
 * @property string|null $jurusan
 * @property string|null $alamat
 * @property string|null $no_telp
 *
 * @property ArsipDokumenSiswa[] $arsipDokumenSiswas
 */
class Siswa extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kelas', 'jurusan', 'alamat', 'no_telp'], 'default', 'value' => null],
            [['nis', 'nama_siswa'], 'required'],
            [['alamat'], 'string'],
            [['nis'], 'string', 'max' => 30],
            [['nama_siswa'], 'string', 'max' => 100],
            [['kelas', 'no_telp'], 'string', 'max' => 20],
            [['jurusan'], 'string', 'max' => 50],
            [['nis'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_siswa' => 'Id Siswa',
            'nis' => 'Nis',
            'nama_siswa' => 'Nama Siswa',
            'kelas' => 'Kelas',
            'jurusan' => 'Jurusan',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
        ];
    }

    /**
     * Gets query for [[ArsipDokumenSiswas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArsipDokumenSiswas()
    {
        return $this->hasMany(ArsipDokumenSiswa::class, ['id_siswa' => 'id_siswa']);
    }

}
