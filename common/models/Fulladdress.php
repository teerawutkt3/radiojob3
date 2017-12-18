<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fulladdress".
 *
 * @property integer $id
 * @property integer $add_lv
 * @property string $DISTRICT_CODE
 * @property string $DISTRICT_NAME
 * @property string $DISTRICT_EN
 * @property string $AMPHUR_CODE
 * @property string $AMPHUR_NAME
 * @property string $AMPHUR_EN
 * @property string $PROVINCE_CODE
 * @property string $PROVINCE_NAME
 * @property string $PROVINCE_EN
 * @property double $LAT
 * @property double $LONG
 */
class Fulladdress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fulladdress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_lv'], 'integer'],
            [['LAT', 'LONG'], 'number'],
            [['DISTRICT_CODE'], 'string', 'max' => 6],
            [['DISTRICT_NAME', 'DISTRICT_EN', 'AMPHUR_NAME', 'AMPHUR_EN', 'PROVINCE_NAME', 'PROVINCE_EN'], 'string', 'max' => 150],
            [['AMPHUR_CODE'], 'string', 'max' => 4],
            [['PROVINCE_CODE'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'add_lv' => 'Add Lv',
            'DISTRICT_CODE' => 'District  Code',
            'DISTRICT_NAME' => 'District  Name',
            'DISTRICT_EN' => 'District  En',
            'AMPHUR_CODE' => 'Amphur  Code',
            'AMPHUR_NAME' => 'Amphur  Name',
            'AMPHUR_EN' => 'Amphur  En',
            'PROVINCE_CODE' => 'Province  Code',
            'PROVINCE_NAME' => 'Province  Name',
            'PROVINCE_EN' => 'Province  En',
            'LAT' => 'Lat',
            'LONG' => 'Long',
        ];
    }
}
