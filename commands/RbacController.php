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
        $admin->description('Администратор');
        $auth->add($admin);

        $manager = $auth->createRole('manager');
        $manager->description('Менеджер');
        $auth->add($manager);

        $auth->assign($admin, Users::USER_ADMIN);
    }
}