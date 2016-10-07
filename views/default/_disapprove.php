<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
?>
<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'id' => 'dissub',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-md-4',
            'wrapper' => 'col-sm-8',
        ],
    ],
]); ?>
    <div class="form-group">
        <label class="control-label col-md-4">ความเห็น-อนุมัติ</label>
        <div class="col-sm-8">
            <?php echo '<span class="text-danger">'.$model->confirm_comment.'</span>' ?>
        </div>
    </div>

<?php //= $form->field($model, 'confirm_comment')->textInput(['maxlength' => true]) ?>

<?php echo Html::activeHiddenInput($model, 'booking_id') ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Html::icon('floppy-disk').' '.Yii::t('borrow-material', 'บันทึก'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs("
$('form#dissub').on('beforeSubmit', function(event){

	var form = $(this);
	$.post(
		form.attr('action'),
		form.serialize()
	).done(function(result){
		if(result == 1){
			form.trigger('reset');
            $.pjax.reload({container:'#w0-pjax'});
			$('#modal').modal('hide');
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
