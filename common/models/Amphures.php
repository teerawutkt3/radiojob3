<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "amphures".
 *
 * @property integer $AMPHUR_ID
 * @property string $AMPHUR_CODE
 * @property string $AMPHUR_NAME
 * @property string $AMPHUR_NAME_ENG
 * @property integer $GEO_ID
 * @property integer $PROVINCE_ID
 *
 * @property Districts[] $districts
 */
class Amphures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amphures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AMPHUR_CODE', 'AMPHUR_NAME', 'AMPHUR_NAME_ENG', 'GEO_ID', 'PROVINCE_ID'], 'required'],
            [['GEO_ID', 'PROVINCE_ID'], 'integer'],
            [['AMPHUR_CODE'], 'string', 'max' => 4],
            [['AMPHUR_NAME', 'AMPHUR_NAME_ENG'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AMPHUR_ID' => 'Amphur  ID',
            'AMPHUR_CODE' => 'Amphur  Code',
            'AMPHUR_NAME' => 'Amphur  Name',
            'AMPHUR_NAME_ENG' => 'Amphur  Name  Eng',
            'GEO_ID' => 'Geo  ID',
            'PROVINCE_ID' => 'Province  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(Districts::className(), ['AMPHUR_ID' => 'AMPHUR_ID']);
    }
}
