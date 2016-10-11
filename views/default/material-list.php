<?php

use yii\bootstrap\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use suPnPsu\material\models\Material;
use yii\widgets\Pjax;
?>

<?php

Pjax::begin([
    'id' => 'room-list',
    'enablePushState' => false,
]);
?> 
<?=

GridView::widget([
    //'id' => 'kv-grid-demo',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
            [
            'content' => function($model) {
                return Html::tag('div', Html::img(['/uploads/material_files/' . $model->image], ['style' => 'width: 100%;']), ['style' => 'overflow: hidden;height:60px;width: 100px;']);
            }
        ],
            [
            'attribute' => 'code',
        ],
            [
            'attribute' => 'title',
        ],
        'brand',
            [
            'content' => function($model) {
                return Html::button('เลือก', ['value' => $model->id, 'class' => 'btn select_material', 'data-key' => $model->id]);
            }
        ],
    ],
    'tableOptions' => ['class' => 'table table-striped'],
]);
?>

<?php Pjax::end(); ?>  