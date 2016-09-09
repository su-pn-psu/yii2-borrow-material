<?php

use yii\bootstrap\Html;


/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrowreturn/app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title"><?= Html::icon('edit').' '.Html::encode($this->title) ?></span>
			<?= Html::a( Html::icon('list-alt').' '.Yii::t('borrowreturn/app', 'entry'), ['index'], ['class' => 'btn btn-success panbtn']) ?>
		</div>
		<?php
		$session = Yii::$app->session;
		$items = $session->get('selected-material');
		?>
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
