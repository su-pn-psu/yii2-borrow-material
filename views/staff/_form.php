<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

/*
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
*/
/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Borrowreturn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrowreturn-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'id' => 'borrowreturn-form',
        //'validateOnChange' => true,
        //'enableAjaxValidation' => true,
        //	'enctype' => 'multipart/form-data'
    ]); ?>
    <?php //= $form->field($model, 'booking_id')->textInput() ?>

    <?php if ($this->context->action->id == 'submitborrow') { ?>
        <?= $form->field($model, 'confirm_status', [
            'horizontalCssClasses' => [
                'label' => 'col-md-3',
                'wrapper' => 'col-md-8',
                'hint' => 'col-md-12 col-md-offset-3',
            ]
        ])->inline()->radioList($model->approvelist)->hint($unavial == 1 ? '<code>โปรดระวัง มีรายการที่สถานะการยืมไม่พร้อมอยู่</code>' : false) ?>
        <?php //= $form->field($model, 'confirm_status')->textInput() ?>
        <?= $form->field($model, 'confirm_comment')->textInput(['maxlength' => true]) ?>

    <?php } elseif ($this->context->action->id == 'submitsend') { ?>

        <?= $form->field($model, 'deliver_status', [
            'horizontalCssClasses' => [
                'label' => 'col-md-4',
                'wrapper' => 'col-md-8',
            ]
        ])->inline()->radioList($model->deleverlist) ?>

    <?php } elseif ($this->context->action->id == 'submitreturn') { ?>

        <?= $form->field($model, 'return_status', [
            'horizontalCssClasses' => [
                'label' => 'col-md-4',
                'wrapper' => 'col-md-8',
            ]
        ])->inline()->radioList($model->returnlist) ?>
        <?= $form->field($model, 'return_loss')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'return_because')->textInput(['maxlength' => true]) ?>

    <?php } ?>

    <?= $form->field($model, 'entry_note')->textarea(['rows' => 6]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Html::icon('floppy-disk') . ' ' . Yii::t('app', 'Save') : Html::icon('floppy-disk') . ' ' . Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if (!$model->isNewRecord) {
            echo Html::resetButton(Html::icon('refresh') . ' ' . Yii::t('app', 'Reset'), ['class' => 'btn btn-warning']);
        } ?>

    </div>

    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJs("
	$(\"input[name='Borrowreturn[confirm_status]']:radio\").click(function() {
        if($(this).attr('value')=='0') {
          $('.field-borrowreturn-confirm_comment').show().find( 'input' ).prop('disabled', false);
        }
        if($(this).attr('value')=='1') {
          $('.field-borrowreturn-confirm_comment').hide().find( 'input' ).val('').prop('disabled', true);
        }
    });
    $(\"input[name='Borrowreturn[return_status]']:radio\").click(function() {
        if($(this).attr('value')=='0') {
          $('.field-borrowreturn-return_loss, .field-borrowreturn-return_because').show().find( 'input' ).prop('disabled', false);
        }
        if($(this).attr('value')=='1') {
          $('.field-borrowreturn-return_loss, .field-borrowreturn-return_because').hide().find( 'input' ).val('').prop('disabled', true);
        }
    });
", View::POS_END);
    ?>
</div>
