<?php

namespace suPnPsu\borrowMaterial;
use Yii;
/**
 * borrowreturn module definition class
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
		
		Yii::$app->formatter->locale = 'th_TH';
		Yii::$app->formatter->calendar = \IntlDateFormatter::TRADITIONAL;
        
		$this->params['adminModule'] = [5,18];
		$this->layout = 'borrowreturn';
		$this->params['ModuleVers'] = '1.0.0';
		$this->params['title'] = 'stdunion borrow-return app';
        // custom initialization code goes here
    }
}