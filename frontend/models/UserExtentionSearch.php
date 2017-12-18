<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserExtention;

/**
 * UserExtentionSearch represents the model behind the search form about `common\models\UserExtention`.
 */
class UserExtentionSearch extends UserExtention
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['educational_institution', 'education', 'branch', 'experience', 'work_skill', 'language'], 'safe'],
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
        $query = UserExtention::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'educational_institution', $this->educational_institution])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'work_skill', $this->work_skill])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
