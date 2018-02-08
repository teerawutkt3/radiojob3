<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "address".
 * @property string $data_address 
 * @property integer $id
 * @property integer $district_id
 * @property string $district_code
 * @property string $district_name
 * @property integer $amphur_id
 * @property string $amphur_code
 * @property string $amphur_name
 * @property integer $province_id
 * @property string $province_code
 * @property string $province_name
 * @property integer $geo_id
 * @property string $geo_name
 * @property string $zipcode 
 * @property double $lat
 * @property double $long
 *
 * @property Districts $district
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
   
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_address','geo_id'], 'required'],
            [['data_address'], 'string'],
            [['district_id', 'amphur_id', 'province_id', 'geo_id'], 'integer'],
            [['lat', 'long'], 'number'],
            [['district_code', 'amphur_code', 'province_code', 'zipcode'], 'string', 'max' => 6],
            [['district_name', 'amphur_name', 'province_name'], 'string', 'max' => 30],
            [['geo_name'], 'string', 'max' => 50],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'DISTRICT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_address' => 'ที่อยู่',
            'district_id' => '',
            'district_code' => 'District Code',
            'district_name' => 'ตำบล',
            'amphur_id' => '',
            'amphur_code' => 'Amphur Code',
            'amphur_name' => 'อำเภอ',
            'province_id' => '',
            'province_code' => 'Province Code',
            'province_name' => 'จังหวัด',
            'geo_id' => '',
            'geo_name' => 'ภาค',
            'zipcode' => 'รหัสไปรษณีย์', 
            'lat' => '',
            'long' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['DISTRICT_ID' => 'district_id']);
    }
    public function getAmphur(){
        return $this->hasOne(Amphures::className(),['AMPHUR_ID' => 'AMPHUR_ID'])->via('district');
    }
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['PROVINCE_ID' => 'PROVINCE_ID'])->via('amphur');
    }
    public function getGeography()
    {
        return $this->hasOne(Geography::className(), ['GEO_ID' => 'GEO_ID'])->via('province');
    }
    public function getNameAddress(){
        return $this->data_address." ต.".$this->district_name." อ.".$this->amphur_name." จ.".$this->province_name."  ".$this->zipcode;
    }

    
}
