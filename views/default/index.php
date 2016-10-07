<<<<<<< HEAD
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
=======
<?php use yii\bootstrap\Html;
//use kartik\widgets\DatePicker;

use kartik\grid\GridView;
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
            [
                'attribute' => 'entry_status',
                'headerOptions' => [
                    'width' => '100px',
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
            // 'return_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{apprvres}',
                'buttons'=>[
                    'apprvres' => function($url,$model,$key){
                        if($model->entry_status >= 2 ){
                            if($model->borrowreturn->confirm_status === 1){
                                if($model->entry_status === 3 && $model->borrowreturn->deliver_status === 1){
                                    return 'ส่งของแล้ว';
                                }elseif($model->entry_status === 3 && $model->borrowreturn->deliver_status === 0){
                                    return 'ไม่รับของ';
                                }
                                return 'อนุมัติแล้ว รอส่งของ';
                            }else{
                                return 'ไม่อนุมัติ เพราะ '.$model->borrowreturn->confirm_comment;
                            }
                        }else{
                            return 'กำลังพิจารณา';
                        }
                    }
                ]
            ],
        ],
        'pager' => [
            'firstPageLabel' => Yii::t( 'app', '1stPagi'),
            'lastPageLabel' => Yii::t( 'app', 'lastPagi'),
        ],
        'responsive'=>true,
        'hover'=>true,
        'toolbar'=> [
            ['content'=>
                //Html::a(Html::icon('plus'), ['create'], ['class'=>'btn btn-success', 'title'=>Yii::t('app', 'Add Book')]).' '.
                Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
            ],
            //'{export}',
            '{toggleData}',
        ],
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=> Html::icon('user').' '.Html::encode('ขั้นตอนพิจารณา-พัสดุ/ครุภัณฑ์'),
        ],
    ]); ?>
    <p>
        รายการห้อง
    </p>
    <p>
        รายการรถจักรยานยนต์สามล้อ
    </p>
</div>


<?php 
/*
$md = $this->render("../../README.md");
echo yii\helpers\Markdown::process($md);
*/
?>
>>>>>>> origin/master
