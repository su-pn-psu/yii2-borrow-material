<?php

namespace suPnPsu\borrowMaterial\controllers;

use Yii;
use yii\web\Controller;
use suPnPsu\borrowMaterial\models\SubmitedcheckSearch;

/**
 * Default controller for the `borrowreturn` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'หน้ารายการ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new SubmitedcheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
