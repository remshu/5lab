<?php
namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class UsersFixture extends ActiveFixture
{

    public $modelClass = 'app\models\User';
    public $tableName = 'user';
}

