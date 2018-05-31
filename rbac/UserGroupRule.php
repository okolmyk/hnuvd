<?php

namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
    //public $name = 'userGroup';

    public $name = 'adminGroup';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $group = \Yii::$app->user->identity->adminGroup;
            if ($item->name === 'admin') {
                return $group == 'admin';
            } elseif ($item->name === 'manager') {
                return $group == 'admin' || $group == 'manager';
            } elseif ($item->name === 'monitor') {
                return $group == 'manager' || $group == 'monitor';
            }
        }
        return true;
    }
}
