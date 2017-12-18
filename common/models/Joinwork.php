<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "joinwork".
 *
 * @property integer $id
 * @property string $comment
 * @property integer $point
 * @property integer $work_id
 * @property integer $user_id
 * @property integer $join_status
 * @property integer $created_work 
 * @property integer $join_created_at
 * @property integer $join_updated_at
 *
 * @property User $user
 * @property Work $work
 */
class Joinwork extends \yii\db\ActiveRecord
{
    const STATUS_WAIT = 0;
    const  STATUS_ACTION = 1;
    const  STATUS_SUCCESS = 2;
    public $name_work;
    public $name_user;
    public $nameSearch,$lastSearch;
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['join_created_at','join_updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['join_updated_at'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'joinwork';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['point', 'work_id', 'user_id', 'join_status','created_work', 'join_created_at', 'join_updated_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['work_id'], 'exist', 'skipOnError' => true, 'targetClass' => Work::className(), 'targetAttribute' => ['work_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'แสดงความคิดเห็น',
            'point' => 'คะแนนร่วมงาน',
            'created_work' => 'ผู้ประกาศ', 
            'work_id' => 'ไอดีงาน',
            'user_id' => 'ไอผู้ใช้',
            'join_status' => 'สถานะ',
            'join_created_at' => 'ร่วมงานเมื่อ',
            'join_updated_at' => 'อัปเดตเมื่อ',
            'nameSearch' => '',
            'lastSearch' => '',
           'name_work' => '',
            'nameSearch' => 'ชื่อ - นามสกุล',
            'name_user' => 'ชื่อ - นามสกุล'
 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Work::className(), ['id' => 'work_id']);
    }
}
