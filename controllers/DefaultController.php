<?php

namespace suPnPsu\borrowMaterial\controllers;
use Yii;
use yii\web\Controller;
use suPnPsu\borrowMaterial\models\SubmitedcheckSearch;
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
        Yii::$app->view->title = Yii::t('borrow-material', 'รายการยืมคืน') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new SubmitedcheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionQaddposition()
    {
        $model = new StdPosition();
        $model->saveby = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }

        } else {
            return $this->renderAjax('_formtype', [
                'model' => $model,
            ]);
        }
    }

    public function actionQaddbelongto()
    {
        $model = new StdBelongto();
        $model->saveby = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }

        } else {
            return $this->renderAjax('_formbel', [
                'model' => $model,
            ]);
        }
    }
}
