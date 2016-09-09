<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\BookingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'entry_status') ?>

    <?= $form->field($model, 'booking_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'belongto_id') ?>

    <?php // echo $form->field($model, 'position_id') ?>

    <?php // echo $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'isin_university') ?>

    <?php // echo $form->field($model, 'university_place') ?>

    <?php // echo $form->field($model, 'acquire_at') ?>

    <?php // echo $form->field($model, 'return_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('search').' '.Yii::t('borrowreturn/app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Html::icon('refresh').' '.Yii::t('borrowreturn/app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
