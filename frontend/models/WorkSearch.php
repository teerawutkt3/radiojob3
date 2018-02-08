<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Work;
use common\components\MyDate;

/**
 * WorkSearch represents the model behind the search form about `common\models\Work`.
 */
class WorkSearch extends Work
{
    
    /**
     * @inheritdoc
     */
    
    public function rules()
    {
        return [
            [['id', 'number', 'money1', 'money2', 'work_user_id', 'work_created_at', 'work_status', 'work_address_id'], 'integer'],
            [['name_office', 'description','money1', 'belong', 'education', 'benefits',
                'work_created_at', 'work_status','province_name','geo_id','province_id','amphur_id','district_id','nameSearch' ], 'safe'],
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
        $query = Work::find()->where(['work_user_id'=> \Yii::$app->user->id])->orderBy(['work_created_at'=> SORT_DESC]);
        $query->joinWith(['address','user']);
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
          //  'number' => $this->number,
         //   'money1' => $this->money1,
          //  'money2' => $this->money2,
        //    'time_begin' => $this->time_begin,
        //    'time_end' => $this->time_end,
        //    'work_user_id' => $this->work_user_id,
         //   'work_created_at' => $this->work_created_at,
           'work_status' => $this->work_status,
            'work_address_id' => $this->work_address_id,
           // 'workAddress.province_name' =>$this->address_search,
        ]);

        $query->andFilterWhere(['like', 'name_office', $this->name_office])
        ->andFilterWhere(['like','user.fname',$this->nameSearch])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['<=','money1',$this->money1])
            ->andFilterWhere(['<=','money2',$this->money2])
           ->andFilterWhere(['like','address.province_name',$this->province_name])
            ->andFilterWhere(['like', 'belong', $this->belong])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like','address.province_name',$this->province_name])
            ->andFilterWhere(['like', 'benefits', $this->benefits]);
       //    ->andFilterWhere(['==','workAddress',(int)$this->geo_id]);
           // ->andFilterWhere(['like', 'tel', $this->tel]);
            if (!empty($this->created_at) ){
              //  var_dump($this->work_created_at); die();
                $query->andFilterWhere(['<= ','work_created_at',MyDate::TimeDigit2int($this->work_created_at)])->orderBy(['work_created_at'=>SORT_DESC]);
            }
            
            if (!empty($params['worksearch-work_created_at_convert'])){
              //  var_dump($params['worksearch-work_created_at_convert']); die();
                $query->andFilterWhere(['<= ','work_created_at',MyDate::TimeDigit2int($params['worksearch-work_created_at_convert'])])->orderBy(['work_created_at'=>SORT_DESC]);
            }


        return $dataProvider;
    }
}
