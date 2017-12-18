<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;
use common\components\MyDate;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'address_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'fname', 'lname', 'fb_id' ,'created_at','updated_at','province_name','auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
           // 'created_at' => $this->created_at,
         //   'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'fb_id', $this->fb_id])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like','address.province_name',$this->province_name])
            ->andFilterWhere(['like', 'email', $this->email]);
            if (!empty($this->created_at) ){
                $query->andFilterWhere(['<= ','created_at',MyDate::TimeDigit2int($this->created_at)])->orderBy(['created_at'=>SORT_DESC]);
            }
            
            if (!empty($params['usersearch-created_at_convert'])){
                $query->andFilterWhere(['<= ','created_at',MyDate::TimeDigit2int($params['usersearch-created_at_convert'])])->orderBy(['created_at'=>SORT_DESC]);
            }
            if (!empty($this->updated_at) ){
                $query->andFilterWhere(['<=','updated_at',MyDate::TimeDigit2int($this->updated_at)])->orderBy(['updated_at'=>SORT_DESC]);
                //	$query = null;
            }
            
            if (!empty($params['usersearch-updated_at_convert'])){
                $query->andFilterWhere(['<=','updated_at',MyDate::TimeDigit2int($params['usersearch-updated_at_convert'])])->orderBy(['updated_at'=>SORT_DESC]);
                //	$query = null;
            }

        return $dataProvider;
    }
}
