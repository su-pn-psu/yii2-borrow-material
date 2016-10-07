<<<<<<< HEAD
<?php
use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
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
//            [
//                'attribute' => 'id',
//                'headerOptions' => [
//                    'width' => '50px',
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
                //'value' => 'statusLabel',
                //'filter'=> Booking::getEntrystat(),
                'value' => function($model, $key, $index, $column){
                    if($model->entry_status == 1 ){
                        return '<span class="label label-warning">กำลังพิจารณา</span>';
                    }elseif($model->entry_status == 2){
                        return '<span class="label label-success">ผ่านการอนุมัต</span>ิ';
                    }elseif($model->entry_status == 3 && $model->borrowreturn->deliver_at == NULL){
                        return '<a title="รับทราบเหตุผล" data-toggle="tooltip" class="_disapproved btn btn-danger" href="' . Url::to(['disapproved', 'id'=>$key]) . '">ไม่อนุมัติ-ทราบเหตุผล</a>';
                    }
                },
                'filter'=> ['1' => 'กำลังพิจารณา', '2' => 'ผ่านการอนุมัติ', '3' => 'ไม่อนุมัติ'],
                'format'=>'html',
//                'headerOptions' => [
//                    'width' => '80px',
//                ],
            ],
        ],
        'pager' => [
            'firstPageLabel' => Yii::t( 'app', 'กน้าแรกสุด'),
            'lastPageLabel' => Yii::t( 'app', 'หน้าท้ายสุด'),
        ],
        'pjax'=>true,
        'responsive'=>true,
        'hover'=>true,
        'toolbar'=> false,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=> Html::icon('inbox').' '.Html::encode('ขั้นตอนพิจารณา-พัสดุ/ครุภัณฑ์'),
        ],
    ]); ?>
</div>
<?php
Modal::begin([
    'header' => 'รับทราบเหตุผล การไม่อนุมัติ',
    'id' => 'modal',
]);
echo '<div id ="modalcontent"></div>';
Modal::end();
?>
<?php
$js['ajax-select-material'] = "

	$('._disapproved').on('click', function(event){
		event.preventDefault();
		$('#modal').modal('show')
		.find('#modalcontent')
		.load($(this).attr('href'));
			return false;//just to see what data is coming to js
    });
";
?>

<?php
$this->registerJs(implode("\n", $js));
?>
=======
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
                //'value' => 'statusLabel',
                //'filter'=> Booking::getEntrystat(),
                'value' => function($model, $key, $index, $column){
                    if($model->entry_status == 1 ){
                        return '<span class="label label-warning">กำลังพิจารณา</span>';
                    }elseif($model->entry_status == 2){
                        return '<span class="label label-success">ผ่านการอนุมัต</span>ิ';
                    }elseif($model->entry_status == 3){
                        return 'ไม่อนุมัติ เพราะ '.$model->borrowreturn->confirm_comment;
                    }
                },
                'filter'=> ['1' => 'กำลังพิจารณา', '2' => 'ผ่านการอนุมัติ', '3' => 'ไม่อนุมัติ'],
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
            'heading'=> Html::icon('inbox').' '.Html::encode('ขั้นตอนพิจารณา-พัสดุ/ครุภัณฑ์'),
        ],
    ]); ?>
</div>
>>>>>>> origin/master
