<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\News;
use app\models\RssLink;
use app\models\User;
use yii\console\Controller;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UserController extends Controller
{
    public function actionCreate($username, $password, $superuser)
    {
        $user = new User();
        $user->username = $username;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($password);
        $user->superuser = $superuser;
        $user->save();
    }
}
