<?php

namespace suPnPsu\borrowMaterial\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "std_belongto".
 *
 * @property integer $id
 * @property string $title
 * @property integer $saveby
 *
 * @property Booking[] $bookings
 * @property User $saveby0
 */
class StdBelongto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'std_belongto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'saveby'], 'required'],
            [['saveby'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['saveby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['saveby' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อสังกัด',
            'saveby' => 'โดยผู้ใช้',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['belongto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaveby0()
    {
        return $this->hasOne(User::className(), ['id' => 'saveby']);
    }

    public function getDropdown(){
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}
