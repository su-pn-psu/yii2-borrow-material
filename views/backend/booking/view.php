<<<<<<< HEAD
<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrow-material', 'รายการจองพัสดุ/ครุภัณฑ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('borrow-material', 'ลบ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('borrow-material', 'คุณแน่ใจว่าต้องการลบรายการนี้?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('borrow-material', 'Update'), ['ปรับปรุงข้อมูล', 'id' => $model->id], ['class' => 'btn btn-primary panbtn']) ?>
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
				'label' => $model->attributeLabels()['entry_status'],
				'value' => $model->entry_status,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['booking_at'],
				'value' => $model->booking_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['user_id'],
				'value' => $model->user_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['belongto_id'],
				'value' => $model->belongto_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['position_id'],
				'value' => $model->position_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['purpose'],
				'value' => $model->purpose,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['isin_university'],
				'value' => $model->isin_university,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['university_place'],
				'value' => $model->university_place,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['acquire_at'],
				'value' => $model->acquire_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_at'],
				'value' => $model->return_at,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
=======
<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrow-material', 'รายการจองพัสดุ/ครุภัณฑ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('borrow-material', 'ลบ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('borrow-material', 'คุณแน่ใจว่าต้องการลบรายการนี้?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('borrow-material', 'Update'), ['ปรับปรุงข้อมูล', 'id' => $model->id], ['class' => 'btn btn-primary panbtn']) ?>
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
				'label' => $model->attributeLabels()['entry_status'],
				'value' => $model->entry_status,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['booking_at'],
				'value' => $model->booking_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['user_id'],
				'value' => $model->user_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['belongto_id'],
				'value' => $model->belongto_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['position_id'],
				'value' => $model->position_id,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['purpose'],
				'value' => $model->purpose,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['isin_university'],
				'value' => $model->isin_university,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['university_place'],
				'value' => $model->university_place,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['acquire_at'],
				'value' => $model->acquire_at,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['return_at'],
				'value' => $model->return_at,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
>>>>>>> origin/master
</div>