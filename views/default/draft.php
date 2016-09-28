<?php
use yii\bootstrap\Html;
use suPnPsu\borrowMaterial\models\Booking;

use kartik\grid\GridView;

//print_r($searchModel);
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
                'filter'=> Booking::getEntrystat(),
                'format'=>'html',
                'headerOptions' => [
                    'width' => '80px',
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{viewbooking} {update} {delete}',
                'buttons' => [
                    'viewbooking' => function ($url, $model, $key) {
                        //return Html::a('<i class="glyphicon glyphicon-ok-circle"></i>',$url);
                        return Html::a(Html::icon('eye-open'), $url);
                    },
                    'update' => function ($url, $model, $key) {
                        //return Html::a('<i class="glyphicon glyphicon-ok-circle"></i>',$url);
                        return Html::a(Html::icon('pencil'), $url);
                    },
                    'delete' => function ($url, $model, $key) {
                        //return Html::a('<i class="glyphicon glyphicon-ok-circle"></i>',$url);
                        return Html::a(Html::icon('trash'), $url);
                    },
                ],
                'headerOptions' => [
                    'width' => '70px',
                ],
            ],
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
            'heading'=> Html::icon('cloud-upload').' '.Html::encode('รายการที่ไม่ส่ง'),
        ],
    ]); ?>
</div>
