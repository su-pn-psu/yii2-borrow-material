<?php

namespace suPnPsu\borrowMaterial\models;

use Yii;

/**
 * This is the model class for table "bookingmaterial".
 *
 * @property integer $id
 * @property integer $booking_id
 * @property string $material_id
 * @property string $return_condition
 *
 * @property Material $material
 * @property Booking $booking
 */
class Bookingmaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookingmaterial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['booking_id', 'material_id'], 'required'],
            [['booking_id'], 'integer'],
            [['return_condition', 'material_id'], 'string'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['material_id' => 'id']],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_id' => 'bookingID',
            'material_id' => 'materialID',
            'return_condition' => 'สภาพตอนคืน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }
}
