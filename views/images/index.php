<?php
/*if(!isset($_SESSION["date"])){
	header("Location: /site/login.php");
	exit();
}*/

use yii\helpers\Html;
use yii\grid\GridView;
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define ('YII_ENV', 'dev');
/* @var $this yii\web\View */
/* @var $searchModel app\models\ImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'caption',
            array(
		'attribute' => 'img',
		'format' => 'html',
		'value' => function($model) {
		    return Html::img(Yii::getAlias('@web').'/uploads/'.$model->img, ['width' => '140px']);
		},
	    ),

            [
		'class' => 'yii\grid\ActionColumn',
		'buttons' => [
			'delete'=>function($url, $model){
				$customurl=Yii::$app->getUrlManager()->createUrl(['images/viewdelete', 'id'=>$model['id']]);
				return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', $customurl,
					['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
			}
		],
		/*'urlCreator' => function($action, $model, $key, $index) {
			return ($action=='delete')?[$action, 'id'=>$model['id'],'hvost'=>time()]
				:[$action, 'id'=>$model['id'], 'hvost'=>$index.$key];
		},*/
	    ],
        ],
    ]); ?>


</div>
