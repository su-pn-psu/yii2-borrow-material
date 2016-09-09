<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\BookingmaterialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bookingmaterial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'booking_id') ?>

    <?= $form->field($model, 'material_id') ?>

    <?= $form->field($model, 'return_condition') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('search').' '.Yii::t('borrowreturn/app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Html::icon('refresh').' '.Yii::t('borrowreturn/app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
