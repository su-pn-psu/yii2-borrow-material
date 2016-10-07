<<<<<<< HEAD
<?php

use yii\bootstrap\Html;
//use kartik\widgets\DatePicker;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel suPnPsu\borrowMaterial\models\BorrowreturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowreturn-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
		//'id' => 'kv-grid-demo',
			'dataProvider'=> $dataProvider,
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
					'class' => 'yii\grid\ActionColumn',
//					'headerOptions' => [
//						'width' => '200px',
//					],
					'template'=>'{submitreturn}',
					'buttons'=>[
						'submitreturn' => function($url,$model,$key){
						return Html::a(Html::icon('fast-backward').' '.'รับคืน',$url,['class' => 'btn btn-warning']);
						},
					]
					/*'visibleButtons' => [
						'view' => Yii::$app->user->id == 122,
						'update' => Yii::$app->user->id == 19,
						'delete' => function ($model, $key, $index) {
										return $model->status === 1 ? false : true;
									}
						],
					'visible' => Yii::$app->user->id == 19,*/
				],
        ],
		'pager' => [
			'firstPageLabel' => Yii::t('app', 'หน้าแรกสุด'),
			'lastPageLabel' => Yii::t('app', 'หน้าท้ายสุด'),
		],
		'responsive'=>true,
		'hover'=>true,
		'toolbar'=> [
			['content'=>
				//Html::a(Html::icon('plus'), ['create'], ['class'=>'btn btn-success', 'title'=>Yii::t('kpi/app', 'Add Book')]).' '.
				Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
			],
			//'{export}',
			'{toggleData}',
		],
		'panel'=>[
			'type'=>GridView::TYPE_INFO,
			'heading'=> Html::icon('save').' '.Html::encode($this->title),
		],
    ]); ?>
<?php 	 /* adzpire grid tips
		[
				'attribute' => 'id',
				'headerOptions' => [
					'width' => '50px',
				],
			],
		[
		'attribute' => 'we_date',
		'value' => 'we_date',
			'filter' => DatePicker::widget([
					'model'=>$searchModel,
					'attribute'=>'date',
					'language' => 'th',
					'options' => ['placeholder' => Yii::t('kpi/app', 'enterdate')],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pickerButton' =>false,
					//'size' => 'sm',
					//'removeButton' =>false,
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd'
					]
				]),
			//'format' => 'html',			
			'format' => ['date']

		],	
		[
			'attribute' => 'we_creator',
			'value' => 'weCr.userPro.nameconcatened'
		],
	 */
 ?> 	
</div>
=======
<?php

use yii\bootstrap\Html;
//use kartik\widgets\DatePicker;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel suPnPsu\borrowMaterial\models\BorrowreturnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowreturn-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
		//'id' => 'kv-grid-demo',
			'dataProvider'=> $dataProvider,
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
					'class' => 'yii\grid\ActionColumn',
//					'headerOptions' => [
//						'width' => '200px',
//					],
					'template'=>'{submitreturn}',
					'buttons'=>[
						'submitreturn' => function($url,$model,$key){
						return Html::a(Html::icon('fast-backward').' '.'รับคืน',$url,['class' => 'btn btn-warning']);
						},
					]
					/*'visibleButtons' => [
						'view' => Yii::$app->user->id == 122,
						'update' => Yii::$app->user->id == 19,
						'delete' => function ($model, $key, $index) {
										return $model->status === 1 ? false : true;
									}
						],
					'visible' => Yii::$app->user->id == 19,*/
				],
        ],
		'pager' => [
			'firstPageLabel' => Yii::t('app', '1stPagi'),
			'lastPageLabel' => Yii::t('app', 'lastPagi'),
		],
		'responsive'=>true,
		'hover'=>true,
		'toolbar'=> [
			['content'=>
				//Html::a(Html::icon('plus'), ['create'], ['class'=>'btn btn-success', 'title'=>Yii::t('kpi/app', 'Add Book')]).' '.
				Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
			],
			//'{export}',
			'{toggleData}',
		],
		'panel'=>[
			'type'=>GridView::TYPE_INFO,
			'heading'=> Html::icon('user').' '.Html::encode($this->title),
		],
    ]); ?>
<?php 	 /* adzpire grid tips
		[
				'attribute' => 'id',
				'headerOptions' => [
					'width' => '50px',
				],
			],
		[
		'attribute' => 'we_date',
		'value' => 'we_date',
			'filter' => DatePicker::widget([
					'model'=>$searchModel,
					'attribute'=>'date',
					'language' => 'th',
					'options' => ['placeholder' => Yii::t('kpi/app', 'enterdate')],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pickerButton' =>false,
					//'size' => 'sm',
					//'removeButton' =>false,
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd'
					]
				]),
			//'format' => 'html',			
			'format' => ['date']

		],	
		[
			'attribute' => 'we_creator',
			'value' => 'weCr.userPro.nameconcatened'
		],
	 */
 ?> 	
</div>
>>>>>>> origin/master
