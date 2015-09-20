<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\BasicProfile;
use frontend\models\City;
use frontend\models\Country;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ProfileController extends Controller
{
    public function actionIndex() 
    {
        $model = new BasicProfile();

        if (BasicProfile::find()->count()) {
            $profile = BasicProfile::find()->one();
            return $this->render('index', compact('model', 'profile'));
        }

        return $this->render('index', compact('model'));
    }

    public function actionCreate() 
    {
        $model = new BasicProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->addFlash('success', 'Profile Created.');
            return $this->redirect('/');
            // return $this->render('index', compact('model'));
            // return json_encode(['status' => 201]);
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model
            ]);
        
        } else {
            die('fefef');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCityList($id) 
    {
        if ($countryCities = Country::findOne($id)) {
            foreach ($countryCities->cities as $city) {
                echo "<option value='" . $city->id . "'>" . $city->name . "</option>";
            } 
            
        } else {
            echo "<option> - </option>";
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', 'Profile Updated.');
            return json_encode(['status' => 200]);
            // return $this->redirect('/');
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model
            ]);
        
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = BasicProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest() 
    {
        $model = new BasicProfile();
        return $this->render('create', compact('model'));
    }

}