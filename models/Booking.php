<?php

namespace suPnPsu\borrowMaterial\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property integer $entry_status
 * @property string $booking_at
 * @property string $create_at
 * @property integer $user_id
 * @property integer $belongto_id
 * @property integer $position_id
 * @property string $purpose
 * @property integer $isin_university
 * @property string $university_place
 * @property string $acquire_at
 * @property string $return_at
 *
 * @property User $user
 * @property StdBelongto $belongto
 * @property StdPosition $position
 * @property Bookingmaterial[] $bookingmaterials
 * @property Borrowreturn $borrowreturn
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
	  public $rangedatetime;
	  public $sbmtcheck;
	  public $isinlist = ['0'=>'insideuniv','1'=>'outsideuniv'];
	  public $entstat =  [
            '0' => 'draft',
            '1' => 'submitbooking',
            '2' => 'bookingsubmited',
            '3' => 'itemsent',
            '4' => 'itemreturned',
            '5' => 'finished',
        ];
	  
    public function rules()
    {
        return [
            [['entry_status', 'booking_at', 'user_id', 'belongto_id', 'position_id', 'purpose', 'isin_university', 'university_place', 'acquire_at', 'return_at', 'create_at'], 'required'],
				
				['sbmtcheck', 'required', 'on' => 'create', 'requiredValue' => 1, 'message' => 'you must check'],
				
            [['entry_status', 'user_id', 'belongto_id', 'position_id', 'isin_university'], 'integer'],				
            [['booking_at', 'acquire_at', 'create_at', 'return_at'], 'safe'],
            [['purpose', 'university_place'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['belongto_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdBelongto::className(), 'targetAttribute' => ['belongto_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_status' => 'สถานะรายการ',
            'booking_at' => 'วันที่-ขอยืม',
            'user_id' => 'ผู้ขอ',
            'belongto_id' => 'สังกัดองค์กร',
            'position_id' => 'ตำแหน่ง',
            'purpose' => 'วัตถุประสงค์',
            'isin_university' => 'โดยใช้',
            'university_place' => 'สถานที่ใช้งาน',
            'acquire_at' => 'วันที่-มารับของ',
            'return_at' => 'วันที่-มาคืนของ',
				'rangedatetime' => 'ขอยืมใช้ - จะมาคืน',
				'create_at' => 'สร้างวันที่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBelongto()
    {
        return $this->hasOne(StdBelongto::className(), ['id' => 'belongto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(StdPosition::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getBookingmaterials()
	{
			 return $this->hasMany(Bookingmaterial::className(), ['booking_id' => 'id']);
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowreturn()
    {
        return $this->hasOne(Borrowreturn::className(), ['booking_id' => 'id']);
    }
}
