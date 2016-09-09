<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\Borrowreturn */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrowreturn/app', 'Borrowreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowreturn-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('borrowreturn/app', 'Delete'), ['delete', 'id' => $model->booking_id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('borrowreturn/app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('borrowreturn/app', 'Update'), ['update', 'id' => $model->booking_id], ['class' => 'btn btn-primary panbtn']) ?>
	</div>
	<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
 			[
				'label' => $model->attributeLabels()['booking_id'],
				'value' => $model->booking_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['confirm_status'],
				'value' => $model->confirm_status,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['confirm_comment'],
				'value' => $model->confirm_comment,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['confirm_staff_id'],
				'value' => $model->confirm_staff_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['confirm_at'],
				'value' => $model->confirm_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['deliver_status'],
				'value' => $model->deliver_status,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['deliver_staff_id'],
				'value' => $model->deliver_staff_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['deliver_at'],
				'value' => $model->deliver_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_status'],
				'value' => $model->return_status,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_loss'],
				'value' => $model->return_loss,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_because'],
				'value' => $model->return_because,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_staff_id'],
				'value' => $model->return_staff_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_at'],
				'value' => $model->return_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['entry_note'],
				'value' => $model->entry_note,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
</div>