<?php

namespace backend\modules\borrowreturn\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property integer $id
 * @property string $title
 * @property string $detail
 * @property integer $status
 * @property integer $available
 * @property integer $save_by
 *
 * @property Bookingmaterial[] $bookingmaterials
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'detail', 'save_by'], 'required'],
            [['detail'], 'string'],
            [['status', 'available', 'save_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อสิ่งของ',
            'detail' => 'ยี่ห้อ',
            'status' => 'สถานะอุปกรณ์',
            'available' => 'พร้อมยืม',
            'save_by' => 'บันทึกโดย',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingmaterials()
    {
        return $this->hasMany(Bookingmaterial::className(), ['material_id' => 'id']);
    }
}
