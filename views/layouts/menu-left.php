<?php
use yii\helpers\Html;

?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>

    <div class="row">
        <div class="col-md-3 hidden-print">

            <?= Html::a('<i class="fa fa-wrench"></i> ' . Yii::t('app', 'แจ้งซ่อม'), ['/repair/default/create'], ['class' => 'btn btn-primary btn-block margin-bottom']) ?>


            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php /* =BaseStringHelper::truncate($this->title,20); */ ?>
                        ระบบแจ้งซ่อม
                    </h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">

                    <?php
//                    $nav = new Navigate();
//                    echo dmstr\widgets\Menu::widget([
//                        'options' => ['class' => 'nav nav-pills nav-stacked'],
//                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
//                        'items' => $nav->menu(4),
//                    ])
                    ?>

                </div>
                <!-- /.box-body -->
            </div>


        </div>
        <!-- /.col -->


        <div class="col-md-9">
            <?= $content ?>
            <!-- /. box -->
        </div>
        <!-- /.col -->


    </div>


<?php $this->endContent(); ?>