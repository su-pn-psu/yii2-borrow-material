<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\Booking */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrowreturn/app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('borrowreturn/app', 'Update');
?>
<div class="booking-update">

<div class="panel panel-warning">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('edit').' '.Html::encode($this->title) ?></span>
		<?= Html::a( Html::icon('fire').' '.Yii::t('borrowreturn/app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger panbtn',
            'data' => [
                'confirm' => Yii::t('borrowreturn/app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a( Html::icon('pencil').' '.Yii::t('borrowreturn/app', 'createnew'), ['create'], ['class' => 'btn btn-info panbtn']) ?>
	</div>
	<div class="panel-body">
	<?= $this->render('_form', [
		'model' => $model,
		'mdluser' => $mdluser,
		'belongtolist' => $belongtolist,
		'positionlist' => $positionlist,
		'availmatlist' => $availmatlist,
		'modelsAddress' => (empty($modelsAddress)) ? [new Bookingmaterial] : $modelsAddress,
		'searchMaterial' => $searchMaterial,
		'dataProviderMaterial' => $dataProviderMaterial,
		'items' => $items,
	]) ?>
	</div>
</div>

</div>
