<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provinces".
 *
 * @property integer $PROVINCE_ID
 * @property string $PROVINCE_CODE
 * @property string $PROVINCE_NAME
 * @property string $PROVINCE_NAME_ENG
 * @property integer $GEO_ID
 *
 * @property Geography $gEO
 */
class Provinces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provinces';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROVINCE_CODE', 'PROVINCE_NAME', 'PROVINCE_NAME_ENG'], 'required'],
            [['GEO_ID'], 'integer'],
            [['PROVINCE_CODE'], 'string', 'max' => 2],
            [['PROVINCE_NAME', 'PROVINCE_NAME_ENG'], 'string', 'max' => 150],
            [['GEO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Geography::className(), 'targetAttribute' => ['GEO_ID' => 'GEO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROVINCE_ID' => 'Province  ID',
            'PROVINCE_CODE' => 'Province  Code',
            'PROVINCE_NAME' => 'Province  Name',
            'PROVINCE_NAME_ENG' => 'Province  Name  Eng',
            'GEO_ID' => 'Geo  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGEO()
    {
        return $this->hasOne(Geography::className(), ['GEO_ID' => 'GEO_ID']);
    }
}
