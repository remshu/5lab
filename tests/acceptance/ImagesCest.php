<?php

use yii\helpers\Url;

class ImagesCest
{
    public function TablForLoginsAndImages(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/images/login'));
        $I->see('Please fill out the following fields to login:', 'p');
        $I->fillField('input[name="LoginForm[username]"]', 'user1');
        $I->fillField('input[name="LoginForm[password]"]', '1234');
        $I->click('login-button');
        $I->see ('Images');
        $I->see('Logout (user1)');
        $I->click('//a[@title="View"]');

    }
}

