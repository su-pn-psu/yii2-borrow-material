<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\StdBelongtoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="std-belongto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'saveby') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::icon('search').' '.Yii::t('borrowreturn/app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Html::icon('refresh').' '.Yii::t('borrowreturn/app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
