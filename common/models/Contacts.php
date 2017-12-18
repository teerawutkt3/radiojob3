<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $subject
 * @property string $description
 * @property integer $user_id
 * @property integer $contact_created_at
 *
 * @property User $user
 */
class Contacts extends \yii\db\ActiveRecord
{
    
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['contact_created_at'],
                    //ActiveRecord::EVENT_BEFORE_UPDATE => ['work_created_at'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'user_id', 'contact_created_at'], 'integer'],
            [['description'], 'required'],
            [['description','subject'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ไอดี',
            'subject' => '',
            'description' => '',
            'user_id' => 'ไอดีผู้ใช้',
            'contact_created_at' => 'ติดต่อเมื่อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
