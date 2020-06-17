<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $caption
 * @property string|null $img
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'caption'], 'string', 'max' => 255],
	    [['img'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'caption' => 'Caption',
            'img' => 'Img',
        ];
    }

    public function upload() {
	if($this->validate()){
            $exp = explode('/', $this->img->tempName);
            $last = (string)array_pop($exp);
            $this->img->saveAs("uploads/{$this->img->baseName}{$last}.{$this->img->extension}");
            return true;
	} else {
	    return false;
	}
    }
}
