<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrow-material', 'รายการจองพัสดุ/ครุภัณฑ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-view">

<div class="panel panel-success">
	<div class="panel-heading">
		<span class="panel-title"><?= Html::icon('eye').' '.Html::encode($this->title) ?></span>
		<?php
		if($mdlbooking->entry_status < 2){
			echo Html::a( Html::icon('fire').' '.Yii::t('borrow-material', 'ลบ'), ['delete', 'id' => $mdlbooking->id], [
				'class' => 'btn btn-danger panbtn',
				'data' => [
					'confirm' => Yii::t('borrow-material', 'คุณแน่ใจว่าต้องการลบรายการนี้?'),
					'method' => 'post',
				],
			]);
			echo Html::a( Html::icon('pencil').' '.Yii::t('borrow-material', 'ปรับปรุงข้อมูล'), ['update', 'id' => $mdlbooking->id], ['class' => 'btn btn-primary panbtn']);
		}
		 ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-1 col-md-offset-1">
				<?php //Yii::getAlias('@uploads/material_files/')
				echo Html::img('/uploads/images/PSU.png',['width' => '75px']);
				?>
			</div>
			<div class="col-md-8 text-center">
				<h3>แบบฟอร์มการขออนุมัติยืมใช้พัสดุ-ครุภัณฑ์ ปีการศึกษา 2559</h3>
				<h4>องค์การบริหาร องค์การนักศึกษา มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตปัตตานี</h4>
			</div>
			<div class="col-md-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-9"><p>
					<?php echo 'วันที่ '.Yii::$app->formatter->asDate($mdlbooking->create_at, 'long');  ?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
					<?php
//					echo $mdluser->profile->attributeLabels()['user_id'].' <u>'.$mdlbooking->user->profile->user_id.'</u> ';
//					echo $mdluser->profile->attributeLabels()['firstname'].' <u>'.$mdlbooking->user->profile->firstname.'</u> ';
//					echo $mdluser->profile->attributeLabels()['lastname'].' <u>'.$mdlbooking->user->profile->lastname.'</u> ';
					?>
				<p>

					ข้าพเจ้า
                    <u><?= $mdlbooking->user->profile->fullname; ?></u>

					รหัสศึกษา
					<u><?= $mdlbooking->user->username; ?></u>

					สาขาวิชา
                    <u><?= $mdlbooking->user->profile->resultInfo->major; ?></u>

					คณะ
                    <u><?= $mdlbooking->user->profile->resultInfo->factory; ?></u>

				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-11 col-md-offset-1"><p>
					<?php
					echo $mdlbooking->attributeLabels()['belongto_id'].' <u>'.$mdlbooking->belongto->title.'</u> ';
					echo $mdlbooking->attributeLabels()['position_id'].' <u>'.$mdlbooking->position->title.'</u> ';
					?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-11 col-md-offset-1"><p>
					<?php
					echo $mdlbooking->attributeLabels()['purpose'].' <u>'.$mdlbooking->purpose.'</u> ';
					?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-11 col-md-offset-1"><p>
					<?php
					echo $mdlbooking->attributeLabels()['isin_university'].' <u>'.$mdlbooking->isinlist[$mdlbooking->isin_university].'</u> ';
					echo $mdlbooking->attributeLabels()['university_place'].' <u>'.$mdlbooking->university_place.'</u> ';
					?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2"><p>
					<?php
					echo $mdlbooking->attributeLabels()['booking_at'].' <u>'.Yii::$app->formatter->asDatetime($mdlbooking->booking_at).'</u> ';
					?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2"><p>
					<?php
					echo $mdlbooking->attributeLabels()['acquire_at'].' <u>'.Yii::$app->formatter->asDatetime($mdlbooking->acquire_at).'</u> ';
					?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2"><p>
					<?php
					echo $mdlbooking->attributeLabels()['return_at'].' <u>'.Yii::$app->formatter->asDatetime($mdlbooking->return_at).'</u> ';
					?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-11 col-md-offset-1"><p>
					<?php echo $mdlbooking->promisetext; ?>
				</p></div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-2 text-center">
				<p style="padding-top:50px;"></p>
				<p>ลงชื่อ ................... ผู้ขอยืม</p>
				<?php
				echo '<p>'.$mdlbooking->user->profile->firstname.' '.$mdlbooking->user->profile->lastname.'</p>';
				echo '<p>'.$mdlbooking->attributeLabels()['position_id'].' '.$mdlbooking->position->title.'</p>';
				echo 'วันที่ '.Yii::$app->formatter->asDate($mdlbooking->create_at, 'long');
				?>
			</div>
			<div class="col-md-4 col-md-offset-2 text-center">

				<?php
				if(isset($mdlbooking->borrowreturn->confirm_status)) {

					echo '<p>';
					echo $mdlbooking->borrowreturn->confirm_status==1 ? '&#x2611; อนุญาต ' : '&#x2610; อนุญาต ';
					echo $mdlbooking->borrowreturn->confirm_status==0 ? ' &#x2611;  ไม่อนุญาต เพราะ...' : ' &#x2610; ไม่อนุญาต เพราะ...';
					echo '</p><p>......................</p>';
					echo '<p>ลงชื่อ ................... ผู้อนุญาต</p>';
					echo '<p>' . $mdlbooking->borrowreturn->confirmStaff->profile->firstname . ' ' . $mdlbooking->borrowreturn->confirmStaff->profile->lastname . '</p>';
					echo '<p>' . $mdlbooking->borrowreturn->attributeLabels()['position_id'] . ' ' . $mdlbooking->position->title . '</p>';
					echo 'วันที่ ' . Yii::$app->formatter->asDate($mdlbooking->borrowreturn->confirm_at, 'long');

				}else{
					echo '<p style="padding-top:40px;"></p><p>ลงชื่อ ....................... ผู้อนุญาต</p>';
					echo '<p>.......................</p>';
					echo '<p>....................... </p>';
					echo 'วันที่ ....................... ';
				}
				?>
			</div>
		</div>
        <div class="row">
            <?php
            if(isset($mdlbooking->borrowreturn->deliver_status)) {

                echo '<p>';
                echo $mdlbooking->borrowreturn->deliver_status==1 ? '&#x2611; ส่ง ' : '&#x2610; ส่ง ';
                echo $mdlbooking->borrowreturn->deliver_status==0 ? ' &#x2611;  ไม่ส่ง' : ' &#x2610; ไม่ส่ง';
                echo '</p><p>......................</p>';
                echo '<p>ลงชื่อ ................... ผู้อนุญาต</p>';
                echo '<p>' . $mdlbooking->borrowreturn->confirmStaff->profile->firstname . ' ' . $mdlbooking->borrowreturn->confirmStaff->profile->lastname . '</p>';
                echo '<p>' . $mdlbooking->borrowreturn->attributeLabels()['position_id'] . ' ' . $mdlbooking->position->title . '</p>';
                echo 'วันที่ ' . Yii::$app->formatter->asDate($mdlbooking->borrowreturn->confirm_at, 'long');

            }
            ?>
        </div>
	</div>
</div>
</div>