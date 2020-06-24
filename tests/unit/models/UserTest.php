<?php

namespace tests\unit\models;

use app\models\User;
use yii\codeception\DbTestCase;

class UserTest extends \Codeception\Test\Unit
{

    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(9));
        expect($user->username)->equals('user1');

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('user1'));
        expect_not(User::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('user1');

        expect_that($user->validatePassword('1234'));
        expect_not($user->validatePassword('qwer'));        
    }

}
