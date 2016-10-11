<?php

use yii\bootstrap\Html;
use mdm\admin\components\Helper;
use yii\helpers\Url;
?>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        //'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'center',
            ]
        ]
    ]);
    ?>
<?php endforeach;
$module = $this->context->module->id;

$this->beginContent('@app/views/layouts/main.php'); ?>

<div class="row">
    <div class="col-md-3 hidden-print">


        <?php if (Yii::$app->user->can('user')): ?>
            <div class="panel panel-default sidebar-menu">

                <div class="panel-heading">
                    <h3 class="panel-title">ระบบยืม-คืนพัสดุครุภัณฑ์</h3>
                    
                </div>

                <div class="panel-body">  
                    <p><a href="<?=Url::to(["/{$module}/default/create"])?>" class="btn btn-success btn-block"><i class="fa fa-plus"></i> ขอยืมพัสดุ</a></p>

                    <?php
                    $menuItems = [
                            [
                            'label' => Html::icon('cloud-upload') . ' ' . Yii::t('borrow-material', 'แบบฟอร์มที่ยังไม่ยื่น'),
                            'url' => ['/borrow-material/default/draft'],
                        ],
                            [
                            'label' => Html::icon('inbox') . ' ' . Yii::t('app', 'รออนุมัติ'),
                            'url' => ['/borrow-material/default/submited'],
                        ],
                            [
                            'label' => Html::icon('export') . ' ' . Yii::t('app', 'ยังไม่มารับ'),
                            'url' => ['/borrow-material/default/approved'],
                        ],
                            [
                            'label' => Html::icon('import') . ' ' . Yii::t('app', 'ยังไม่ส่งคืน'),
                            'url' => ['/borrow-material/default/returned'],
                        ],
                            [
                            'label' => Html::icon('duplicate') . ' ' . Yii::t('app', 'ข้อมูลทั้งหมด'),
                            'url' => ['/borrow-material/default/all'],
                        //'linkOptions' => [...],
                        ],
                    ];

                    $menuItems = Helper::filter($menuItems);
                    $menuItems = suPnPsu\borrowMaterial\components\FrontendNavigate::genCount($menuItems);
                    
                    //$nav = new Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        'encodeLabels' => false,
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $menuItems,
                    ])
                    ?>
                </div>
            </div>



        <?php endif; ?>

    </div>
    <!-- /.col -->


    <div class="col-md-9">
        <?php
        $this->registerCss(".panbtn { float: right; margin: -5px 5px 0px 0px; }");
        ?>
        <?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->


</div>


<?php $this->endContent(); ?>