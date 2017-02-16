<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use app\models\RegistryForm;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        if (Yii::$app->user->isGuest){
            $this->redirect(['login']);
        }
        return $this->render('index');
    }

    public function actionLogin(){
        if (Yii::$app->user->isGuest){
            $model = new LoginForm();
            return $this->render('login',[
                'model'=>$model,
            ]);
        }else{
            return $this->redirect(['index']);
        }
    }


}
