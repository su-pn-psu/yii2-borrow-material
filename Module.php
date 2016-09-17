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
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['borrow-material'])) {
            Yii::$app->i18n->translations['borrow-material'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@suPnPsu/borrowMaterial/messages'
            ];
        }/**/


		Yii::$app->formatter->locale = 'th_TH';
		Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
        
		$this->params['adminModule'] = [5,18];
		$this->layout = 'menu-left';
		$this->params['ModuleVers'] = '1.0.0';
		$this->params['title'] = 'โปรแกรมยืมคืนพัสดุ/ครุภัณฑ์';
        // custom initialization code goes here
    }
}
