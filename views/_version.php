<?php
/**
 * Created by PhpStorm.
 * User: cmmsNetAdmin
 * Date: 8/1/2559
 * Time: 20:10
 */
use yii\helpers\Url;
use yii\bootstrap\Html;

$test = Url::remember(Url::current());
//echo $test;
?>
<style>
    legend{
        margin-bottom: 5px;
        font-size: 16px;
    }
</style>
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="text-center">
        <strong>application version 2.0.0</u></strong> <?= Html::icon('menu-left'); ?> <strong>1.0.1</strong> <a id="blink" data-original-title="ปิดการแจ้งเตือน 30 วัน" data-toggle="tooltip" href="<?php echo Url::toRoute('/itinfo/default/setvercookies'); //echo Yii::$app()->baseUrl.'/cmmslib/default/setvercookies' ?>" class="alert-link text-danger glyphicon glyphicon-off"></a>
    </div>
    <fieldset>
        <legend><?php echo Html::icon('warning-sign'); ?> version 2.0.0</legend>
        <ul>
            <li>ปรับปรุงโครงสร้างใหม่</li>
            <li>เพิ่มหน้าแรก</li>
            <li>เพิ่มส่วนของการค้นหาและสรุปข้อมูล</li>

            <!--
            <li>แก้ไขชื่อระบบ</li>
            -->
        </ul>
    </fieldset>
	 <div class="text-center">
        <a id="startButton" class="btn btn-large btn-success" href="javascript:void(0);">Show me</a>
    </div>
</div>
<script>
    function blinker() {  $('#blink').fadeOut(500).fadeIn(500); }
    setInterval(blinker, 1000);
</script>