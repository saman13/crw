<?php

namespace app\module\rest\v1\controllers;

use Yii;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        echo 'indexaaaa';
    }

    public function actionView($id)
    {
        var_dump($id);die;
        echo 'indexaaaa';
    }
}
