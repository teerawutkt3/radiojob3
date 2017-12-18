<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Work;
use common\components\MyDate;

/**
 * WorkSearch represents the model behind the search form about `common\models\Work`.
 */
class WorkSearchBenefits extends Work
{
    /**
     * @inheritdoc
     */
    public $geo_id,$province_id,$amphur_id,$district_id,$address_search;
    public function rules()
    {
        return [
            [['id', 'number', 'money1', 'money2', 'work_user_id', 'work_created_at', 'work_status', 'work_address_id'], 'integer'],
            [['name_office', 'description','money1', 'belong', 'education', 'benefits','work_created_at','address_search', 'work_status','geo_id','province_id','amphur_id','district_id' ], 'safe'],
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
        $query = Work::find()->where(['work_status'=>Work::STATUS_ACTIVE])->orderBy(['count_benefits' => SORT_DESC]);
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
           // 'work_address_id' => $this->work_address_id,
           // 'workAddress.province_name' =>$this->address_search,
        ]);

        $query->andFilterWhere(['like', 'name_office', $this->name_office])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['<=','money1',$this->money1])
         //   ->andFilterWhere(['<=','money2',$this->money2])
            ->andFilterWhere(['like', 'belong', $this->belong])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like','address.geo_id',$this->geo_id])
            ->andFilterWhere(['like','address.province_id',$this->province_id])
            ->andFilterWhere(['like','address.amphur_id',$this->amphur_id])
            ->andFilterWhere(['like','address.district_id',$this->district_id])
            ->andFilterWhere(['like', 'benefits', $this->benefits]);
          
       //    ->andFilterWhere(['==','workAddress',(int)$this->geo_id]);
           // ->andFilterWhere(['like', 'tel', $this->tel]);
            if (!empty($this->created_at) ){
                $query->andFilterWhere(['<= ','work_created_at',MyDate::TimeDigit2int($this->work_created_at)]);
            }
            
            if (!empty($params['worksearch-work_created_at_convert'])){
                $query->andFilterWhere(['<= ','work_created_at',MyDate::TimeDigit2int($params['worksearch-work_created_at_convert'])]);
            }


        return $dataProvider;
    }
}
