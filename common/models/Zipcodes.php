<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zipcodes".
 *
 * @property integer $id
 * @property string $district_code
 * @property string $zipcode
 */
class Zipcodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zipcodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_code', 'zipcode'], 'required'],
            [['district_code'], 'string', 'max' => 6],
            [['zipcode'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_code' => 'District Code',
            'zipcode' => 'Zipcode',
        ];
    }
}
