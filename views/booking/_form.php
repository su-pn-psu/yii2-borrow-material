<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

use kartik\widgets\Select2;
use kartik\widgets\DateTimePicker;
use kartik\daterange\DateRangePicker;
use kartik\widgets\Typeahead;

use yii\widgets\ListView;
use yii\widgets\Pjax;

//use wbraganca\dynamicform\DynamicFormWidget;
//Select2::register($this);
//DateTimePicker::register($this);
//DateRangePicker::register($this);
//Pjax::register($this);

use yii\web\View;



use yii\helpers\Url;
/*
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
*/
/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */
/* @var $form yii\widgets\ActiveForm */
/*
$js['dynamic-form'] = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("<span class=\"glyphicon glyphicon-triangle-right\"></span> ' . Yii::t( 'app', 'material') . ' : " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("<span class=\"glyphicon glyphicon-triangle-right\"></span> ' . Yii::t( 'app', 'material') . ' : " + (index + 1))
    });
});
';*/


?>

<div class="booking-form">

    <?php $form = ActiveForm::begin([
			'layout' => 'horizontal', 
			'id' => 'dynamic-form',
			//'validateOnChange' => true,
            //'enableAjaxValidation' => true,
			//	'enctype' => 'multipart/form-data'
			]); ?>

    <?php //= $form->field($model, 'entry_status')->textInput() ?>
		<div class="col-md-1 col-md-offset-1">
			<?php 
			echo Html::img(Yii::getAlias('@web/uploads/images/PSU.png'),['width' => '75px']);
			?>
		</div>
		<div class="col-md-8 text-center">
			<h3>แบบฟอร์มการขออนุมัติยืมใช้พัสดุ-ครุภัณฑ์ ปีการศึกษา 2559</h3>
			<h4>องค์การบริหาร องค์การนักศึกษา มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตปัตตานี</h4>
		</div>
		<div class="col-md-2">
		</div>
	<div class="form-group">
		<div class="col-md-3 col-md-offset-9">
    	<?php 
		  echo $model->attributeLabels()['create_at'].' <u>'.date('Y-m-d').'</u> ';
		  /*echo $form->field($model, 'booking_at',[
            'horizontalCssClasses' => [
                'label' =>'col-md-4',
                'wrapper' => 'col-md-8',
            ]
        ])->widget(DatePicker::classname(), [
            'language' => 'th',
            'options' => ['placeholder' => Yii::t( 'app', 'enterdate')],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);*/
		  ?>
		</div>
	</div>
    <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
    <?php
        echo $mdluser->profile->attributeLabels()['user_id'].' <u>'.$mdluser->profile->user_id.'</u> ';
  		echo $mdluser->profile->attributeLabels()['firstname'].' <u>'.$mdluser->profile->firstname.'</u> ';
		echo $mdluser->profile->attributeLabels()['lastname'].' <u>'.$mdluser->profile->lastname.'</u> ';
	?>
        </div>
    </div>
	 <div class="form-group">
		<div class="col-md-6">
		<?php Pjax::begin(['id' => 'belpjax']); ?>
	 <?php
        echo $form->field($model, 'belongto_id',[
            'horizontalCssClasses' => [
                'label' =>'col-md-4',
                'wrapper' => 'col-md-8',
            ],
				'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn"><button type="button" class="btn btn-success _belqadd" value="'.Url::to(['qaddbelongto']).'" title="add belong to" data-toggle="tooltip"><span class="glyphicon glyphicon-plus"></span></button></div>',
        ])->dropDownList(
            $belongtolist,
            ['prompt' => Yii::t( 'app', 'PleaseSelect')]);

//			->widget(Select2::classname(), [
//            'data' => $mdlstdbel->dropdown,
//            'options' => ['placeholder' => Yii::t( 'app', 'PleaseSelect')],
//            'pluginOptions' => [
//                'allowClear' => true
//            ],
//        ]);
	  ?>
	  <?php Pjax::end(); ?>
	  </div>
	  <div class="col-md-6">
	  <?php Pjax::begin(['id' => 'posipjax']); ?>
		<?php		
        echo $form->field($model, 'position_id',[
            'horizontalCssClasses' => [
                'label' =>'col-md-3',
                'wrapper' => 'col-md-9',
            ],
				'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn"><button type="button" class="btn btn-success _invttqadd" value="'.Url::to(['qaddposition']).'" title="add position of belong to" data-toggle="tooltip"><span class="glyphicon glyphicon-plus"></span></button></div>',
        ])->dropDownList(
            $positionlist,
            ['prompt' => Yii::t( 'app', 'PleaseSelect')]);
//            ->widget(Select2::classname(), [
//            'data' => $positionlist,
//            'options' => ['placeholder' => Yii::t( 'app', 'PleaseSelect')],
//            'pluginOptions' => [
//                'allowClear' => true
//            ],
//        ]);
	  ?>
	  <?php Pjax::end(); ?>
	  </div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<?= $form->field($model, 'purpose',[
            'horizontalCssClasses' => [
                'label' =>'col-md-2',
                'wrapper' => 'col-md-10',
            ]
        ])->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-5">
			<?= $form->field($model, 'isin_university',[
            'horizontalCssClasses' => [
                'label' =>'col-md-4',
                'wrapper' => 'col-md-8',
            ]
        ])->inline()->radioList($model->isinlist) ?>
		</div>
		<div class="col-md-7">
			<?= $form->field($model, 'university_place',[
            'horizontalCssClasses' => [
                'label' =>'col-md-3',
                'wrapper' => 'col-md-9',
            ]
        ])->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	<div class="padding-xxs">
		<div class="line line-dashed"></div>	  
	</div>
	<?php /* DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsAddress[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'material_id',
            //'wd_amount',
            //'address_line2',
            //'city',
            // 'state',
            // 'postal_code',
        ],
    ]); ?>
	 <div class="panel panel-warning">
        <div class="panel-heading">
            <?= Html::icon('scissors').' '.Yii::t( 'app', 'material list') ?>
            <button type="button" class="pull-right add-item btn btn-success btn-sm"><?= Html::icon('plus').' '.Yii::t( 'app', 'add') ?>
            </button>
            <div class="clearfix"></div>
        </div>
		<table class="table"> 
			<thead> 
				<tr> 
					<th>#</th> <th>Items</th> <th width='60px'>Operation</th> 
				</tr> 
			</thead> 
			<tbody class="container-items"> 
				<?php foreach ($modelsAddress as $index => $modelAddress): ?>
				<tr class="item"> 
					<th scope="row"><?= ($index + 1) ?></th> 
					<td>
					<?php
						// necessary for update action.
						if (!$modelAddress->isNewRecord) {
							 echo Html::activeHiddenInput($modelAddress, "[{$index}]id");
						} 
					?>
					<?php  echo $form->field($modelAddress, "[{$index}]material_id", [
							'horizontalCssClasses' => [
								 'label' =>'col-md-2',
								 'wrapper' => 'col-md-10',
							]
						])->dropDownList(
                            $availmatlist,
                            ['prompt' => 'รายการที่พร้อมยืม']);
					?>
					</td> 
					<td>
					<button type="button" class="pull-right remove-item btn btn-danger btn-xs"><?= Html::icon('minus').' '.Yii::t( 'app', 'delete') ?></button>
					</td> 
				</tr>
				<?php endforeach; ?>				
			</tbody>
		</table>
		
    </div>
    <?php DynamicFormWidget::end();*/ ?>
	 <div class="material-items">
	 <?php
		echo ListView::widget([
			'dataProvider' => $dataProviderMaterial,
			'layout' => "{pager}\n{items}\n{summary}",
			'itemView' => '_material_list_item',
		]);
		?>
	 </div>
	 <div class="selected-material">
		<?php
		//$session = Yii::$app->session;
		//$items = $session->get('selected-material');
		?>
		<table class="table table-striped"> 
			<thead> 
				<tr> 
					<th>#</th> 
					<th>Title</th> 
					<th>Delete</th> 
				</tr> 
			</thead> 
			<tbody> 
			<?php $row = 1; ?>
			<?php foreach($items as $key => $item) : ?>
				<tr> 
					<th scope="row"><?= $row++; ?></th> 
					<td><?= $item['title']; ?></td> 
					<td><a href="<?= Url::to(['ajax-clear-selected-material', 'id'=>$key]); ?>" class="btn btn-danger btn-sm">Del</a></td>
				</tr> 
			<?php endforeach; ?>
			</tbody> 
		</table>
		
	 </div>
	 <a href="<?= Url::to(['ajax-clear-selected-material']); ?>" class="btn btn-danger btn-clear-item">Clear items</a>
	 
	 
	<div class="padding-xxs">
		<div class="line line-dashed"></div>
	</div>
	 <div class="form-group">
		<div class="col-md-12">
	<?php 
	$model->booking_at = date('Y-m-d  H:i');
	$model->return_at = date('Y-m-d  H:i');
	
	echo $form->field($model, 'rangedatetime', [
			 'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span></div>',
			 'horizontalCssClasses' => [
                'label' =>'col-md-2',
                'wrapper' => 'col-md-10',
            ]
			])->widget(DateRangePicker::classname(), [
				'model'=>$model,
				'attribute' => 'rangedatetime',
				//'value'=>'2015-10-19 12:00 AM - 2015-11-03 01:00 PM',
				'convertFormat'=>true,
				'startAttribute' => 'booking_at',
				'endAttribute' => 'return_at',
				'pluginOptions'=>[
				  'timePicker'=>true,
				  'timePickerIncrement'=>15,
				  'timePicker24Hour' => true,
				  'locale'=>['format'=>'Y-m-d H:i']
				],
	]);
	?>
		</div>
	</div>
    <?php 
		echo $form->field($model, 'acquire_at',[
            'horizontalCssClasses' => [
                'label' =>'col-md-2',
                'wrapper' => 'col-md-10',
            ]
        ])->widget(DateTimePicker::classname(), [
			'options' => ['placeholder' => 'Enter event time ...'],
			'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
			'pluginOptions' => [
			'autoclose' => true
			]
		]);
	 ?>
	 <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
			<h4>ข้าพเจ้าขอรับผิดชอบต่อพัสดุ-ครุภัณฑ์ ที่ขอยืมใช้ หากเกิดชำรุด เสียหายแม้ว่าด้วยกรณีใด ข้าพเจ้ายินดีชดใช้ค่าเสียหายที่เกิดขึ้น ตามระเบียบทุกประการอีกทั้งให้บัตรนักศึกษาเพื่อเป็นหลักฐานยืนยันทุกครั้งที่มายืมใช้อุปกรณ์ และชำระค่าซ่อมบำรุง พัสดุ-ครุภัณฑ์ ตามระเบียบขอฝ่ายพัสดุ องค์การบริหาร องค์การนักศึกษา ปี 2559</h4>
        </div>
    </div>	 

		<?= $form->field($model, 'sbmtcheck')->checkbox(['label' => Yii::t( 'app', 'i have read rule')]) ?>

<?php 		/* adzpire form tips
		$form->field($model, 'wu_tel', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]);
		//file field
				echo $form->field($model, 'file',[
		'addon' => [
       
'append' => !empty($model->wt_image) ? [
			'content'=> Html::a( Html::icon('download').' '.Yii::t( 'app', 'download'), Url::to('@backend/web/'.$model->wt_image), ['class' => 'btn btn-success', 'target' => '_blank']), 'asButton'=>true] : false
    ]])->widget(FileInput::classname(), [
			//'options' => ['accept' => 'image/*'],
			'pluginOptions' => [
				'showPreview' => false,
				'showCaption' => true,
				'showRemove' => true,
				'initialCaption'=> $model->isNewRecord ? '' : $model->wt_image,
				'showUpload' => false
			]
]);
		*/
 ?>   
<div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ?  Html::icon('floppy-disk').' '.Yii::t( 'app', 'Save') :  Html::icon('floppy-disk').' '.Yii::t( 'app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		  <?php if($model->isNewRecord or $model->entry_status == 0){
			echo Html::button( Html::icon('play').' '.Yii::t( 'app', 'submitbooking') , ['class' => 'btn btn-danger']);

		 } ?>
		<?php if(!$model->isNewRecord){
		 echo Html::resetButton( Html::icon('refresh').' '.Yii::t( 'app', 'Reset') , ['class' => 'btn btn-warning']);
		 } ?>
		 
</div>

    <?php ActiveForm::end(); ?>
<?php
    Modal::begin([
        'header' => 'Quick Op',
        'id' => 'modal',
    ]);
    echo '<div id ="modalcontent"></div>';
    Modal::end();
?>
<?php
$js['quick-add'] ="

    $('._invttqadd').on('click', function(event){
		event.preventDefault();
		$('#modal').modal('show')
		.find('#modalcontent')
		.load($(this).attr('value'));
			return false;//just to see what data is coming to js
    });
	 
	 $('._belqadd').on('click', function(event){
		event.preventDefault();
		$('#modal').modal('show')
		.find('#modalcontent')
		.load($(this).attr('value'));
			return false;//just to see what data is coming to js
    });
";
	?>
</div>
<?php
$js['ajax-select-material']="
	$('.btn-add-item').on('click', function(event){
		event.preventDefault();
		$.ajax({
			url: $(this).attr('href'),
			data:{'id': $(this).data('item_id')},
			dataType: 'json',
			success: function(data){
				//alert(data.item[0].title);
				//console.log(data);
				if(data.status == 2){
					alert('มึงแลือกไว้แล้ว ฟาาาย...');
				}else if(data.status == 1){
					location.reload();
				}
			}
		});
	});
	
	$('.btn-clear-item').on('click', function(event){
		event.preventDefault();
		$.ajax({
			url: $(this).attr('href'),
			success: function(){
				location.reload();
			}
		});
	});
";
?>

<?php
$this->registerJs(implode("\n", $js));
?>
