<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ArsipDokumenSiswa;

/**
 * ArsipDokumenSiswaSearch represents the model behind the search form of `app\models\ArsipDokumenSiswa`.
 */
class ArsipDokumenSiswaSearch extends ArsipDokumenSiswa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_arsip_siswa', 'id_siswa', 'id_jenis', 'id_user'], 'integer'],
            [['judul_dokumen', 'tanggal_upload', 'file_path', 'keterangan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = ArsipDokumenSiswa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_arsip_siswa' => $this->id_arsip_siswa,
            'id_siswa' => $this->id_siswa,
            'id_jenis' => $this->id_jenis,
            'tanggal_upload' => $this->tanggal_upload,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'judul_dokumen', $this->judul_dokumen])
            ->andFilterWhere(['like', 'file_path', $this->file_path])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
