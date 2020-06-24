<?php

namespace app\controllers;

use Yii;
use app\models\Images;
use app\models\ImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use yii\web\UploadedFile;
//use app\models\UploadImage;

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class ImagesController extends Controller
{
    /*public function goHome()
    {
	return $this->response->redirect(['/images/index']);
    }*/

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex()
    {
	if (!Yii::$app->user->isGuest)
        {

        $searchModel = new ImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	//$dataProvider = Images::find()->where(['creator' => Yii::$app->user->id])->orderBy('id')->all();
        $dataProvider->query->andWhere(['creator' => Yii::$app->user->id]);
	return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
	return $this->redirect(['login']);
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
	if (!Yii::$app->user->isGuest)
        {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
	}

        return $this->redirect(['login']);

    }

    public function actionViewdelete($id)
    {
	if (!Yii::$app->user->isGuest)
        {

        return $this->render('viewdelete', [
            'model' => $this->findModel($id),
        ]);
   	}

        return $this->redirect(['login']);

    }


    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
 	if (!Yii::$app->user->isGuest)
        {

        $model = new Images();

	if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->img = UploadedFile::getInstance($model, 'img');
            $model->upload();
	    $exp = explode('/', $model->img->tempName);
            $last = (string)array_pop($exp);
            $path = "{$model->img->baseName}{$last}.{$model->img->extension}";
	    $model->img = $path;
	    $model->creator = Yii::$app->user->id;
	    $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
    	}
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/

	/*if ($model->load(Yii::$app->request->post()) && $model->validate()) {
	    $model->img = UploadedFile::getInstance($model, 'img');
            if ($model->img && $model->validate())
            {
                unlink(Yii::$app->basePath."/web/uploads/".$model->img);
                if ($model->upload())
                {
                    $exp = explode('/', $model->img->tempName);
                    $last = (string)array_pop($exp);
                    $path = "{$model->img->baseName}{$last}.{$model->img->extension}";
                    $model->pathImage = $path;
                }
            }

            $model->save();
            return $this->redirect(['index']);
	}*/

        return $this->render('create', [
            'model' => $model,
        ]);
	}

        return $this->redirect(['login']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
    	if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->username = $model->username;
            //$user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->password = $model->password;
	    //echo '<pre>'; print_r($user); die;
	    if($user->save()){
                return $this->goHome();
            }
    	}
        return $this->render('signup', compact('model'));
    }


    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
	if (!Yii::$app->user->isGuest)
        {

        $model = $this->findModel($id);

	if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->img = UploadedFile::getInstance($model, 'img');
            $model->upload();
            $exp = explode('/', $model->img->tempName);
            $last = (string)array_pop($exp);
            $path = "{$model->img->baseName}{$last}.{$model->img->extension}";
            $model->img = $path;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }


        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/

        return $this->render('update', [
            'model' => $model,
        ]);
	}

        return $this->redirect(['login']);
    }
    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
	if (!Yii::$app->user->isGuest)
        {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
	}

        return $this->redirect(['login']);

    }

    public function actionUploadImage()
    {
	$model = new UploadImage();
    	if(Yii::$app->request->isPost){
            $model->img = UploadedFile::getInstance($model, 'img');
            $model->upload();
            return;
    	}
    	return $this->render('upload', ['model' => $model]);
    }

    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
