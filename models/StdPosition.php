<?php

namespace suPnPsu\borrowMaterial\models;

use Yii;

/**
 * This is the model class for table "std_position".
 *
 * @property integer $id
 * @property string $title
 * @property integer $saveby
 *
 * @property Booking[] $bookings
 * @property User $saveby0
 */
class StdPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'std_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
            'title' => 'ตำแหน่งของสังกัด',
            'saveby' => 'โดยผู้ใช้',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['position_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaveby0()
    {
        return $this->hasOne(User::className(), ['id' => 'saveby']);
    }
    
    public static function getList(){
        return \yii\helpers\ArrayHelper::map(self::find()->all(),'id','title');
    }
}
