<?php use yii\bootstrap\Html;
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
//            [
//                'attribute' => 'entry_status',
//                'headerOptions' => [
//                    'width' => '100px',
//                ],
//            ],
            //'user_id',
            //'belongto_id',
            //'position_id',
            'purpose',
            'return_at',
            [
                'attribute' => 'entry_status',
                //'value' => 'statusLabel',
                //'filter'=> Booking::getEntrystat(),
                'value' => function($model, $key, $index, $column){
                    if($model->entry_status == 4 ){
<<<<<<< HEAD
                        if($model->return_at < date('Y-m-d H:i')){
=======
                        if($model->return_at < Time()){
>>>>>>> origin/master
                            return '<span class="label label-danger">เกินเวลาขอยืม</span>';
                        }else{
                            return '<span class="label label-warning">ยังไม่คืน</span>';
                        }
<<<<<<< HEAD
=======
                        }elseif($model->entry_status == 6){
                        return '<span class="label label-success">คืนแล้ว</span>';
>>>>>>> origin/master
                    }
                },
                'format'=>'html',
                'headerOptions' => [
                    'width' => '80px',
                ],
            ],
<<<<<<< HEAD
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{viewbooking}',
                'buttons' => [
                    'viewbooking' => function ($url, $model, $key) {
                        //return Html::a('<i class="glyphicon glyphicon-ok-circle"></i>',$url);
                        return Html::a(Html::icon('eye-open'), $url);
                    },
                ],
                'headerOptions' => [
                    'width' => '50px',
                ],
            ],
        ],
        'pager' => [
            'firstPageLabel' => Yii::t( 'app', 'หน้าแรกสุด'),
            'lastPageLabel' => Yii::t( 'app', 'หน้าท้ายสุด'),
=======
        ],
        'pager' => [
            'firstPageLabel' => Yii::t( 'app', '1stPagi'),
            'lastPageLabel' => Yii::t( 'app', 'lastPagi'),
>>>>>>> origin/master
        ],
        'responsive'=>true,
        'hover'=>true,
        'toolbar'=> false,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
<<<<<<< HEAD
            'heading'=> Html::icon('import').' '.Html::encode('รายการที่ไม่ส่ง'),
=======
            'heading'=> Html::icon('cloud-upload').' '.Html::encode('รายการที่ไม่ส่ง'),
>>>>>>> origin/master
        ],
    ]); ?>
</div>
