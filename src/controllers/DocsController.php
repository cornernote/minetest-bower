<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class DocsController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInstall()
    {
        return $this->render('install');
    }

    public function actionBowerFormat()
    {
        return $this->render('bower-format');
    }

    public function actionUpdateWebhook()
    {
        return $this->render('update-webhook');
    }

    public function actionRegistryCurl()
    {
        return $this->render('registry-curl');
    }

    public function actionSemver()
    {
        return $this->render('semver');
    }

}
