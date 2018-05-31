<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;
use app\models\Users;
use \app\rbac\UserProfileOwnerRule;


class RbacController extends Controller
{

    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
		    //$authManager->removeAll();

        // Create roles
        $guest = $authManager->createRole('guest');
        $admin = $authManager->createRole('admin');
        $monitor = $authManager->createRole('monitor');
        $manager  = $authManager->createRole('manager');


        // Create simple, based on action{$NAME} permissions
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $registration = $authManager->createPermission('registration');
        $index  = $authManager->createPermission('index');
        $view   = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');
        $create = $authManager->createPermission('create');

        // Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($registration);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);
        $authManager->add($create);

        // Add roles in Yii::$app->authManager
        $authManager->add($admin);
        $authManager->add($monitor);
        $authManager->add($manager);

        // Add permission-per-role in Yii::$app->authManager
        // Monitor
        $authManager->addChild($monitor, $login);
        $authManager->addChild($monitor, $logout);
        $authManager->addChild($monitor, $index);
        $authManager->addChild($monitor, $view);

        // Manager
        $authManager->addChild($manager, $create);
        $authManager->addChild($manager, $update);
        $authManager->addChild($manager, $delete);
        $authManager->addChild($manager, $monitor);

        // Admin
        $authManager->addChild($admin, $manager);

        //навесить роль на id юзера
        $authManager->assign($admin, 1);
        $authManager->assign($admin, 60);
        $authManager->assign($monitor, 2);
        $authManager->assign($manager, 3);
    }


}
