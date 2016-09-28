<?php
use yii\bootstrap\Html;
?>
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
    <div class="col-md-10 col-md-offset-2"><p>
            <?php
            echo $mdluser->profile->attributeLabels()['user_id'].' <u>'.$mdlbooking->user->profile->user_id.'</u> ';
            echo $mdluser->profile->attributeLabels()['firstname'].' <u>'.$mdlbooking->user->profile->firstname.'</u> ';
            echo $mdluser->profile->attributeLabels()['lastname'].' <u>'.$mdlbooking->user->profile->lastname.'</u> ';
            ?>
        </p></div>
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