<?php

namespace suPnPsu\borrowMaterial\controllers;

use Yii;
use suPnPsu\borrowMaterial\models\Bookingmaterial;
use suPnPsu\borrowMaterial\models\BookingmaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * BookmatController implements the CRUD actions for Bookingmaterial model.
 */
class BookmatController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public $admincontroller = [20];

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        foreach ($this->admincontroller as $key) {
            array_push(Yii::$app->controller->module->params['adminModule'], $key);
        }

        return true;
        /*
      if(ArrayHelper::isIn(Yii::$app->user->id, Yii::$app->controller->module->params['adminModule'])){
          //echo 'you are passed';
      }else{
          throw new ForbiddenHttpException('You have no right. Must be admin module.');
      }
      */
    }

    /**
     * Lists all Bookingmaterial models.
     * @return mixed
     */
    public function actionIndex()
    {

        Yii::$app->view->title = Yii::t('borrow-material', '��¡������׹-��ʴ�') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingmaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bookingmaterial model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        Yii::$app->view->title = Yii::t('borrow-material', '˹����������´') . ' : ' . $model->id . ' - ' . Yii::t('itinfo/app', Yii::$app->controller->module->params['title']);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Bookingmaterial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->view->title = Yii::t('borrow-material', '����������') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = new Bookingmaterial();

        /* if enable ajax validate
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }*/

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', '�����Ŷ١��������'),
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', '���������������'),
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);


    }

    /**
     * Updates an existing Bookingmaterial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        Yii::$app->view->title = Yii::t('borrow-material', '��Ѻ��ا {modelClass}: ', [
                'modelClass' => 'Bookingmaterial',
            ]) . $model->id . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('edtflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', '�����Ŷ١��Ѻ��ا����'),
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('edtflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', '��Ѻ��ا�����������'),
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);


    }

    /**
     * Deletes an existing Bookingmaterial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('edtflsh', [
            'type' => 'success',
            'duration' => 4000,
            'icon' => 'glyphicon glyphicon-ok-circle',
            'message' => Yii::t('borrow-material', '�����Ŷ١ź����'),
        ]);


        return $this->redirect(['index']);
    }

    /**
     * Finds the Bookingmaterial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bookingmaterial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bookingmaterial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
