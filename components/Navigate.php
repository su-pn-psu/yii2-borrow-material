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
class Navigate extends \firdows\menu\models\Navigate {       

    public function getCount($router) {
        $count = '';      
        $module = Url::base().'/'.Yii::$app->controller->module->id;

        switch ($router) {            

            case "{$module}/brwretrn/submitedlist":
                $searchModel = new \suPnPsu\borrowMaterial\models\BookingsubmitedSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();

                $count = $count ? Html::tag('b', ' (' . $count . ')') : '';
                break;

        }
        
        return $count;
    }

}
