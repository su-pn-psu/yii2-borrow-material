<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\Bookingmaterial */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrowreturn/app', 'Bookingmaterials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookingmaterial-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('borrowreturn/app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('borrowreturn/app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('borrowreturn/app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary panbtn']) ?>
	</div>
	<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
 			[
				'label' => $model->attributeLabels()['id'],
				'value' => $model->id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['booking_id'],
				'value' => $model->booking_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['material_id'],
				'value' => $model->material_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_condition'],
				'value' => $model->return_condition,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
</div>