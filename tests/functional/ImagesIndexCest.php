<?php

use yii\helpers\Url;

namespace app\tests\functionals;

use yii\codeception\DbTestCase;

class ImageButtonsCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['images/login']);
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'user1',
            'LoginForm[password]' => '1234',
        ]);
        $I->amOnPage('images/index');
    }
 
    public function testClickUpdate(\FunctionalTester $I)
    {	
        $I->amOnRoute('images/index');
        $I->see('Create Images');
        $I->click('Create Images');
        $I->see('Save');
        $I->seeInCurrentUrl('images%2Fcreate');
    }
}

?>
