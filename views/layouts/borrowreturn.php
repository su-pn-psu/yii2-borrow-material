<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;
use kartik\widgets\Growl;
//use kartik\nav\NavX;

//Yii::$app->formatter->locale = 'th-TH';

AppAsset::register($this);

$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});;
/* To initialize BS3 popovers set this below */
$(function () { 
    $("[data-toggle='popover']").popover(); 
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	 <?php
	 $this->registerCss("
		.wrap > .container {
			 padding: 0px 15px 20px;
		}
		.cmmslogo{
			align-content: left;
			width: 45px;
			padding: 3px;
		}
		.navtablelogo{
			float:right;
		}
		.navbar-brand {
			 padding: 2px 15px;
		}
		.navbar-brand > img {
			 display: inline;
		}
		.breadcrumb>li+li:before {
            content:\"»\";
        }or:#fff;
		}
		/* PADDING VERTICAL */
		.padding-v-xxs {
		padding-top: 5px;
		padding-bottom: 5px;
		}
		.padding-v-xs {
		padding-top: 10px;
		padding-bottom: 10px;
		}
		.padding-v-base {
		padding-top: 15px;
		padding-bottom: 15px;
		}
		.padding-v-md {
		padding-top: 20px;
		padding-bottom: 20px;
		}
		.padding-v-lg {
		padding-top: 30px;
		padding-bottom: 30px;
		}
		.line {
		width: 100%;
		height: 2px;
		margin: 10px 0;
		overflow: hidden;
		font-size: 0;
		}
		.line-xs {
		margin: 0;
		}
		.line-lg {
		margin-top: 15px;
		margin-bottom: 15px;
		}
		.line-dashed {
		background-color: transparent;
		border-bottom: 1px dashed #dee5e7 !important;
		}
		div.required label:after{
			content: \" *\";
			color: red;
		}
		.panbtn{
			float:right;
			margin: -5px 5px 0px 0px;
		}
		.media a{
			color: black;
			text-decoration: none;
		}
		.media {
			padding: 5px;
		}
		.media:hover {
          background-color: #f5f5f5;
        }
		.media img.avatar {
			width: 64px;
			height: 64px;
		}
		.navbar-default .btn-link {
            color: #333;
            padding: 3px 20px;
            text-decoration: none;
        }
		.form-group {
			margin-bottom: 5px;
		}
	 ");
	 ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php $moduleID = \Yii::$app->controller->module->id; 
		//print_r($module->id);
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="cmmslogo" alt="Brand" src="'.Yii::getAlias('@web/media/parallax/img/commsci_logo_black.png').'">'.'<table class="navtablelogo"><tbody>
		  <tr><td>'.Yii::t( 'app', 'itinfomodshort').' '.Html::icon('tree').' <code> V.'.Yii::$app->controller->module->params['ModuleVers'].'</code>'.'</td></tr>
		  <tr style="font-size: small;"><td>'.Yii::t( 'app', 'itinfomod').'</td></tr>
		  </tbody></table>',
        'brandUrl' => Url::toRoute('/'.$moduleID),
        'innerContainerOptions' => ['class'=>'container-fluid'],
		'options' => [
            'class' => 'navbar-default',
        ],
    ]);
    $menuItems = [
        [
			'label' =>  Html::Icon('check').' '.Yii::t( 'app', 'approvingmenu')
                        .' '.(1 ? Html::tag('span', '3', ['class' => 'badge']) : false),
			'url' => ['#'],
			'items' => [
				//['label' => Html::Icon('scissors').' '.Yii::t( 'app', 'equipment'), 'url' => ['wru/create']],
                ['label' => Html::Icon('scissors').' '.Yii::t( 'app', 'equipment')],
                ['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'approving'), 'url' => ['/borrowreturn/brwretrn/submitedlist']],
                ['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'delevering & returning'), 'url' => ['/borrowreturn/wru']],
                '<li class="divider"></li>',
                //['label' => Html::Icon('map-marker').' '.Yii::t( 'app', 'meetingroom'), 'url' => ['wru/create']],
                ['label' => Html::Icon('scissors').' '.Yii::t( 'app', 'meetingroom')],
                ['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'approving'), 'url' => ['/borrowreturn/wru/create']],
                ['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'delevering & returning'), 'url' => ['/borrowreturn/wru']],
                '<li class="divider"></li>',
                //['label' => Html::Icon('transfer').' '.Yii::t( 'app', 'tricycle'), 'url' => ['wru/create']],
                ['label' => Html::Icon('scissors').' '.Yii::t( 'app', 'tricycle')],
                ['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'approving'), 'url' => ['/borrowreturn/wru/create']],
                ['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'delevering & returning'), 'url' => ['/borrowreturn/wru']],
                //'<li class="divider"></li>',
            ]
		],
        [
			'label' => 	Html::Icon('tasks').' '.Yii::t( 'app', 'manage'),
			'url' => ['#'],
			'items' => [
				['label' => Html::Icon('user').' '.Yii::t( 'app', 'wasterecycleUser')],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'add'), 'url' => ['/borrowreturn/wru/create']],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'index'), 'url' => ['/borrowreturn/wru']],
				'<li class="divider"></li>',
				['label' => Html::Icon('sort-by-alphabet').' '.Yii::t( 'app', 'wasterecycleType')],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'add'), 'url' => ['/borrowreturn/wrt/create']],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'index'), 'url' => ['/borrowreturn/wrt']],
				'<li class="divider"></li>',
				['label' => Html::Icon('play').' '.Yii::t( 'app', 'wasterecycleEntry')],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'add'), 'url' => ['/borrowreturn/wre/create']],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'index'), 'url' => ['/borrowreturn/wre']],
				'<li class="divider"></li>',
				['label' => Html::Icon('forward').' '.Yii::t( 'app', 'wasterecycleDetail')],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'add'), 'url' => ['/borrowreturn/wrd/create']],
				['label' => Html::Icon('menu-right').' '.Yii::t( 'app', 'index'), 'url' => ['/borrowreturn/wrd']],
				//'<li class="divider"></li>',
				/*['label' => 'Submenu 2',
					'items' => [
					['label' => 'Action', 'url' => '#'],
					['label' => 'Another action', 'url' => '#'],
					['label' => 'Something else here', 'url' => '#'],
					'<li class="divider"></li>',
					['label' => 'Separated link', 'url' => '#'],
				]
				],*/
			]
		],
        ['label' => Html::Icon('stats').' '.Yii::t( 'app', 'summery'), 'url' => ['default/summary']],
		['label' => Html::Icon('question-sign').' '.Yii::t( 'app', 'intro'), 'url' => ['default/summary']],
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => Yii::t( 'app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Html::Icon('log-in').' '.Yii::t( 'app', 'Login'), 'url' => ['/site/login']];
    } else {
        /*$menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                Html::Icon('log-out').' '.Yii::t( 'app', 'Logout').' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';*/
        $menuItems[] = [
            'label' => Html::Icon('qrcode').' '.Yii::t( 'app', 'login as').' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/login'],
            'items' => [
                ['label' => Html::Icon('user').' '.Yii::t( 'app', 'userprofile'), 'url' => ['wru/create']],
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Html::Icon('log-out').' '.Yii::t( 'app', 'Logout'),
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>',
            ]
        ];
    }
//    echo NavX::widget([
//        'options' => ['class' => 'navbar-nav navbar-left'],
//        'encodeLabels' => false,
//		'items' => $menuItems,
//    ]);
    NavBar::end();
    ?>

	<div class="container-fluid">
	<?php 
	$cookies = Yii::$app->request->cookies;
	
	if (($cookie = $cookies->get('itmdlvers')) !== null) {
		if($cookie->value != Yii::$app->controller->module->params['ModuleVers']){
		  $delcookies = Yii::$app->response->cookies;
		  $delcookies->remove('itmdlvers');
		}
	}else{
		echo $this->render('/_version');
	}
	//echo \Yii::$app->controller->module->params['ModuleVers'];
	?>
	
        <?= Breadcrumbs::widget([
			'encodeLabels' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				'homeLink' => [
					'label' => Html::Icon('home'),
					'url' => Url::toRoute('/'.$moduleID),
					],
        ]) ?>
		
		<?php foreach (Yii::$app->session->getAllFlashes() as $message):; //Get all flash messages and loop through them ?>
            <?php
            echo Growl::widget([
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

		<div class="row">
			<div class="col-md-3 hidden-print">
                <?= Html::a(Html::icon('tag').' '.Yii::t( 'app', 'data'), ['/repair/default/create'], ['class' => 'btn btn-success btn-block margin-bottom']) ?>
                <?= Html::a(Html::icon('scissors').' '.Yii::t( 'app', 'eqbookshort'), ['/borrowreturn/booking'], ['class' => 'btn btn-primary btn-block']) ?>
                <?= Html::a(Html::icon('map-marker').' '.Yii::t( 'app', 'roombookshort'), ['#'], ['class' => 'btn btn-primary btn-block']) ?>
                <?= Html::a(Html::icon('transfer').' '.Yii::t( 'app', 'tribookshort'), ['#'], ['class' => 'btn btn-primary btn-block margin-bottom']) ?>

                <?php
					 
                if(isset($this->blocks['eqmenu'])){
                    echo $this->blocks['eqmenu'];
                }
                ?>
                <!--<div class="box box-solid">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title"> ระบบยืม-คืนพัสดุ</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">-->

                        <?php
                        //$nav = new Navigate();
                        //echo dmstr\widgets\Menu::widget([
                        /*echo Nav::widget([
                            'options' => ['class' => 'nav nav-pills nav-stacked'],
                            'encodeLabels' => false,
                            //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                            //'items' => $nav->menu(4),
                            'items' => [
                                [
                                    'label' => Html::icon('file').' '.Yii::t( 'app', 'ฟอร์มที่ร่าง'),
                                    'url' => ['site/index'],
                                ],
                                [
                                    'label' => Html::icon('inbox').' '.Yii::t( 'app', 'รายการยื่นเสนอ'),
                                    'url' => ['site/index'],
                                ],
                                [
                                    'label' => Html::icon('saved').' '.Yii::t( 'app', 'ผลการพิจารณา'),
                                    'url' => ['site/index'],
                                ],
                                [
                                    'label' => Html::icon('export').' '.Yii::t( 'app', 'รายการที่ยืมอยู่'),
                                    'url' => ['site/index'],
                                ],
                                [
                                    'label' => Html::icon('import').' '.Yii::t( 'app', 'รายการที่คืน'),
                                    'url' => ['site/index'],
                                ],
                                [
                                    'label' => Html::icon('duplicate').' '.Yii::t( 'app', 'รายการแจ้งยืมทั้งหมด'),
                                    'url' => ['site/index'],
                                    //'linkOptions' => [...],
                                ],
                            ],
                        ]*/
                        ?>

                <!-- </div>
                  /.box-body
                </div>-->
			</div>
			<div class="col-md-9">
			    <?= $content ?>
			</div>
		</div>
    </div>
</div>

<footer class="footer">
    <div class="container">
     <p>
		<?php echo '  '.Yii::t( 'app', 'footer_problem'); ?> :  <?php echo Yii::$app->formatter->asEmail(Yii::t( 'app', 'adminEmail'));  ?> <?php echo Yii::t( 'app', 'adminName'); ?></a><?php echo ' '.Yii::t( 'app', 'adminfooterIntercom'); ?>
		<a href="#" data-toggle="tooltip" title="<?php echo Yii::t( 'app', 'responsive_web'); ?>"><img src="<?php echo Yii::getAlias('@web/media/adzpireImages/responsive-icon.png'); ?>" width="30" height="30" /></a>
		<?php //$time = time(); echo Yii::$app->formatter->asDate($time, 'long'); ?>
		</p>
    </div>
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
