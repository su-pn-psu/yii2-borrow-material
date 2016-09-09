<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
/*
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
*/
/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\StdBelongto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="std-belongto-form">

    <?php $form = ActiveForm::begin([
			'layout' => 'horizontal', 
			'id' => 'std-belongto-form',
			//'validateOnChange' => true,
            //'enableAjaxValidation' => true,
			//	'enctype' => 'multipart/form-data'
			]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saveby')->textInput() ?>

<?php 		/* adzpire form tips
		$form->field($model, 'wu_tel', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]);
		//file field
				echo $form->field($model, 'file',[
		'addon' => [
       
'append' => !empty($model->wt_image) ? [
			'content'=> Html::a( Html::icon('download').' '.Yii::t('kpi/app', 'download'), Url::to('@backend/web/'.$model->wt_image), ['class' => 'btn btn-success', 'target' => '_blank']), 'asButton'=>true] : false
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
 ?>     <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ?  Html::icon('floppy-disk').' '.Yii::t('borrowreturn/app', 'Save') :  Html::icon('floppy-disk').' '.Yii::t('borrowreturn/app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php if(!$model->isNewRecord){
		 echo Html::resetButton( Html::icon('refresh').' '.Yii::t('borrowreturn/app', 'Reset') , ['class' => 'btn btn-warning']); 
		 } ?>
		 
	</div>

    <?php ActiveForm::end(); ?>

</div>
