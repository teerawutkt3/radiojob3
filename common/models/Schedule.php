<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sun_time_begin
 * @property integer $sun_time_end
 * @property integer $mon_time_begin
 * @property integer $mon_time_end
 * @property integer $tues_time_begin
 * @property integer $tues_time_end
 * @property integer $wed_time_begin
 * @property integer $wed_time_end
 * @property integer $thurs_time_begin
 * @property integer $thurs_time_end
 * @property integer $fri_time_begin
 * @property integer $fri_time_end
 * @property integer $sat_time_begin
 * @property integer $sat_time_end
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sun_time_begin', 'sun_time_end', 'mon_time_begin', 'mon_time_end', 'tues_time_begin', 'tues_time_end', 'wed_time_begin', 'wed_time_end', 'thurs_time_begin', 'thurs_time_end', 'fri_time_begin', 'fri_time_end', 'sat_time_begin', 'sat_time_end'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ไอดีผู้ใช้',
            'sun_time_begin' => '',
            'sun_time_end' => '',
            'mon_time_begin' => '',
            'mon_time_end' => '',
            'tues_time_begin' => '',
            'tues_time_end' => '',
            'wed_time_begin' => '',
            'wed_time_end' => '',
            'thurs_time_begin' => '',
            'thurs_time_end' => '',
            'fri_time_begin' => '',
            'fri_time_end' => '',
            'sat_time_begin' => '',
            'sat_time_end' => '',
        ];
    }
}
