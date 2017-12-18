<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Joinwork;

/**
 * JoinworkSearch represents the model behind the search form about `common\models\Joinwork`.
 */
class JoinworkSuccessSearch extends Joinwork
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'point', 'work_id', 'user_id'], 'integer'],
            [['comment'], 'safe'],
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
        $query = Joinwork::find()->where(['join_status'=>Joinwork::STATUS_SUCCESS,'created_work'=>\Yii::$app->user->id])->orderBy(['join_updated_at'=>SORT_DESC]);
        
           
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
            'point' => $this->point,
            'work_id' => $this->work_id,
            'user_id' => $this->user_id,
            'join_status' => $this->join_status,
            'join_created_at' => $this->join_created_at,
            'join_updated_at' => $this->join_updated_at,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
                ->andFilterWhere(['like','user.fname',$this->name_user])
                ->andFilterWhere(['like','work.name_office',$this->name_work]);

        return $dataProvider;
    }
}
