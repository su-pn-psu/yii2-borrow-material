<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

//use kartik\grid\GridView;
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
    ]);
    $session = Yii::$app->session;
    $crform = $session->get('create-form');
    ?>

    <?php //= $form->field($model, 'entry_status')->textInput() ?>
    <div class="col-md-1 col-md-offset-1">
        <?php
        echo Html::img('/uploads/images/PSU.png', ['width' => '75px']);
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
            echo $model->attributeLabels()['create_at'] . ' <u>' . date('Y-m-d') . '</u> ';
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
            <p>
                ข้าพเจ้า
                <u><?= $mdluser->profile->fullname; ?></u>

                รหัสศึกษา
                <u><?= $mdluser->username; ?></u>

                สาขาวิชา
                <u><?= $mdluser->profile->resultInfo->major; ?></u>

                คณะ
                <u><?= $mdluser->profile->resultInfo->factory; ?></u>

            </p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <?php Pjax::begin(['id' => 'belpjax']); ?>
            <?php
            //$model->belongto_id = isset($crform['Booking']['belongto_id']) ? $crform['Booking']['belongto_id'] : false;
            echo $form->field($model, 'belongto_id', [
                'horizontalCssClasses' => [
                    'label' => 'col-md-4',
                    'wrapper' => 'col-md-8',
                ],
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn"><button type="button" class="btn btn-success _belqadd" value="' . Url::to(['qaddbelongto']) . '" title="add belong to" data-toggle="tooltip"><span class="glyphicon glyphicon-plus"></span></button></div>',
            ])->widget(Select2::classname(), [
                'data' => $belongtolist,
                'options' => ['placeholder' => Yii::t('borrow-material', 'กรุณาเลือก...')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);

            //            ->dropDownList(
            //            $belongtolist,
            //            ['prompt' => Yii::t( 'app', 'PleaseSelect')]);
            ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-md-6">
            <?php Pjax::begin(['id' => 'posipjax']); ?>
            <?php
            //$model->position_id = isset($crform['Booking']['position_id']) ? $crform['Booking']['position_id'] : false;
            echo $form->field($model, 'position_id', [
                'horizontalCssClasses' => [
                    'label' => 'col-md-3',
                    'wrapper' => 'col-md-9',
                ],
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn"><button type="button" class="btn btn-success _invttqadd" value="' . Url::to(['qaddposition']) . '" title="add position of belong to" data-toggle="tooltip"><span class="glyphicon glyphicon-plus"></span></button></div>',
            ])->widget(Select2::classname(), [
                'data' => $positionlist,
                'options' => ['placeholder' => Yii::t('borrow-material', 'กรุณาเลือก...')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            //            ->dropDownList(
            //            $positionlist,
            //            ['prompt' => Yii::t( 'app', 'PleaseSelect')]);

            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <?php
            if ($model->isNewRecord) {
                $model->purpose = isset($crform['Booking']['purpose']) ? $crform['Booking']['purpose'] : false;
            }
            echo $form->field($model, 'purpose', [
                'horizontalCssClasses' => [
                    'label' => 'col-md-2',
                    'wrapper' => 'col-md-10',
                ]
            ])->textInput([
                'maxlength' => true,
                ]) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-5">
            <?php
            if ($model->isNewRecord) {
                $model->isin_university = isset($crform['Booking']['isin_university']) ? $crform['Booking']['isin_university'] : false;
            }
            echo $form->field($model, 'isin_university', [
                'horizontalCssClasses' => [
                    'label' => 'col-md-4',
                    'wrapper' => 'col-md-8',
                ]
            ])->inline()->radioList($model->getEntryisinUni()) ?>
        </div>
        <div class="col-md-7">
            <?php
            if ($model->isNewRecord) {
                $model->university_place = isset($crform['Booking']['university_place']) ? $crform['Booking']['university_place'] : false;
            }
            echo $form->field($model, 'university_place', [
                'horizontalCssClasses' => [
                    'label' => 'col-md-3',
                    'wrapper' => 'col-md-9',
                ]
            ])->textInput([
                'maxlength' => true,
            ]) ?>
        </div>
    </div>
    <div class="padding-xxs">
        <div class="line line-dashed"></div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <?php

            //isset($crform['Booking']['university_place']) ? $crform['Booking']['university_place'] : false,
            if ($model->isNewRecord) {
                $model->booking_at = isset($crform['Booking']['booking_at']) ? $crform['Booking']['booking_at'] : date('Y-m-d  H:i');
                $model->acquire_at = isset($crform['Booking']['acquire_at']) ? $crform['Booking']['acquire_at'] : date('Y-m-d  H:i', strtotime('+3 days'));
                $model->return_at = isset($crform['Booking']['return_at']) ? $crform['Booking']['return_at'] : date('Y-m-d  H:i');

            }else{
                if($model->booking_at <= date('Y-m-d  H:i', strtotime('+3 days'))){
                    $model->booking_at = date('Y-m-d  H:i', strtotime('+3 days'));
                }
                if($model->return_at <= $model->booking_at){
                    $model->return_at = $model->booking_at;
                }
                if($model->acquire_at <= date('Y-m-d  H:i')){
                    $model->acquire_at = date('Y-m-d  H:i', strtotime('+3 days'));
                }
            }

            echo $form->field($model, 'rangedatetime', [
                //'enableAjaxValidation' => true,
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span></div>',
                'horizontalCssClasses' => [
                    'label' => 'col-md-2',
                    'wrapper' => 'col-md-10',
                ]
            ])->widget(DateRangePicker::classname(), [
                'model' => $model,
                'attribute' => 'rangedatetime',
                //'value'=>'2015-10-19 12:00 AM - 2015-11-03 01:00 PM',
                'convertFormat' => true,
                'startAttribute' => 'booking_at',
                'endAttribute' => 'return_at',
                'pluginOptions' => [
                    'timePicker' => true,
                    //'startDate' => date('Y-m-d', strtotime("+3 day")),
                    'minDate' => date('Y-m-d', strtotime("+3 day")),
                    'timePickerIncrement' => 15,
                    'timePicker24Hour' => true,
                    'locale' => ['format' => 'Y-m-d H:i'],
                ],
                'pluginEvents' => [
                    "apply.daterangepicker" => 'function() {

                        var str = $(this).val();
                        var res = str.split(" - ");
                        console.log(res[0]);
                        $("#aqdate").datetimepicker("remove");
                        $("#aqdate").val(res[0]);
                        $("#aqdate").datetimepicker("setStartDate", res[0]);
                    }',
                ],
            ]);
            ?>
        </div>
    </div>
    <?php
    echo $form->field($model, 'acquire_at', [
        //'enableAjaxValidation' => true,
        'horizontalCssClasses' => [
            'label' => 'col-md-2',
            'wrapper' => 'col-md-10',
        ]
    ])->widget(DateTimePicker::classname(), [
        'options' => ['id' => 'aqdate','placeholder' => 'Enter event time ...'],
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'locale' => ['format' => 'Y-m-d H:i'],
            'startDate' => date('Y-m-d', strtotime("+3 day")),
        ]
    ]);
    ?>
    <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
            <h4><?php echo $model->promisetext; ?></h4>
        </div>
    </div>

    <?= $form->field($model, 'sbmtcheck',[
        'enableAjaxValidation' => true,
        'horizontalCssClasses' => [
            'label' => 'col-md-3',
            'wrapper' => 'col-md-9',
        ]
    ])->checkbox(['label' => Yii::t('borrow-material', 'ฉันได้อ่านระเบียบของพัสดุ <a href="/advanced/backend/web/media/booking/rule.pdf" target="_blank">click</a> แล้ว')]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Html::icon('floppy-disk') . ' ' . Yii::t('borrow-material', 'บันทึก') : Html::icon('floppy-disk') . ' ' . Yii::t('borrow-material', 'บันทึก'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <!--		  --><?php
        //if($model->isNewRecord or $model->entry_status == 0){
        //echo Html::button( Html::icon('play').' '.Yii::t( 'app', 'submitbooking') , ['class' => 'btn btn-danger']);
        //}
        ?>
        <?php if ($model->isNewRecord or $model->entry_status == 0) {
            echo Html::submitButton(Html::icon('play') . ' ' . Yii::t('borrow-material', 'ยื่นส่งการจอง'), [
                'class' => 'btn btn-danger',
                'name'=>'sng',
                'data' => [
                    'confirm' => Yii::t('borrow-material', 'คุณไม่สามารถแก้ไขแบบฟอร์มนี้ได้อีกหลังการอนุนัติ, คุณแน่ใจหรือไม่?'),
                    //'method' => 'post',
                ],
            ]);
        } ?>
        <?php if (!$model->isNewRecord) {
            echo Html::a(Html::icon('refresh') . ' ' . Yii::t('borrow-material', 'ยกเลิก'), ['index'], ['class' => 'btn btn-warning']);
        } ?>

    </div>

    <?php ActiveForm::end(); ?>

    <div class="selected-material">
        <?php
        //$session = Yii::$app->session;
        //$items = $session->get('selected-material');
        ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>ยี่ห้อ</th>
            </tr>
            </thead>
            <tbody>
            <?php $row = 1; ?>
            <?php foreach ($items as $key => $item) : ?>
                <tr>
                    <th scope="row"><?= $row++; ?></th>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['title']; ?></td>
                    <td><?= $item['brand']; ?></td>
                    <?php //= Html::a( Html::icon('trash'), ['ajax-clear-selected-material', 'id' => $key], ['class' => 'btn btn-danger']) ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="form-group text-center">
            <?php
            echo Html::a( Html::icon('tags').' '.Yii::t( 'app', 'กลับไปเลือกพัสดุ'),['selectmat'], ['class' => 'btn btn-primary _gencreatesession', 'data'=>['act'=> 'test']]);
            ?>
            <?php //echo $crform['Booking']['belongto_id']; ?>
        </div>
    </div>

    <?php
    Modal::begin([
        'header' => 'Quick Op',
        'id' => 'modal',
    ]);
    echo '<div id ="modalcontent"></div>';
    Modal::end();
    ?>
    <?php
    $js['quick-add'] = "

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
$js['ajax-select-material'] = "
	
	$('.btn-clear-item').on('click', function(event){
		event.preventDefault();//alert('astyutyu');
		$.ajax({
			url: $(this).attr('href'),
			//data:{'id': $(this).data('item_id')},
			//dataType: 'json',
			success: function(){
				$.pjax.reload({container:'#itempjax'});
			}
		});
	});

    $('._gencreatesession').on('click', function(event){

        var form = $('form');
        $.post(
            '".Url::to(['createemp'])."',
            form.serialize()
        ).done(function(result){
            if(result){
                //alert(result);
            }
        });
        //return false;
    });
    //$('#booking-belongto_id').val(2).trigger('change');
//$(document).on('pjax:send', function() {
//    $('#modalcontent').val('processing request...');
//    $('#modal').modal('show');
//});
//$(document).on('pjax:complete', function() {
//    $('#modal').modal('hide');
//});
$(document).on('pjax:error', function() {
    event.preventDefault();
});
$(document).on('pjax:timeout', function(event) {
  event.preventDefault();
});
";
if(isset($crform['Booking']['belongto_id'])){
    $js['set-bel'] = "
        $('#booking-belongto_id').val(".$crform['Booking']['belongto_id'].").trigger('change');
    ";
}
if(isset($crform['Booking']['position_id'])){
    $js['set-pos'] = "
        $('#booking-position_id').val(".$crform['Booking']['position_id'].").trigger('change');
    ";
}
?>

<?php
$this->registerJs(implode("\n", $js));
?>