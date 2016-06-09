<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;

/**
 * This command create roles (admin and partner)
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $role = Yii::$app->authManager->createRole(User::ROLE_ADMIN);
        $role->description = 'Admin';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole(User::ROLE_USER);
        $role->description = 'User';
        Yii::$app->authManager->add($role);
    }
}