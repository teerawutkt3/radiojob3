<?php


namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Messages;

/**
 * MessageSearch represents the model behind the search form about `common\models\Messages`.
 */
class MessageSenderSearch extends Messages
{
    /**
     * @inheritdoc
     */
    public $nameSearch;
    public function rules()
    {
        return [
            [['id', 'to_user_id', 'created_by_user_id', 'message_created_at', 'message_updated_at'], 'integer'],
            [['description','nameSearch'], 'safe'],
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
        $query = Messages::find()->where(['created_by_user_id'=>\Yii::$app->user->id])->orderBy(['message_updated_at'=>SORT_DESC]);
        $query->joinWith('user');
        
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
            'to_user_id' => $this->to_user_id,
            'created_by_user_id' => $this->created_by_user_id,
            'message_created_at' => $this->message_created_at,
            'message_updated_at' => $this->message_updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'description', $this->description])
                    ->andFilterWhere(['like','user.fname',$this->nameSearch]);
        
        return $dataProvider;
    }
}