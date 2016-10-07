<?php
use yii\bootstrap\Html;
//use kartik\widgets\DatePicker;

use kartik\grid\GridView;
use suPnPsu\borrowMaterial\models\Booking;
?>
<div class="borrowreturn-default-index">
    <?php echo GridView::widget([
        //'id' => 'kv-grid-demo',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'width' => '50px',
                ],
            ],
            //'booking_at',
            //'user_id',
            //'belongto_id',
            //'position_id',
            'purpose',
            //'isin_university',
            //'university_place',
            'acquire_at',
            'return_at',
            [
                'attribute' => 'entry_status',
                //'value' => 'statusLabel',
                //'filter'=> Booking::getEntrystat(),
                'value' => function($model, $key, $index, $column){
                    if($model->entry_status == 2 ){
                        return '<span class="label label-warning">รอส่งมอบของ</span>';
                    }elseif($model->entry_status == 4 ){
                        if($model->return_at < date('Y-m-d H:i')){
                            return '<span class="label label-danger">เกินเวลาขอยืม</span>';
                        }else{
                            return '<span class="label label-warning">ยังไม่คืน</span>';
                        }
                    }
                },
                'filter'=> ['2' => 'ผ่านการอนุมัติ', '4' => 'ยังไม่คืน'],

                'format'=>'html',
                'headerOptions' => [
                    'width' => '80px',
                ],
            ],
        ],
        'pager' => [
            'firstPageLabel' => Yii::t( 'app', 'หน้าแรกสุด'),
            'lastPageLabel' => Yii::t( 'app', 'หน้าท้ายสุด'),
        ],
        'responsive'=>true,
        'hover'=>true,
        'toolbar'=> false,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=> Html::icon('export').' '.Html::encode('รายการอนุมัติแล้ว-ยังไม่คืน์'),
        ],
    ]); ?>
</div>
