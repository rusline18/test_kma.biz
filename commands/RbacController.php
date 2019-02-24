<?php

namespace app\commands;

use Yii;
use app\models\Users;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $manager = $auth->createRole('manager');
        $auth->add($manager);

        $auth->assign($admin, Users::USER_ADMIN);
    }
}