<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return 'api';
    }

    /**
     * Login action.
     *
     * @return ...
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return $token;
        } else {
            return $model;
        }
    }

    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }

    /**
     * Logout action.
     *
     * @return ...
     */
/*    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }*/

}
