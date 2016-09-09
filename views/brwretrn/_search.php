<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\borrowreturn\models\BorrowreturnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrowreturn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'booking_id') ?>

    <?= $form->field($model, 'confirm_status') ?>

    <?= $form->field($model, 'confirm_comment') ?>

    <?= $form->field($model, 'confirm_staff_id') ?>

    <?= $form->field($model, 'confirm_at') ?>

    <?php // echo $form->field($model, 'deliver_status') ?>

    <?php // echo $form->field($model, 'deliver_staff_id') ?>

    <?php // echo $form->field($model, 'deliver_at') ?>

    <?php // echo $form->field($model, 'return_status') ?>

    <?php // echo $form->field($model, 'return_loss') ?>

    <?php // echo $form->field($model, 'return_because') ?>

    <?php // echo $form->field($model, 'return_staff_id') ?>

    <?php // echo $form->field($model, 'return_at') ?>

    <?php // echo $form->field($model, 'entry_note') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('search').' '.Yii::t('borrowreturn/app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Html::icon('refresh').' '.Yii::t('borrowreturn/app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
