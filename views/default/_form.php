<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
//use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\widgets\DateTimePicker;
use kartik\widgets\DatePicker;
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
use suPnPsu\borrowMaterial\assets\Asset;

$asset = Asset::register($this);
list(, $url) = Yii::$app->assetManager->publish('@suPnPsu/reserveRoom/assets');
$user = $model->user_id ? $model->user->profile->resultInfo : Yii::$app->user->identity->profile->resultInfo;
?>

<div class="booking-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'dynamic-form',
    ]);
    $session = Yii::$app->session;
    $crform = $session->get('create-form');
    ?>

    <div class="row">
        <div class="col-sm-1 col-sm-offset-1">
            <?php
            echo Html::img(['/uploads/images/PSU.png'], ['width' => '75px']);
            ?>
        </div>
        <div class="col-sm-8 text-center">
            <h3>แบบฟอร์มการขออนุมัติยืมใช้พัสดุ-ครุภัณฑ์</h3>
            <h4>องค์การบริหาร องค์การนักศึกษา มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตปัตตานี</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 text-center col-sm-offset-8">
            วันที่ <?= Yii::$app->formatter->asDate(date("Y-m-d"), 'long') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <br/>
            <br/>
            <p style="text-indent: 10%;line-height: 25px;">

                ข้าพเจ้า
                <span class="text-underline">
                    <?= $user->fullname; ?>
                </span>

                รหัสศึกษา
                <span class="text-underline">
                    <?= $user->username; ?>
                </span>

                สาขาวิชา
                <span class="text-underline">
                    <?= $user->major; ?>
                </span>

                คณะ
                <span class="text-underline">
                    <?= $user->faculty; ?>
                </span>
            </p>
        </div>
    </div>

    <div class="row">
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

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'purpose')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
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
            ])->radioList($model->getEntryisinUni())
            ?>
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
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
//isset($crform['Booking']['university_place']) ? $crform['Booking']['university_place'] : false,

            $layout3 = <<< HTML
    <span class="input-group-addon">เริ่มวันที่</span>
    {input1}
    <span class="input-group-addon">ถึงวันที่</span>
    {input2}
    <span class="input-group-addon kv-date-remove">
        <i class="glyphicon glyphicon-remove"></i>
    </span>
                    
HTML;
            echo $form->field($model, 'booking_at')->widget(DatePicker::classname(), [
                //'attribute' => 'booking_at',
                //'value' => '01-Feb-1996',
                'type' => DatePicker::TYPE_RANGE,
                'attribute2' => 'return_at',
                //'value2' => '27-Feb-1996',
                'layout' => $layout3,
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'startDate' => date('Y-m-d', strtotime("+3 day"))
                ],
                'pluginEvents' => [
                "hide" => "function(e) {  
                    //alert($(this).val());
                    //console.log(e);
                    //matNotEmpty = [0,1,2];
                    chkRageTime($('input#booking-booking_at').val(),$('input#booking-return_at').val()); 
                    }",
    //"changeDate" => "function(e) {alert(555); }",
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12">

            <div class="selected-material">

                <div class="form-group">
                    <?= Html::button('+ เลือกพัสดุ', ['value' => Url::to(['/reserve-room/default/room-list']), 'title' => 'เลือกพัสดุ', 'class' => 'showModalButton btn btn-primary']); ?>
                </div>
                <?php
                //$session = Yii::$app->session;
                //$items = $session->get('selected-material');
                ?>
                <div class="data table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รูปภาพ</th>
                                <th>รหัส</th>
                                <th>ชื่อ</th>
                                <th>ยี่ห้อ</th>
                                <th>รายละเอียด</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            <?php
            echo $form->field($model, 'acquire_at', [
                //'enableAjaxValidation' => true,
                'horizontalCssClasses' => [
                    'label' => 'col-md-2',
                    'wrapper' => 'col-md-10',
                ]
            ])->widget(DateTimePicker::classname(), [
                'options' => ['id' => 'aqdate', 'placeholder' => 'Enter event time ...'],
                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose' => true,
                    'locale' => ['format' => 'Y-m-d H:i'],
                    'startDate' => date('Y-m-d', strtotime("+3 day")),
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-8 text-center">
            <br/><br/>
            ลงชื่อ 
            <span class="text-underline">
                <?= $user->fullname; ?>
            </span>
            <?= $model->getAttributeLabel('user_id') ?> <br />
            ( <?= $user->fullname ?> ) <br />
            <?= $user->fullname ?> <?= $model->getAttributeLabel('user_id') ?> <br />

        </div>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton(Html::icon('floppy-disk') . ' ' . Yii::t('app', 'บันทึก'), ['class' => 'btn btn-primary']) ?>        

        <?php
        if ($model->isNewRecord or $model->entry_status == 0) {
            echo Html::submitButton(Html::icon('play') . ' ' . Yii::t('borrow-material', 'ยื่นส่งการจอง'), [
                'class' => 'btn btn-success',
                'name' => 'sng',
                'data' => [
                    'confirm' => Yii::t('borrow-material', 'คุณไม่สามารถแก้ไขแบบฟอร์มนี้ได้อีกหลังการอนุนัติ, คุณแน่ใจหรือไม่?'),
                //'method' => 'post',
                ],
            ]);
        }
        ?>
        <?php
        if (!$model->isNewRecord) {
            echo Html::a(Html::icon('refresh') . ' ' . Yii::t('borrow-material', 'ยกเลิก'), ['index'], ['class' => 'btn btn-warning']);
        }
        ?>

    </div>

    <?php ActiveForm::end(); ?>


    <?php
    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modalMaterailList',
        'size' => 'modal-lg',
        'clientOptions' => [
            'backdrop' => 'static',
        //'keyboard' => FALSE
        ],
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
    ]);
    echo "<div id='main-content'>" . Yii::$app->runAction('/borrow-material/default/material-list') . "</div>";
    Modal::end();



    $js = ' 
        var matNotEmpty = [];
 var urlChkMaterial = "' . Url::to(['check-material'], true) . '";
';

    $this->registerJs($js, View::POS_HEAD);
    $this->registerJsFile($asset->baseUrl . '/js/create.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>


    <?php
    Modal::begin([
        'header' => 'Quick Op',
        'id' => 'modal',
    ]);
    echo '<div id ="modalcontent"></div>';
    Modal::end();
    ?>
    <?php
    /*
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
      '" . Url::to(['createemp']) . "',
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
      if (isset($crform['Booking']['belongto_id'])) {
      $js['set-bel'] = "
      $('#booking-belongto_id').val(" . $crform['Booking']['belongto_id'] . ").trigger('change');
      ";
      }
      if (isset($crform['Booking']['position_id'])) {
      $js['set-pos'] = "
      $('#booking-position_id').val(" . $crform['Booking']['position_id'] . ").trigger('change');
      ";
      }
      ?>

      <?php
      $this->registerJs(implode("\n", $js));
     * 
     */
    ?>
