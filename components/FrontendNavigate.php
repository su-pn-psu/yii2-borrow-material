<<<<<<< HEAD
<?php

namespace suPnPsu\borrowMaterial\components;

//use yii\base\Model;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * Description of navigate
 *
 * @author madone
 */
class FrontendNavigate extends \firdows\menu\models\Navigate {

    public function getCount($router) {
        $count = '';      
        $module = Url::base().'/'.Yii::$app->controller->module->id;

        switch ($router) {            

            case "{$module}/default/draft":
                $searchModel = new \suPnPsu\borrowMaterial\models\DraftSearch(['user_id'=> Yii::$app->user->id]);
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;

            case "{$module}/default/submited":
                $searchModel = new \suPnPsu\borrowMaterial\models\SubmitedcheckSearch(['user_id'=> Yii::$app->user->id]);
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;
            case "{$module}/default/approved":
                $searchModel = new \suPnPsu\borrowMaterial\models\SentcheckSearch(['user_id'=> Yii::$app->user->id]);
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;
            case "{$module}/default/returned":
                $searchModel = new \suPnPsu\borrowMaterial\models\ReturnedcheckSearch(['user_id'=> Yii::$app->user->id]);
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;

        }
        
        return $count;
    }

}
=======
<?php

namespace suPnPsu\borrowMaterial\components;

//use yii\base\Model;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * Description of navigate
 *
 * @author madone
 */
class FrontendNavigate extends \firdows\menu\models\Navigate {

    public function getCount($router) {
        $count = '';      
        $module = Url::base().'/'.Yii::$app->controller->module->id;

        switch ($router) {            

            case "{$module}/brwretrn/submitedlist":
                $searchModel = new \suPnPsu\borrowMaterial\models\BookingsubmitedSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;

        }
        
        return $count;
    }

}
>>>>>>> origin/master
