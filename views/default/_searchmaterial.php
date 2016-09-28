<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model suPnPsu\material\models\MaterialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-search">

    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method' => 'get',
        'layout' => 'horizontal',
        'id' => 'qsearch',
    ]); ?>
    <div class="input-group">
        <input type="text" id="mSearch" name="MaterialAvailableSearch[brand]" class="form-control" placeholder="ค้นหาพัสดุ/ครุภัณฑ์...">
    <span class="input-group-btn">
    <button class="btn btn-default" type="submit">ค้นหา</button>
    </span>
    </div>
    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJs("
/*$('form#qsearch').on('submit', function(event){
    var input = $('#mSearch');
    //window.history.pushState('', 'Title', '?'+input.attr('name)+'='+input.val());
    //return false;
    //alert($(this).serialize());
    //$.pjax.reload({container:'#itempjax'});
    $('#modal').modal('hide');
    return false;
//	var form = $(this);
//	$.post(
//		form.attr('action'),
//		form.serialize()
//	).done(function(result){
//		if(result == 1){
//			form.trigger('reset');
//			$.pjax.reload({container:'#itempjax'});
//			$('#modal').modal('hide');
//		}else{
//			alert(result);
//		}
//	}).fail(function(result){
//		alert('server error');
//	});

});*/

//$('form#qsearch').on('submit', function(event){
$(document).on('submit', '#qsearch', function (event) {
		//event.preventDefault();//alert('astyutyu');
		//$.pjax.defaults.scrollTo = false;
		$.pjax.submit(event, '#itempjax');
		$('#modal').modal('hide');
		return false;
		/*var input = $(this).find('#mSearch');
		var urlSearch = '?'+input.attr('name')+'='+input.val();
		$.ajax({
			url: urlSearch,
			success: function(){
				$.pjax.reload({container:'#itempjax'});
		        alert('aaaaaaaaaa');
			}
		});*/
	});
", View::POS_END);
    ?>
</div>
