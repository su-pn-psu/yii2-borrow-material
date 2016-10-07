<?php

use yii\bootstrap\Html;


/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */

$this->params['breadcrumbs'][] = ['label' => Yii::t( 'borrow-material', 'รายการจองพัสดุ/ครุภัณฑ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title"><?= Html::icon('edit').' '.Html::encode($this->title) ?></span>
			<?= Html::a( Html::icon('list-alt').' '.Yii::t( 'borrow-material', 'รายการ'), ['index'], ['class' => 'btn btn-success panbtn']) ?>
		</div>
		<?php
		$session = Yii::$app->session;
		$items = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');
		?>
		<div class="panel-body">
		 <?= $this->render('_form', [
			  'model' => $model,
			  'mdluser' => $mdluser,
			  'belongtolist' => $belongtolist,
			  'positionlist' => $positionlist,
<<<<<<< HEAD
=======
			  'availmatlist' => $availmatlist,
			  'searchMaterial' => $searchMaterial,
			  'dataProviderMaterial' => $dataProviderMaterial,
>>>>>>> origin/master
			  'items' => $items,
		 ]) ?>
		</div>
	</div>

</div>
