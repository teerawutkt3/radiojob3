<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Address;

/**
 * AddressSearch represents the model behind the search form about `common\models\Address`.
 */
class AddressSearch extends Address
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_id', 'amphur_id', 'province_id', 'geo_id'], 'integer'],
            [['district_code', 'district_name', 'amphur_code', 'amphur_name', 'province_code', 'province_name', 'geo_name'], 'safe'],
            [['lat', 'long'], 'number'],
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
        $query = Address::find();

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
            'id' => $this->id,
            'district_id' => $this->district_id,
            'amphur_id' => $this->amphur_id,
            'province_id' => $this->province_id,
            'geo_id' => $this->geo_id,
            'lat' => $this->lat,
            'long' => $this->long,
        ]);

        $query->andFilterWhere(['like', 'district_code', $this->district_code])
            ->andFilterWhere(['like', 'district_name', $this->district_name])
            ->andFilterWhere(['like', 'amphur_code', $this->amphur_code])
            ->andFilterWhere(['like', 'amphur_name', $this->amphur_name])
            ->andFilterWhere(['like', 'province_code', $this->province_code])
            ->andFilterWhere(['like', 'province_name', $this->province_name])
            ->andFilterWhere(['like', 'geo_name', $this->geo_name]);

        return $dataProvider;
    }
}
