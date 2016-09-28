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
            'booking_at',
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
                'value' => 'statusLabel',
                //'filter'=> Booking::getEntrystat(),
                'format'=>'html',
                'headerOptions' => [
                    'width' => '80px',
                ],
            ],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template'=>'{apprvres}',
//                'buttons'=>[
//                    'apprvres' => function($url,$model,$key){
//                        if($model->entry_status >= 2 ){
//                            if($model->borrowreturn->confirm_status === 1){
//                                if($model->entry_status === 3 && $model->borrowreturn->deliver_status === 1){
//                                    return 'ส่งของแล้ว';
//                                }elseif($model->entry_status === 3 && $model->borrowreturn->deliver_status === 0){
//                                    return 'ไม่รับของ';
//                                }
//                                return 'อนุมัติแล้ว รอส่งของ';
//                            }else{
//                                return 'ไม่อนุมัติ เพราะ '.$model->borrowreturn->confirm_comment;
//                            }
//                        }else{
//                            return 'กำลังพิจารณา';
//                        }
//                    }
//                ]
//            ],
        ],
        'pager' => [
            'firstPageLabel' => Yii::t( 'app', '1stPagi'),
            'lastPageLabel' => Yii::t( 'app', 'lastPagi'),
        ],
        'responsive'=>true,
        'hover'=>true,
        'toolbar'=> false,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=> Html::icon('export').' '.Html::encode('ส่งมอบ-พัสดุ/ครุภัณฑ์'),
        ],
    ]); ?>
</div>
