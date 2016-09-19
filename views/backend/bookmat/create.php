<?php

use yii\bootstrap\Html;


/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Bookingmaterial */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrowreturn/app', 'Bookingmaterials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookingmaterial-create">

    <div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title"><?= Html::icon('edit').' '.Html::encode($this->title) ?></span>
			<?= Html::a( Html::icon('list-alt').' '.Yii::t('borrowreturn/app', 'entry'), ['index'], ['class' => 'btn btn-success panbtn']) ?>
		</div>
		<div class="panel-body">
		 <?= $this->render('_form', [
			  'model' => $model,
		 ]) ?>
		</div>
	</div>

</div>
