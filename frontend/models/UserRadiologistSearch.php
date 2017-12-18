<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserRadiologistSearch extends User
{
    /**
     * @inheritdoc
     */
  //  public  $province_name;
    public function rules()
    {
        return [
            [['id', 'status', 'address_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'fname', 'lname', 'fb_id', 'auth_key', 'password_hash','province_name', 'password_reset_token', 'email'
            ,'geo_id','province_id','amphur_id','district_id'
                
            ], 'safe'],
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
        $query = User::find();
        $query->joinWith(['address']);

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
            'status' => $this->status,
            'address_id' => $this->address_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'fb_id', $this->fb_id])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like','address.province_name',$this->province_name])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like','address.geo_id',$this->geo_id])
            ->andFilterWhere(['like','address.province_id',$this->province_id])
            ->andFilterWhere(['like','address.amphur_id',$this->amphur_id])
            ->andFilterWhere(['like','address.district_id',$this->district_id])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
