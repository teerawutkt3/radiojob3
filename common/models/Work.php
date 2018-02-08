<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $name_office
 * @property string $description
 * @property string $belong
 * @property integer $number
 * @property string $education
 * @property string $benefits
 *  @property integer $count_benefits 
 * @property integer $money1
 * @property integer $money2
 * @property integer $time_begin
 * @property integer $time_end
 * @property string $tel
 * @property integer $work_user_id
 * @property integer $work_created_at
 * @property integer $work_status
 * @property integer $work_address_id
 *
 * @property Address $workAddress
 * @property User $workUser
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    const     STATUS_DELETED = 0;
    const     STATUS_ACTIVE = 1;
    public $province_name;
    
    public $geo_id,$province_id,$amphur_id,$district_id ,$nameSearch;

    public static function tableName()
    {
        return 'work';
    }
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['work_created_at'],
                    //ActiveRecord::EVENT_BEFORE_UPDATE => ['work_created_at'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          
//             [['name_office','time_begin','time_end', 'description'], 'required'],
            [['name_office', 'description','time_begin','time_end'], 'required'],
            [['description', 'benefits'], 'string'],
            [['number', 'money1', 'money2', 'work_user_id', 'work_created_at', 'work_status', 'work_address_id'], 'integer'],
            [['name_office'], 'string', 'max' => 30],
            [['belong'], 'string', 'max' => 20],
            [['education', 'tel'], 'string', 'max' => 50],
            [['work_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['work_address_id' => 'id']],
            [['work_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['work_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_office' => 'ชื่อสถานที่ทำงาน',
            'description' => 'รายละเอียดงาน',
            'belong' => 'หน่วยงาน',
            'number' => 'จำนวนรับสมัคร',
            'education' => 'วุฒิการศึกษา',
            'benefits' => 'สวัสดิการ',
            'money1' => 'รายได้',
            'money2' => 'ถึง',
            'time_begin' => 'เวลาเริ่มงาน',
            'time_end' => 'เวลาเลิกงาน',
            'tel' => 'เบอร์ติดต่อ',
            'work_user_id' => 'ไอดีผู้ใช้งาน',
            'work_created_at' => 'ประกาศ',
            'work_status' => 'สถานะ',
            'work_address_id' => 'ไอดีที่อยู่',
            'geo_id'=>'',
            'province_id' => '',
            'amphur_id'=>'',
            'district_id'=>'',
         
          
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'work_address_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
       return $this->hasOne(User::className(), ['id' => 'work_user_id']);
    }
}
