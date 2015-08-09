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

    public function actionBowerJsonFormat()
    {
        return $this->render('bower-json-format');
    }

}
