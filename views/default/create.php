<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */

$this->title = 'ร่างแบบฟอร์ฺมการยืมพัสดุ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รายการยืมพัสดุ/ครุภัณฑ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">


    <?php
    $session = Yii::$app->session;
    $items = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');
    ?>
    <div class="box-body">
        <?=
        $this->render('_form', [
            'model' => $model,
            'mdluser' => $mdluser,
            'belongtolist' => $belongtolist,
            'positionlist' => $positionlist,
            'items' => $items,
        ])
        ?>
    </div>

</div>
