<?php
use yii\bootstrap\Html;
use yii\web\View;
use yii\helpers\Url;
?>
<?php
$session = Yii::$app->session;
$disableButton = false;
$selectedItem = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');
if (array_key_exists($model->id, $selectedItem)) {
    $disableButton = true;
}
?>
    <div class="col-sm-4 col-md-3 _fixhigh">
        <div class="thumbnail">
            <!--<img alt="" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;" src="111.jpg" data-holder-rendered="true">-->

            <?php echo Html::img('/uploads/material_files/' . $model->image, ['style' => 'height: 200px; width: 100%; display: block;', 'data' => ['holder-rendered' => 'true']]); ?>
            <div class="caption">
                <h4><?= $model->title; ?> </h4>

                <p class="text-center">
                    <?php
                    if (array_key_exists($model->id, $selectedItem)) {
                        echo Html::button('เลือกแล้ว',[ 'class' => 'btn btn-default disabled',]);
                    } else {
                        echo Html::a(
                            'เลือก',
                            ['ajax-select-material'],
                            [
                                'class' => 'btn btn-primary btn-add-item',
                                'role' => 'button',
                                'data-item_id' => $model->id,
                                //'disabled' => $disableButton
                            ]
                        );
                    }

                    ?>
                    <button type="button" class="btn btn-info _qmatinfo" value="<?php echo Url::to(['qmatinfo', 'id' => $model->id]); ?>">
                        <span class="glyphicon glyphicon-info-sign"></span>
                    </button>
                </p>
            </div>
        </div>
    </div>
<?php
$this->registerCss("
._fixhigh{
    height: 330px;
    padding-right: 2px;
    padding-left: 2px;
}
");
$this->registerJs("
$('.btn-add-item').on('click', function(event){
    event.preventDefault();//alert('iopipi');
    $.ajax({
        url: $(this).attr('href'),
        data:{'id': $(this).data('item_id')},
        dataType: 'json',
        success: function(data){
            if(data.status == 2){
            }else if(data.status == 1){
                $.pjax.reload({container:'#itempjax'});
            }
        }
    });
});
$('._qmatinfo').on('click', function(event){
    event.preventDefault();
    $('#modal').modal('show')
    .find('#modalcontent')
    .load($(this).attr('value'));
        return false;//just to see what data is coming to js
});
", View::POS_END);
?>