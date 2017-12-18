<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "belong".
 *
 * @property integer $id
 * @property string $name_beling
 */
class Belong extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'belong';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_belong'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_belong' => 'หน่วยงาน',
        ];
    }
}
