<?php

namespace suPnPsu\borrowMaterial\controllers;

<<<<<<< HEAD
use yii\web\Controller;

/**
 * Default controller for the `borrowMaterial` module
=======
use Yii;
use yii\web\Controller;
use suPnPsu\borrowMaterial\models\SubmitedcheckSearch;

/**
 * Default controller for the `borrowreturn` module
>>>>>>> sis
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
<<<<<<< HEAD
        return $this->render('index');
=======
        Yii::$app->view->title = Yii::t('borrow-material', 'หน้ารายการ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new SubmitedcheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
>>>>>>> sis
    }
}
