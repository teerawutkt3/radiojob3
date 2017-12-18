<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "geography".
 *
 * @property integer $GEO_ID
 * @property string $GEO_NAME
 *
 * @property Provinces[] $provinces
 */
class Geography extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geography';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GEO_NAME'], 'required'],
            [['GEO_NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GEO_ID' => 'Geo  ID',
            'GEO_NAME' => 'Geo  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinces()
    {
        return $this->hasMany(Provinces::className(), ['GEO_ID' => 'GEO_ID']);
    }
}
