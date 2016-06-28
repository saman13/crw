<?php

namespace app\module\rest\v1;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\module\rest\v1\controllers';

    public function init()
    {
        parent::init();

        \Yii::$app->user->enableSession = false;
    }
}
