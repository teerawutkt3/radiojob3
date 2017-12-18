<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property string $description
 * @property integer $to_user_id
 * @property integer $created_by_user_id
 * @property integer $message_created_at
 * @property integer $message_updated_at
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', ], 'required'],
            [['description'], 'string'],
            [['to_user_id', 'created_by_user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => '',
            'to_user_id' => '',
            'created_by_user_id' => '',
            'message_created_at' => '',
            'message_updated_at' => '',
            'nameSearch'=>'',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserto()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by_user_id']);
    }
}
