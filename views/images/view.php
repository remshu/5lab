<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Images */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="images-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['viewdelete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'caption',
            array( 
                'attribute' => 'img',
                'format' => 'html',
                'value' => function($model) {
                    return Html::img(Yii::getAlias('@web').'/uploads/'.$model->img, ['width' => '1000px']);
                },
            ),

        ],
    ]) ?>

</div>
