<?php

use yii\bootstrap\Html;


/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Borrowreturn */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Borrowreturns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowreturn-create">

    <div class="panel panel-primary">
		<div class="panel-heading">
			<span class="panel-title"><?= Html::icon('edit').' '.Html::encode($this->title) ?></span>
			<?= Html::a( Html::icon('list-alt').' '.Yii::t('app', 'entry'), ['index'], ['class' => 'btn btn-success panbtn']) ?>
		</div>
		<div class="panel-body">
        <?= $this->render('_bookingdetail', [
            'mdluser' => $mdluser,
            'mdlbooking' => $mdlbooking,
        ]) ?>
            <div class="row">
                <div class="col-md-4 col-md-offset-2">
                    <p style="padding-top:50px;"></p>
                    <p>ลงชื่อ ................... ผู้ขอยืม</p>
                    <?php
                    echo '<p>'.$mdlbooking->user->profile->firstname.' '.$mdlbooking->user->profile->lastname.'</p>';
                    echo '<p>'.$mdlbooking->attributeLabels()['position_id'].' '.$mdlbooking->position->title.'</p>';
                    echo 'วันที่ '.Yii::$app->formatter->asDate($mdlbooking->create_at, 'long');
                    ?>
                </div>
                <div class="col-md-4 col-md-offset-2">

                    <?php
                    if($this->context->action->id == 'submitborrow') {
                        echo '<p style="padding-top:40px;"></p><p>ลงชื่อ ................... ผู้อนุญาต</p>';
                        echo '<p>'.$mdlbooking->user->profile->firstname.' '.$mdlbooking->user->profile->lastname.'</p>';
                        echo '<p>'.$mdlbooking->attributeLabels()['position_id'].' ....................... </p>';
                        echo 'วันที่ ....................... ';
                    }elseif($this->context->action->id == 'submitsend' || $this->context->action->id == 'submitreturn'){
                        echo '<p>';
                        echo $model->confirm_status==1 ? '&#x2611; อนุญาต ' : '&#x2610; อนุญาต ';
                        echo $model->confirm_status==0 ? ' &#x2611;  ไม่อนุญาต เพราะ...' : ' &#x2610; ไม่อนุญาต เพราะ...';
                        echo '</p><p>......................</p>';
                        echo '<p>ลงชื่อ ................... ผู้อนุญาต</p>';
                        echo '<p>' . $model->confirmStaff->profile->firstname . ' ' . $model->confirmStaff->profile->lastname . '</p>';
                        echo '<p>' . $model->attributeLabels()['position_id'] . ' ' . $mdlbooking->position->title . '</p>';
                        echo 'วันที่ ' . Yii::$app->formatter->asDate($model->confirm_at, 'long');
                    }
                    ?>
                </div>
                <?php
                if($this->context->action->id == 'submitreturn'){
                    echo '<div class="col-md-7 col-md-offset-5"><p>';
                    echo $model->deliver_status==1 ? '&#x2611; ส่ง ' : '&#x2610; ส่ง ';
                    echo $model->deliver_status==0 ? ' &#x2611;  ไม่ส่ง' : ' &#x2610; ไม่ส่ง';
                    echo '<p> ผู้ส่ง ' . $model->confirmStaff->profile->firstname . ' ' . $model->confirmStaff->profile->lastname.'</p>' ;
                    echo '<p> วันที่ ' . Yii::$app->formatter->asDate($model->confirm_at, 'long'). ' </p></div>';
                }
                ?>

            </div>
		 <?= $this->render('_form', [
			  'model' => $model,
			  //'mdlbooking' => $mdlbooking,
		 ]) ?>
		</div>
	</div>

</div>
