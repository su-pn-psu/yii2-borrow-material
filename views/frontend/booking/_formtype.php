<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
/*
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
*/
/* @var $this yii\web\View */
/* @var $model backend\modules\inventory\models\InvtType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invt-type-form">

    <?php $form = ActiveForm::begin([
			'layout' => 'horizontal', 
			'id' => 'qaddposform',
			'fieldConfig' => [
				  'horizontalCssClasses' => [
						'label' => 'col-md-4',
						'wrapper' => 'col-sm-8',
				  ],
			 ],
			]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'saveby')->textInput() ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Html::icon('floppy-disk').' '.Yii::t('borrow-material', 'บันทึก'), ['class' => 'btn btn-success']) ?>

	</div>

    <?php ActiveForm::end(); ?>

    <?php
    $this->registerJs("
$('form#qaddposform').on('beforeSubmit', function(event){

	var form = $(this);
	$.post(
		form.attr('action'),
		form.serialize()
	).done(function(result){
		if(result == 1){
			form.trigger('reset');
			$('#modal').modal('hide');
			$.pjax.reload({container:'#posipjax'});
			alert('".Yii::t('borrow-material', 'เพิ่มข้อมูลเรียบร้อย')."');
		}else{
			alert(result);
		}
	}).fail(function(result){
		alert('server error');
	});
	return false;
});
", View::POS_END);
    ?>
</div>
