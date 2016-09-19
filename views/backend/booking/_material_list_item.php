<?php
use yii\helpers\Html;
use yii\web\View;
?>
<?php
$session = Yii::$app->session;
$disableButton = false;
$selectedItem = ($session->get('selected-material') == null)?[]:$session->get('selected-material');
if(array_key_exists($model->id, $selectedItem)){
	$disableButton = true;
}
?>
<div class="col-sm-6 col-md-4">
	<div class="thumbnail">
		<!--<img alt="" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;" src="111.jpg" data-holder-rendered="true">-->
		<?php echo Html::img($model->image,['style' => 'height: 200px; width: 100%; display: block;', 'data' => ['holder-rendered' => 'true']]); ?>
		<div class="caption">
			<h3><?= $model->title; ?></h3>
			<p>
			</p> 
			<p>
				<?= Html::a(
					'เลือก',
					['ajax-select-material'],
					[
						'class'=>'btn btn-primary btn-add-item',
						'role'=>'button',
						'data-item_id' => $model->id,
						'disabled' => $disableButton
					]
				);
				?>
			</p>
		</div>
	</div>
</div>
<?php
$this->registerJs("
$('.btn-add-item').on('click', function(event){
		event.preventDefault();//alert('iopipi');
		$.ajax({
			url: $(this).attr('href'),
			data:{'id': $(this).data('item_id')},
			dataType: 'json',
			success: function(data){
				if(data.status == 2){
					alert('มึงแลือกไว้แล้ว ฟาาาย...');
				}else if(data.status == 1){
					//location.reload();
					$.pjax.reload({container:'#itempjax'});
				}
			}
		});
	});
", View::POS_END);
?>