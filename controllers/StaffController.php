<<<<<<< HEAD
<?php

namespace suPnPsu\borrowMaterial\controllers;

use Yii;
use suPnPsu\user\models\User;
use suPnPsu\borrowMaterial\models\Borrowreturn;
use suPnPsu\borrowMaterial\models\Booking;
use suPnPsu\borrowMaterial\models\BookingSearch;
use suPnPsu\borrowMaterial\models\BookingsubmitedSearch;
use suPnPsu\borrowMaterial\models\BookingapprovedSearch;
use suPnPsu\borrowMaterial\models\BookingsentSearch;
use suPnPsu\borrowMaterial\models\Bookingmaterial;
use suPnPsu\borrowMaterial\models\SubmitedcheckSearch;

use suPnPsu\material\models\Material;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;
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
class StaffController extends Controller
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

    protected function findBorrow($id)
    {
        if (($model = Borrowreturn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApprovedlist()
    {

        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่อนุมัติแล้ว') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingapprovedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('approvedlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmitedlist()
    {

        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ยื่นจอง') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingsubmitedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('submitedlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSentlist()
    {

        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ส่งมอบแล้ว') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingsentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('sentlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBorrowall()
    {

        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ส่งมอบแล้ว') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('borrowall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSubmitborrow($id)
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'อนุมัติการยืม') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = new Borrowreturn();

        if (($mdlbooking = Booking::findOne($id)) !== null) {
            $model->booking_id = $mdlbooking->id;
        } else {
            throw new NotFoundHttpException('ไม่พบหน้าที่ท่านหา หรือท่านไม่มีสิทธิเข้าถึง');
        }
        $model->booking_id = $id;
        $model->confirm_staff_id = Yii::$app->user->id;
        $model->confirm_at = date('Y-m-d H:i');
        $model->deliver_staff_id = Yii::$app->user->id;
        $model->return_staff_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->confirm_status == 1) {
                $model->confirm_comment = NULL;
            }
            if ($model->save()) {

                if ($model->confirm_status == 1) {
                    $bookmat = Bookingmaterial::findAll([ 'booking_id' => $id, ]);
                    foreach ($bookmat as $key => $value) {
                        $material = Material::findOne($value->material_id);
                        $material->available = 0;
                        $material->save();
                    }
                    $mdlbooking->entry_status = 2;
                }else{
                    $mdlbooking->entry_status = 3;
                }
                if($mdlbooking->save(false)){
                    Yii::$app->getSession()->setFlash('addflsh', [
                        'type' => 'success',
                        'duration' => 4000,
                        'icon' => 'glyphicon glyphicon-ok-circle',
                        'message' => Yii::t('borrow-material', 'อนุมัติเรียบร้อย'),
                    ]);
                    return $this->redirect(['submitedlist']);
                }else{
                    print_r($mdlbooking->getError());
                    exit;
                }

            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'อนุมัติไม่สำเร็จ'),
                ]);
            }
        }

        return $this->render('submitborrow', [
            'model' => $model,
            'mdlbooking' => $mdlbooking,
        ]);


    }

    public function actionSubmitsend($id)
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'ส่งมอบพัสดุ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = $this->findBorrow($id);

        if (($mdlbooking = Booking::findOne($id)) !== null) {
            $model->booking_id = $mdlbooking->id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }/**/
        $model->deliver_staff_id = Yii::$app->user->id;
        $model->deliver_at = date('Y-m-d H:i');
        $model->return_staff_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {

            $model->deliver_status == 1 ? $mdlbooking->entry_status = 4 :  $mdlbooking->entry_status = 5;

            if ($model->save()) {

                $mdlbooking->save(false);

                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', 'ส่งมอบเรียบร้อย'),
                ]);
                //return $this->redirect(['view', 'id' => $model->booking_id]);
                return $this->redirect(['approvedlist']);
            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'ส่งมอบไม่สำเร็จ'),
                ]);
            }
        }

        return $this->render('submitborrow', [
            'model' => $model,
            'mdlbooking' => $mdlbooking,
        ]);
    }

    public function actionSubmitreturn($id)
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'รับคืนพัสดุ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = $this->findBorrow($id);

        if (($mdlbooking = Booking::findOne($id)) !== null) {
            $model->booking_id = $mdlbooking->id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }/**/
        $model->return_staff_id = Yii::$app->user->id;
        $model->return_at = date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                $bookmat = Bookingmaterial::findAll([ 'booking_id' => $id, ]);
                foreach ($bookmat as $key => $value) {
                    $material = Material::findOne($value->material_id);
                    $material->available = 1;
                    $material->save();
                }

                $mdlbooking->entry_status = 6;
                $mdlbooking->save(false);

                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', 'รับคืนเรียบร้อย'),
                ]);
                //return $this->redirect(['view', 'id' => $model->booking_id]);
                return $this->redirect(['sentlist']);
            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'รับคืนไม่สำเร็จ'),
                ]);
            }
        }

        return $this->render('submitborrow', [
            'model' => $model,
            'mdlbooking' => $mdlbooking,
        ]);


    }
}
=======
<?php

namespace suPnPsu\borrowMaterial\controllers;
use Yii;

use suPnPsu\user\models\User;

use suPnPsu\borrowMaterial\models\Borrowreturn;
use suPnPsu\borrowMaterial\models\Booking;
use suPnPsu\borrowMaterial\models\BorrowreturnSearch;
use suPnPsu\borrowMaterial\models\BookingsubmitedSearch;
use suPnPsu\borrowMaterial\models\BookingapprovedSearch;
use suPnPsu\borrowMaterial\models\BookingsentSearch;
use suPnPsu\borrowMaterial\models\SubmitedcheckSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;

use yii\web\Response;
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
class StaffController extends Controller
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

    public function actionApprovedlist()
    {

        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่อนุมัติแล้ว') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingapprovedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('approvedlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmitedlist()
    {

        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ยื่นจอง') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingsubmitedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('submitedlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSentlist()
    {

        Yii::$app->view->title = Yii::t('borrow-material', 'รายการที่ส่งมอบแล้ว') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $searchModel = new BookingsentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('sentlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubmitborrow($id)
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'อนุมัติการยืม') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = new Borrowreturn();

        //$mdluser = User::findOne(Yii::$app->user->id);

        if (($mdlbooking = Booking::findOne($id)) !== null) {
            $model->booking_id = $mdlbooking->id;
            $mdluser = User::findOne($mdlbooking->user_id);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->booking_id = $id;
        $model->confirm_staff_id = Yii::$app->user->id;
        $model->confirm_at = date('Y-m-d H:i');
        $model->deliver_staff_id = Yii::$app->user->id;
        $model->deliver_at = date('Y-m-d H:i');
        $model->return_staff_id = Yii::$app->user->id;
        //$model->return_at = date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->confirm_status == 1) {
                $model->confirm_comment = "";
            }
            if ($model->save()) {

                $mdlbooking->entry_status = 2;
                $mdlbooking->save();

                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', 'อนุมัติเรียบร้อย'),
                ]);
                //return $this->redirect(['view', 'id' => $model->booking_id]);
                return $this->redirect(['submitedlist']);
            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'อนุมัติไม่สำเร็จ'),
                ]);
            }
        }

        return $this->render('submitborrow', [
            'model' => $model,
            'mdlbooking' => $mdlbooking,
            'mdluser' => $mdluser,
        ]);


    }

    public function actionSubmitsend($id)
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'ส่งมอบพัสดุ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = $this->findModel($id);

        if (($mdlbooking = Booking::findOne($id)) !== null) {
            $model->booking_id = $mdlbooking->id;
            $mdluser = User::findOne($mdlbooking->user_id);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }/**/
        $model->deliver_staff_id = Yii::$app->user->id;
        $model->deliver_at = date('Y-m-d H:i');
        $model->return_staff_id = Yii::$app->user->id;
        $model->return_at = date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                $mdlbooking->entry_status = 3;
                $mdlbooking->save();

                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', 'ส่งมอบเรียบร้อย'),
                ]);
                //return $this->redirect(['view', 'id' => $model->booking_id]);
                return $this->redirect(['approvedlist']);
            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'ส่งมอบไม่สำเร็จ'),
                ]);
            }
        }

        return $this->render('submitborrow', [
            'model' => $model,
            'mdlbooking' => $mdlbooking,
            'mdluser' => $mdluser,
        ]);
    }

    public function actionSubmitreturn($id)
    {
        Yii::$app->view->title = Yii::t('borrow-material', 'รับคืนพัสดุ') . ' - ' . Yii::t('borrow-material', Yii::$app->controller->module->params['title']);

        $model = $this->findModel($id);

        if (($mdlbooking = Booking::findOne($id)) !== null) {
            $model->booking_id = $mdlbooking->id;
            $mdluser = User::findOne($mdlbooking->user_id);
            $mdluser = User::findOne($mdlbooking->user_id);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }/**/
        $model->return_staff_id = Yii::$app->user->id;
        $model->return_at = date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                $mdlbooking->entry_status = 4;
                $mdlbooking->save();

                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'success',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-ok-circle',
                    'message' => Yii::t('borrow-material', 'รับคืนเรียบร้อย'),
                ]);
                //return $this->redirect(['view', 'id' => $model->booking_id]);
                return $this->redirect(['approvedlist']);
            } else {
                Yii::$app->getSession()->setFlash('addflsh', [
                    'type' => 'danger',
                    'duration' => 4000,
                    'icon' => 'glyphicon glyphicon-remove-circle',
                    'message' => Yii::t('borrow-material', 'รับคืนไม่สำเร็จ'),
                ]);
            }
        }

        return $this->render('submitborrow', [
            'model' => $model,
            'mdlbooking' => $mdlbooking,
            'mdluser' => $mdluser,
        ]);


    }
}
>>>>>>> origin/master
