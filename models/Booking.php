<?php

namespace suPnPsu\borrowMaterial\models;

use Yii;
use suPnPsu\user\models\User;
use yii\helpers\ArrayHelper;

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
        public $promisetext = 'ข้าพเจ้าขอรับผิดชอบต่อพัสดุ-ครุภัณฑ์ ที่ขอยืมใช้ หากเกิดชำรุด เสียหายแม้ว่าด้วยกรณีใด ข้าพเจ้ายินดีชดใช้ค่าเสียหายที่เกิดขึ้น ตามระเบียบทุกประการอีกทั้งให้บัตรนักศึกษาเพื่อเป็นหลักฐานยืนยันทุกครั้งที่มายืมใช้อุปกรณ์ และชำระค่าซ่อมบำรุง พัสดุ-ครุภัณฑ์ ตามระเบียบขอฝ่ายพัสดุ องค์การบริหาร องค์การนักศึกษา ปี 2559';


<<<<<<< HEAD
//    public function init()
//    {
//        parent::init();
//
//        foreach($this->entstat as $key => $value){
//            $this->entstat[$key] = Yii::t('borrow-material', $value);
//        }
//
//        foreach($this->isinlist as $key => $value){
//            $this->entstat[$key] = Yii::t('borrow-material', $value);
//        }
//    }

=======
        foreach($this->entstat as $key => $value){
            $this->entstat[$key] = Yii::t('borrow-material', $value);
        }

        foreach($this->isinlist as $key => $value){
            $this->entstat[$key] = Yii::t('borrow-material', $value);
        }
    }
	  
>>>>>>> origin/master
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
            //[['booking_at','acquire_at'], /*'date', 'format' => 'php:Y m d H:i'*/],
            [['booking_at', 'acquire_at', 'rangedatetime'],'validateDates'],
//            ['fromDate', 'date', 'timestampAttribute' => 'fromDate'],
//            ['toDate', 'date', 'timestampAttribute' => 'toDate'],
//            ['fromDate', 'compare', 'compareAttribute' => 'toDate', 'operator' => '<', 'enableClientValidation' => false],
        ];
    }
    public function validateDates(){
        //if(strtotime($this->acquire_at) <= strtotime($this->booking_at->modify('+3 day'))){
<<<<<<< HEAD
        if(strtotime($this->acquire_at) < strtotime($this->booking_at)){
=======
        if(strtotime($this->acquire_at) <= strtotime($this->booking_at)){
>>>>>>> origin/master
            //$this->addError('booking_at','Please give correct Start and End dates');
            $this->addError('acquire_at','Please give correct Start and End dates');
        }
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

    public $isinlist = ['0'=>'ภายในมหาวิทยาลัย','1'=>'ภายนอกมหาวิทยาลัย'];
    public $entstat =  [
        '0' => 'บันทึกร่าง',
        '1' => 'รออนุมัติ',
        '2' => 'อนุมัติแล้ว',
        '3' => 'รับของแล้ว',
        '4' => 'คืนของแล้ว',
        '5' => 'เสร็จสิ้นการยืมคืน',
    ];
    public static function itemsAlias($key) {
        $items = [
            'isin_university' => [
                0 => Yii::t('app', 'ภายในมหาวิทยาลัย'),
                1 => Yii::t('app', 'ภายนอกมหาวิทยาลัย'),
            ],
            'entry_status' => [
                0 => Yii::t('app', 'บันทึกร่าง'),
                1 => Yii::t('app', 'รออนุมัติ'),
                2 => Yii::t('app', 'อนุมัติแล้ว'),
                3 => Yii::t('app', 'ไม่อนุมัติ'),
                4 => Yii::t('app', 'ส่งมอบแล้ว'),
                5 => Yii::t('app', 'ไม่รับของ'),
                6 => Yii::t('app', 'รับคืนแล้ว'),
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel(){
        $status = ArrayHelper::getValue($this->getEntrystat(), $this->entry_status);
        $status = ($this->entry_status === NULL) ? ArrayHelper::getValue($this->getEntrystat(), 0) : $status;
        switch ($this->entry_status) {
            case 0 :
            case NULL :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;
            case 1 :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;
            case 2 :
                $str = '<span class="label label-info">' . $status . '</span>';
                break;
            case 3 :
                $str = '<span class="label label-danger">' . $status . '</span>';
                break;
            case 4 :
                $str = '<span class="label label-info">' . $status . '</span>';
                break;
            case 5 :
                $str = '<span class="label label-danger">' . $status . '</span>';
                break;
            case 6 :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;
            default :
                $str = $status;
                break;
        }

        return $str;
    }

    public function getIsinuniLabel(){
        $avail = ArrayHelper::getValue($this->getEntryisinUni(), $this->isin_university);
        $avail = ($this->isin_university === NULL) ? ArrayHelper::getValue($this->getEntryisinUni(), 0) : $avail;
        switch ($this->isin_university) {
            case 0 :
            case NULL :
                $str = '<span class="label label-danger">' . $avail . '</span>';
                break;
            case 1 :
                $str = '<span class="label label-primary">' . $avail . '</span>';
                break;
            default :
                $str = $avail;
                break;
        }

        return $str;
    }

    public static function getEntrystat() {
        return self::itemsAlias('entry_status');
    }

    public static function getEntryisinUni() {
        return self::itemsAlias('isin_university');
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
