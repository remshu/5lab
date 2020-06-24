<?php

use yii\helpers\Url;

class LoginCest
{
    public function ensureThatLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/images/login'));
        $I->see('Login', 'h1');

        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="LoginForm[username]"]', 'user1');
        $I->fillField('input[name="LoginForm[password]"]', '1234');
        $I->click('login-button');
        //$I->wait(2); // wait for button to be clicked

        $I->expectTo('see user info');
        $I->see('Logout (user1)');
    }
}
