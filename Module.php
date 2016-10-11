<?php

namespace suPnPsu\borrowMaterial;
use Yii;
/**
 * borrowMaterial module definition class
=======
use Yii;
/**
 * borrowreturn module definition class
>>>>>>> sis
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'suPnPsu\borrowMaterial\controllers';
    
    /**
     *
     * @var type 
     * You can config site-end on config main moudule.
     * /frontend/ or /backend/
     */
    //public $siteend = '/frontend/';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        //$this->setViewPath($this->getViewPath().$this->siteend);  

//        if (!isset(Yii::$app->i18n->translations['borrow-material'])) {
//            Yii::$app->i18n->translations['borrow-material'] = [
//                'class' => 'yii\i18n\PhpMessageSource',
//                'sourceLanguage' => 'en',
//                'basePath' => '@suPnPsu/borrowMaterial/messages'
//            ];
//        }


//		Yii::$app->formatter->locale = 'th_TH';
//		Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
//                              
//        
//		$this->params['adminModule'] = [5,18];
		//$this->layout = 'menu-left';
		$this->params['ModuleVers'] = '1.0.0';
		$this->params['title'] = 'โปรแกรมยืมคืนพัสดุ/ครุภัณฑ์';
        // custom initialization code goes here
    }
}
