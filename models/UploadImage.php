<?php
 
namespace app\models;
 
use yii\base\Model;
use yii\web\UploadedFile;
 
class UploadImage extends Model{
 
    public $img;
 
    public function rules(){
        return[
            [['img'], 'file', 'extensions' => 'png, jpg'],
        ];
    }
 
    public function upload(){
        if($this->validate()){
            var_dump($this->img);
        }else{
            return false;
        }
    }
 
}
