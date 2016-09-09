<?php

namespace backend\modules\borrowreturn\models;

use Yii;

/**
 * This is the model class for table "borrowreturn".
 *
 * @property integer $booking_id
 * @property integer $confirm_status
 * @property string $confirm_comment
 * @property integer $confirm_staff_id
 * @property string $confirm_at
 * @property integer $deliver_status
 * @property integer $deliver_staff_id
 * @property string $deliver_at
 * @property integer $return_status
 * @property string $return_loss
 * @property string $return_because
 * @property integer $return_staff_id
 * @property string $return_at
 * @property string $entry_note
 *
 * @property Booking $booking
 * @property User $confirmStaff
 * @property User $deliverStaff
 * @property User $returnStaff
 */
class Borrowreturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'borrowreturn';
    }

    /**
     * @inheritdoc
     */
	  
	  public $approvelist = ['0'=>'ไม่อนุมัติ','1'=>'อนุมัติ'];
	  public $deleverlist = ['0'=>'ไม่ส่ง','1'=>'ส่ง'];
	  public $returnlist = ['0'=>'ครบ','1'=>'ไม่ครบ'];
	  
    public function rules()
    {
        return [
            [['booking_id', 'confirm_status', 'confirm_staff_id', 'confirm_at', 'deliver_staff_id', 'deliver_at', 'return_staff_id', 'return_at'], 'required'],
				[['booking_id', 'confirm_status', 'confirm_staff_id', 'deliver_status', 'deliver_staff_id', 'return_status', 'return_staff_id'], 'integer'],
            [['confirm_at', 'deliver_at', 'return_at'], 'safe'],
            [['entry_note'], 'string'],
            [['confirm_comment', 'return_loss', 'return_because'], 'string', 'max' => 255],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'id']],
            [['confirm_staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['confirm_staff_id' => 'id']],
            [['deliver_staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['deliver_staff_id' => 'id']],
            [['return_staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['return_staff_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'booking_id' => 'bookingID',
            'confirm_status' => 'การอนุมัติ',
            'confirm_comment' => 'ไม่อนุมัติ เนื่องจาก',
            'confirm_staff_id' => 'เจ้าหน้าที่-อนุมัติ',
            'confirm_at' => 'วันที่-อนุมัติ',
            'deliver_status' => 'ยืนยันการส่งของ',
            'deliver_staff_id' => 'เจ้าหน้าที่-ส่งของ',
            'deliver_at' => 'วันที่-ส่งของ',
            'return_status' => 'ยืนยันการคืน',
            'return_loss' => 'สิ่งที่ไม่คืน',
            'return_because' => 'ไม่ได้คืนเนื่องจาก',
            'return_staff_id' => 'เจ้าหน้าที่-รับคืน',
            'return_at' => 'วันที่-รับคืน',
            'entry_note' => 'หมายเหตุ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmStaff()
    {
        return $this->hasOne(User::className(), ['id' => 'confirm_staff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliverStaff()
    {
        return $this->hasOne(User::className(), ['id' => 'deliver_staff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReturnStaff()
    {
        return $this->hasOne(User::className(), ['id' => 'return_staff_id']);
    }
}
