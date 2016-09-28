<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
//use kartik\widgets\DatePicker;

use yii\web\View;

use yii\widgets\ListView;
use yii\widgets\Pjax;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\borrowreturn\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="material-search">

        <?php $form = ActiveForm::begin([
            //'action' => ['selectmat'],
            'method' => 'get',
        ]); ?>

        <?php //= $form->field($searchModel, 'brand')
            echo $form->field($searchMaterial, 'brand', [
                'horizontalCssClasses' => [
                    'label' => 'col-md-4',
                    'wrapper' => 'col-md-8',
                ],
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">'.Html::submitButton(Html::icon('search') . ' ' . 'Search', ['class' => 'btn btn-info']).'</div>',
            ])->textinput();
        ?>
    </div>
<?php ActiveForm::end(); ?>
<?php Pjax::begin(['id' => 'itempjax']); ?>
    <div class="selected-material">
        <?php
        $session = Yii::$app->session;
        $items = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');
        ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>ยี่ห้อ</th>
            </tr>
            </thead>
            <tbody>
            <?php $row = 1; ?>
            <?php foreach ($items as $key => $item) : ?>
                <tr>
                    <th scope="row"><?= $row++; ?></th>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['title']; ?></td>
                    <td><?= $item['brand']; ?></td>
                    <?php //= Html::a( Html::icon('trash'), ['ajax-clear-selected-material', 'id' => $key], ['class' => 'btn btn-danger']) ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class="form-group text-center">
        <a href="<?= Url::to(['ajax-clear-selected-material']); ?>" class="btn btn-danger btn-clear-item">เคลียร์ข้อมูลที่เลือก</a>
        <?php
        echo Html::a( Html::icon('copy').' '.Yii::t( 'app', 'กรอกข้อมูลการจอง'),'create', ['class' => 'btn btn-primary']);
        ?>
    </div>
    <div class="material-index">

        <?= ListView::widget([
            'dataProvider' => $dataProviderMaterial,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_material_list_item',
        ]) ?>
        <?php Pjax::end(); ?>
    </div>
<?php
Modal::begin([
    'header' => 'Quick Op',
    'id' => 'modal',
]);
echo '<div id ="modalcontent"></div>';
Modal::end();
?>

<?php
$this->registerJs("
$('form').on('submit', function(event){
	event.preventDefault();
	$.pjax.submit(event, '#itempjax');
	$.pjax.defaults = false;
    
});

$('.btn-clear-item').on('click', function(event){
		event.preventDefault();//alert('astyutyu');
		$.ajax({
			url: $(this).attr('href'),
			//data:{'id': $(this).data('item_id')},
			//dataType: 'json',
			success: function(){
				$.pjax.reload({container:'#itempjax'});
			}
		});
	});
", View::POS_END);
?>