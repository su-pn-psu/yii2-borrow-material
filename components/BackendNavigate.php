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
class BackendNavigate extends \firdows\menu\models\Navigate {

    public function getCount($router) {
        $count = '';
        $module = Url::base() . '/' . Yii::$app->controller->module->id;
//        echo $module . "<br/>";
//        echo $router;
//        exit();

        switch ($router) {

            case "{$module}/staff/submitedlist":
                $searchModel = new \suPnPsu\borrowMaterial\models\BookingsubmitedSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span', $count, ['class' => 'label label-warning pull-right']) : '';
                break;

            case "{$module}/staff/approvedlist":
                $searchModel = new \suPnPsu\borrowMaterial\models\BookingapprovedSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span', $count, ['class' => 'label label-warning pull-right']) : '';
                break;

            case "{$module}/staff/sentlist":
                $searchModel = new \suPnPsu\borrowMaterial\models\BookingsentSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span', $count, ['class' => 'label label-warning pull-right']) : '';
                break;
        }

        return $count;
    }

}
