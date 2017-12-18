<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_extention".
 *
 * @property integer $id
 * @property string $educational_institution
 * @property string $education
 * @property string $branch
 * @property string $experience
 * @property string $work_skill
 * @property string $language
 * @property integer $user_id
 *
 * @property User $user
 */
class UserExtention extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_extention';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['experience', 'work_skill', 'language'], 'string'],
            [['user_id'], 'integer'],
            [['educational_institution', 'education', 'branch'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'educational_institution' => 'สถานศึกษา',
            'education' => 'วุฒิการศึกาษา',
            'branch' => 'สาขาวิชา',
            'experience' => 'ประสบการณ์',
            'work_skill' => 'ทักษะด้านการทำงาน',
            'language' => 'ทักษะภาษา',
            'user_id' => 'ไอดีผู้ใช้',
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
