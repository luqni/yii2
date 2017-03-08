<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Dosen;

/**
 * DosenSearch represents the model behind the search form about `frontend\models\Dosen`.
 */
class DosenSearch extends Dosen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nidn', 'nama', 'tmp_lahir', 'tgl_lahir', 'jk'], 'safe'],
            [['prodi_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Dosen::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tgl_lahir' => $this->tgl_lahir,
            'prodi_id' => $this->prodi_id,
        ]);

        $query->andFilterWhere(['like', 'nidn', $this->nidn])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tmp_lahir', $this->tmp_lahir])
            ->andFilterWhere(['like', 'jk', $this->jk]);

        return $dataProvider;
    }
}
