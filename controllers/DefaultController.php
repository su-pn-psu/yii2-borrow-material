<?php

namespace suPnPsu\borrowMaterial\controllers;

use Yii;

use suPnPsu\user\models\User;

use suPnPsu\material\models\Material;
use suPnPsu\material\models\MaterialSearchAvailable;

use suPnPsu\borrowMaterial\models\SubmitedcheckSearch;
use suPnPsu\borrowMaterial\models\Booking;
use suPnPsu\borrowMaterial\models\StdBelongto;
use suPnPsu\borrowMaterial\models\Borrowreturn;
use suPnPsu\borrowMaterial\models\MaterialAvailableSearch;
use suPnPsu\borrowMaterial\models\StdPosition;
use suPnPsu\borrowMaterial\models\BookingSearch;
use suPnPsu\borrowMaterial\models\ReturnedcheckSearch;
use suPnPsu\borrowMaterial\models\DraftSearch;
use suPnPsu\borrowMaterial\models\SentcheckSearch;
use suPnPsu\borrowMaterial\models\Bookingmaterial;

use yii\filters\VerbFilter;

use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\bootstrap\Nav;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

use yii\helpers\ArrayHelper;
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
    public $belongtolist;
    public $positionlist;

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

//        foreach ($this->admincontroller as $key) {
//            array_push(Yii::$app->controller->module->params['adminModule'], $key);
//        }
        $belongto = StdBelongto::find()->all();
        $this->belongtolist = ArrayHelper::map($belongto, 'id', 'title');

        $formpos = StdPosition::find()->all();
        $this->positionlist = ArrayHelper::map($formpos, 'id', 'title');

        return true;
    }

    public function actionIndex()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'รายการผ่านอนุมัติ-ยังไม่คืน') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new SentcheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id'=> Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDraft()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ร่าง') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new DraftSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id'=> Yii::$app->user->id]);

        return $this->render('draft', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmited()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'รายการรออนุมัติ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new SubmitedcheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id'=> Yii::$app->user->id]);
        return $this->render('submited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproved()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ยังไม่มารับ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new SentcheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id'=> Yii::$app->user->id]);
        return $this->render('approved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReturned()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ยังไม่คืน') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new ReturnedcheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id'=> Yii::$app->user->id]);

        return $this->render('returned', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAll()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'ประวัติรายการทั้งหมด') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id'=> Yii::$app->user->id]);

        return $this->render('allbooking', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'เพิ่มการจอง') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = new Booking();
        $mdluser = User::findOne(Yii::$app->user->id);

        $model->scenario = 'create';
        $model->create_at = date('Y-m-d');
        $model->user_id = Yii::$app->user->id;

        $session = Yii::$app->session;
        unset($session['update-form']);

        /* if enable ajax validate*/

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            isset(Yii::$app->request->post()['sng']) ? $model->entry_status = 1 : $model->entry_status = 0;
            if ($model->save()) {

                $session = Yii::$app->session;
                $items = $session->get('selected-material');

                if($this->checkmatavail()){
                    foreach($items as $key => $value ){
                        $mdlbookmat = new Bookingmaterial();
                        $mdlbookmat->booking_id = $model->id;
                        $mdlbookmat->material_id = $value['id'];
                        if(!$mdlbookmat->save()){
                            throw new ServerErrorHttpException('Server operation error.');
                        }
                    }
                    unset($session['selected-material']);
                }
                unset($session['create-form']);

                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', 'เพิ่มเรียบร้อย'),
                ]);
                return $this->redirect(['viewbooking', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'เพิ่มไม่สำเร็จ'),
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'mdluser' => $mdluser,
            'belongtolist' => $this->belongtolist,
            'positionlist' => $this->positionlist,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModelbooking($id);
        $mdluser = User::findOne(Yii::$app->user->id);

        if ($model->entry_status > 2) {
            Yii::$app->getSession()->setFlash('edtflsh', [
                'type' => 'danger',
                'duration' => 4000,
                'icon' => 'glyphicon glyphicon-remove-circle',
                'message' => Yii::t('borrow-material', 'ผ่านการอนุมัติแล้ว ไม่สามารถแก้ไขได้อีก'),
            ]);
            return $this->redirect(['viewbooking', 'id' => $model->id]);
        }

        $session = Yii::$app->session;
        $session->set('update-form', $id);
        unset($session['create-form']);
        //$selectedMaterial = [];

        //$selectedMaterial = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');

        if(($session->get('selected-material') == null)){
            $mdlbookmats = $model->bookingmaterials;

            foreach($mdlbookmats as $key => $value){
                $selectedMaterial[$value->material_id] = [
                    'id' => $value->material_id,
                    'title' => $value->material->title,
                    'brand' => $value->material->brand,
                    'amount' => 1,
                ];
                //foreach($value as $key => $value) {
                // echo $value['material_id'];
                //}
            }
            $session->set('selected-material', $selectedMaterial);
        }else{
            $items = $session->get('selected-material');
        }


        Yii::$app->view->title = Yii::t('borrow-material', 'ปรับปรุงข้อมูล {modelClass}: ', [
                'modelClass' => 'Booking',
            ]) . $model->id . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        if ($model->load(Yii::$app->request->post())) {
            isset(Yii::$app->request->post()['sng']) ? $model->entry_status = 1 : $model->entry_status = 0;
            if ($model->save()) {

                if($this->checkmatavail()){
                    Bookingmaterial::deleteAll(['booking_id' => $model->id]);
                    foreach($items as $key => $value ){
                        $mdlbookmat = new Bookingmaterial();
                        $mdlbookmat->booking_id = $model->id;
                        $mdlbookmat->material_id = $value['id'];
                        if(!$mdlbookmat->save()){
                            throw new ServerErrorHttpException('Server operation error.');
                        }
                    }
                    unset($session['selected-material']);
                    //print_r($session['selected-material']);echo 'fffff';
                    //exit;
                }
                unset($session['create-form']);

                Yii::$app->getSession()->setFlash('edtflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', 'ปรับปรุงข้อมูลเรียบร้อย'),
                ]);
                return $this->redirect(['viewbooking', 'id' => $model->id]);
            } else {
                Yii::$app->getSession()->setFlash('edtflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'ปรับปรุงข้อมูลไม่สำเร็จ'),
                ]);
            }
        }

        $availmat = Material::findAll(['available' => 1]);
        $availmatlist = ArrayHelper::map($availmat, 'id', 'title');

        $searchMaterial = new MaterialAvailableSearch();
        $dataProviderMaterial = $searchMaterial->search(Yii::$app->request->queryParams);

        return $this->render('update', [
            'model' => $model,
            'mdluser' => $mdluser,
            'belongtolist' => $this->belongtolist,
            'positionlist' => $this->positionlist,
            'availmatlist' => $availmatlist,
            'searchMaterial' => $searchMaterial,
            'dataProviderMaterial' => $dataProviderMaterial,
        ]);


    }

    protected function findModelbooking($id)
    {
        //if (($model = Booking::findOne($id)) !== null) {
        if (($model = Booking::findOne($id)) !== null && $model->user_id == Yii::$app->user->id ) {
            return $model;
        } else {
            throw new NotFoundHttpException('ไม่พบหน้าที่ท่านหา หรือท่านไม่มีสิทธิเข้าถึง');
        }
    }

    protected function findModelborrow($id)
    {
        //if (($model = Booking::findOne($id)) !== null) {
        if (($model = Borrowreturn::findOne($id)) !== null && $model->booking->user_id == Yii::$app->user->id ) {
            return $model;
        } else {
            throw new NotFoundHttpException('ไม่พบหน้าที่ท่านหา หรือท่านไม่มีสิทธิเข้าถึง');
        }
    }

    public function actionViewbooking($id)
    {
        $mdlbooking = $this->findModelbooking($id);
        Yii::$app->view->title = Yii::t('borrow-material', 'ดูรายละเอียด') . ' : ' . $mdlbooking->id . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        return $this->render('viewbooking', [
            'mdlbooking' => $mdlbooking,
        ]);
    }

    public function actionSelectmat()
    {
        $searchMaterial = new MaterialAvailableSearch();
        $dataProviderMaterial = $searchMaterial->search(Yii::$app->request->queryParams);

        $this->checkmatavail();

        return $this->render('selectmat', [
            'searchMaterial' => $searchMaterial,
            'dataProviderMaterial' => $dataProviderMaterial,
        ]);
    }

    public function actionAjaxSelectMaterial($id)
    {
        $session = Yii::$app->session;
        $selectedMaterial = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');
        if (!array_key_exists($id, $selectedMaterial)) {
            $model = Material::findOne($id);
            $selectedMaterial[$id] = [
                'id' => $model->id,
                'title' => $model->title,
                'brand' => $model->brand,
                'amount' => 1,];
            $session->set('selected-material', $selectedMaterial);
            $result = [
                'status' => 1,
                'item' => $session->get('selected-material'),
            ];
        } else {
            $result = [
                'status' => 2,
            ];
        }

        echo \yii\helpers\Json::encode($result);
    }

    public function actionAjaxClearSelectedMaterial($id = NULL)
    {
//        $session = Yii::$app->session;
//        $selectedMaterial = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');
//        if (isset($id) && $id != '') {
//            unset($selectedMaterial[$id]);
//            echo $id;
//            print_r($selectedMaterial);
//            $session->set('selected-material', $selectedMaterial);
//        } else {
//        }
        $session = Yii::$app->session;
        unset($session['selected-material']);
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

    public function actionQmatinfo($id)
    {
        $model = Material::findOne($id);
        return $this->renderAjax('_matinfo', [
            'model' => $model,
        ]);
    }

    public function actionDisapproved($id)
    {
        $model = $this->findModelborrow($id);

//        if ($model->load(Yii::$app->request->post())) {
//            $model->deliver_at = date('Y-m-d H:i');
//            if ($model->save()) {
//                echo 'dddd';
//            }
//        }else{
//            return $this->renderAjax('_disapprove', [
//                'model' => $model,
//            ]);
//        }

        $model = $this->findModelborrow($id);

        $model->deliver_at = date('Y-m-d H:i');
        if ($model->load(Yii::$app->request->post())) {
            //echo 1;
            if ($model->save(false)) {
                echo 1;
            } else {
                print_r($model->getErrors());
            }

        } else {
            return $this->renderAjax('_disapprove', [
                'model' => $model,
            ]);
        }
    }

    public function checkmatavail()
    {
        $session = Yii::$app->session;
        $items = ($session->get('selected-material') == null) ? [] : $session->get('selected-material');

        foreach($items as $key => $value ){
            //$mat = Material::findOne(['id' => $value['id']])->availcheck;
            if(!Material::findOne(['id' => $value['id']])->availcheck){
                Yii::$app->getSession()->setFlash('error', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'การเลือกพัสดุไม่สมบูรณ์ กรุณาลองใหม่อีกครั้ง'),
                ]);
                unset($session['selected-material']);
                return false;
            }
        }
        return true;
    }

    public function actionCreateemp(){
        $tmpcreate = Yii::$app->request->post();
        //print_r($tmpcreate['Booking']);
        $session = Yii::$app->session;
        $crform = ($session->get('create-form') == null) ? [] : $session->get('create-form');
        foreach($tmpcreate as $key => $value){
            $crform[$key] = $value;
        }
        $session->set('create-form', $crform);
        //unset($session['create-form']);
    }

}
