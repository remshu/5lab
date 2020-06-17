<?php
namespace app\models;
use yii\base\Model;
 
class SignupForm extends Model{
    
    public $username;
    public $password;
    
    public function rules() {
        return [
            [['username', 'password'], 'required', 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'This login is already taken'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'username' => 'Login',
            'password' => 'Password',
        ];
    }
    
}
