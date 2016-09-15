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

            <?= Html::a(Html::icon('tag').' '.Yii::t( 'app', 'data'), ['/borrow-material/allitems'], ['class' => 'btn btn-success btn-block margin-bottom']) ?>
            <?= Html::a(Html::icon('scissors').' '.Yii::t( 'app', 'eqbookshort'), ['/borrow-material/booking'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Html::icon('map-marker').' '.Yii::t( 'app', 'roombookshort'), ['#'], ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a(Html::icon('transfer').' '.Yii::t( 'app', 'tribookshort'), ['#'], ['class' => 'btn btn-primary btn-block margin-bottom']) ?>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php /* =BaseStringHelper::truncate($this->title,20); */ ?>
                        ระบบยืม-คืนพัสดุครุภัณฑ์
                    </h3>

                </div>
                <div class="box-body no-padding">

                    <?php





$menuItems = [
    [
        'label' => Html::icon('file').' '.Yii::t( 'app', 'draftform'),
        'url' => ['site/index'],
    ],
    [
        'label' => Html::icon('inbox').' '.Yii::t( 'app', 'offering'),
        'url' => ['site/index'],
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
    [
        'label' => 'Logout (' . \Yii::$app->user->identity->username . ')',
        'url' => ['/user/logout'],
        'linkOptions' => ['data-method' => 'post']
    ],
    ['label' => 'App', 'items' => [
        ['label' => 'New Sales', 'url' => ['/sales/pos']],
        ['label' => 'New Purchase', 'url' => ['/purchase/create']],
        ['label' => 'GR', 'url' => ['/movement/create', 'type' => 'receive']],
        ['label' => 'GI', 'url' => ['/movement/create', 'type' => 'issue']],
    ]]
];

$menuItems = Helper::filter($menuItems);
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


        </div>
        <!-- /.col -->


        <div class="col-md-9">
            <?= $content ?>
            <!-- /. box -->
        </div>
        <!-- /.col -->


    </div>


<?php $this->endContent(); ?>