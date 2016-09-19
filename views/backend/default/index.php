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
