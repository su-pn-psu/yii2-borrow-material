<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model suPnPsu\borrowMaterial\models\Booking */

$this->params['breadcrumbs'][] = ['label' => Yii::t('borrow-material', 'รายการจองพัสดุ/ครุภัณฑ์'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('borrow-material', 'ปรับปรุงข้อมูล');
?>
<div class="booking-update">

    <div class="panel panel-warning">
        <div class="panel-heading">
            <span class="panel-title"><?= Html::icon('edit') . ' ' . Html::encode($this->title) ?></span>
<<<<<<< HEAD
            <?
            if($mdlbooking->entry_status < 2) {
                echo Html::a(Html::icon('fire') . ' ' . Yii::t('borrow-material', 'ลบ'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger panbtn',
                    'data' => [
                        'confirm' => Yii::t('borrow-material', 'คุณแน่ใจว่าต้องการลบรายการนี้?'),
                        'method' => 'post',
                    ],
                ]);
                echo Html::a(Html::icon('pencil') . ' ' . Yii::t('borrow-material', 'เพิ่มการจอง'), ['create'], ['class' => 'btn btn-info panbtn']);
            }
            ?>
=======
            <?= Html::a(Html::icon('fire') . ' ' . Yii::t('borrow-material', 'ลบ'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger panbtn',
                'data' => [
                    'confirm' => Yii::t('borrow-material', 'คุณแน่ใจว่าต้องการลบรายการนี้?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Html::icon('pencil') . ' ' . Yii::t('borrow-material', 'เพิ่มการจอง'), ['create'], ['class' => 'btn btn-info panbtn']) ?>
>>>>>>> origin/master
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
                'availmatlist' => $availmatlist,
                'searchMaterial' => $searchMaterial,
                'dataProviderMaterial' => $dataProviderMaterial,
                'items' => $items,
            ]) ?>
        </div>
    </div>

</div>