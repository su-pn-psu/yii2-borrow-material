<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\Material */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrowreturn/app', 'Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-view">

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
				'label' => $model->attributeLabels()['title'],
				'value' => $model->title,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['detail'],
				'value' => $model->detail,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['status'],
				'value' => $model->status,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['available'],
				'value' => $model->available,			
				//'format' => ['date', 'long']
			],
     			[
				'label' => $model->attributeLabels()['save_by'],
				'value' => $model->save_by,			
				//'format' => ['date', 'long']
			],
    	],
    ]) ?>
	</div>
</div>
</div>