<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property integer $DISTRICT_ID
 * @property string $DISTRICT_CODE
 * @property string $DISTRICT_NAME
 * @property string $DISTRICT_NAME_ENG
 * @property integer $AMPHUR_ID
 * @property integer $PROVINCE_ID
 * @property integer $GEO_ID
 *
 * @property Address[] $addresses
 * @property Amphures $aMPHUR
 * @property User[] $users
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DISTRICT_CODE', 'DISTRICT_NAME', 'DISTRICT_NAME_ENG'], 'required'],
            [['AMPHUR_ID', 'PROVINCE_ID', 'GEO_ID'], 'integer'],
            [['DISTRICT_CODE'], 'string', 'max' => 6],
            [['DISTRICT_NAME', 'DISTRICT_NAME_ENG'], 'string', 'max' => 150],
            [['AMPHUR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Amphures::className(), 'targetAttribute' => ['AMPHUR_ID' => 'AMPHUR_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DISTRICT_ID' => 'District  ID',
            'DISTRICT_CODE' => 'District  Code',
            'DISTRICT_NAME' => 'District  Name',
            'DISTRICT_NAME_ENG' => 'District  Name  Eng',
            'AMPHUR_ID' => 'Amphur  ID',
            'PROVINCE_ID' => 'Province  ID',
            'GEO_ID' => 'Geo  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['district_id' => 'DISTRICT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAMPHUR()
    {
        return $this->hasOne(Amphures::className(), ['AMPHUR_ID' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['address_id' => 'DISTRICT_ID']);
    }
}
