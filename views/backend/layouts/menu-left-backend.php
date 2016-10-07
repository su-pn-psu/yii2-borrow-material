<?php
use yii\bootstrap\Html;
use mdm\admin\components\Helper;
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
<?php endforeach; ?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>

    <div class="row">
        <div class="col-md-3 hidden-print">


            <?php
            if(Yii::$app->user->can('staff')): ?>


                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php /* =BaseStringHelper::truncate($this->title,20); */ ?>
                            สำหรับเจ้าหน้าที่
                        </h3>

                    </div>
                    <div class="box-body no-padding">

                        <?php





                        $menuItems = [
                            [
                                'label' => Html::icon('file').' '.Yii::t( 'borrow-material', 'draftform'),
                                'url' => ['site/index'],
                            ],
                            [
                                'label' => Html::icon('inbox').' '.Yii::t( 'app', 'รออนุมัติ'),
                                'url' => ['/borrow-material/brwretrn/submitedlist'],
                            ],
                            [
                                'label' => Html::icon('saved').' '.Yii::t( 'app', 'approve'),
                                'url' => ['site/index'],
                            ],
                            [
                                'label' => Html::icon('export').' '.Yii::t( 'app', 'borrowed'),
                                'url' => ['site/index'],
                            ],
                            [
                                'label' => Html::icon('import').' '.Yii::t( 'app', 'returned'),
                                'url' => ['site/index'],
                            ],
                            [
                                'label' => Html::icon('duplicate').' '.Yii::t( 'app', 'allborrow'),
                                'url' => ['site/index'],
                                //'linkOptions' => [...],
                            ],
                        ];

                        $menuItems = Helper::filter($menuItems);
                        $menuItems = suPnPsu\borrowMaterial\components\BackendNavigate::genCount($menuItems);
                        //$nav = new Navigate();
                        echo dmstr\widgets\Menu::widget([
                            'options' => ['class' => 'nav nav-pills nav-stacked'],
                            'encodeLabels' => false,
                            //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                            'items' => $menuItems,
                        ])
                        ?>

                    </div>
                    <!-- /.box-body -->
                </div>

            <?php endif;?>
        </div>
        <!-- /.col -->


        <div class="col-md-9">
            <?= $content ?>
            <!-- /. box -->
        </div>
        <!-- /.col -->


    </div>


<?php $this->endContent(); ?>