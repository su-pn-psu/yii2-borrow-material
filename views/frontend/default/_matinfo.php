<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;
/*
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
*/
/* @var $this yii\web\View */
/* @var $model backend\modules\inventory\models\InvtType */
/* @var $form yii\widgets\ActiveForm */
?>
<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
		'id',
		'title',
		'brand',
		[
			'attribute'=>'status',
			'value'=> $model->statusLabel,
			'format'=>'html',
		],
		[
			'attribute'=>'available',
			'value'=> $model->availableLabel,
			'format'=>'html',
		],
		[
			'attribute'=>'image',
			'value'=> '/uploads/material_files/'.$model->image,
			'format' => ['image'],
		],

//            'warrant_at',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
	],
]) ?>
