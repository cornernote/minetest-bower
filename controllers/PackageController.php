<?php

namespace app\controllers;

use app\models\Package;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

class PackageController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionCreate()
    {
        $package = new Package();
        $package->setAttributes(Yii::$app->request->post());
        if ($package->save()) {
            Yii::$app->response->statusCode = 201;
            return '';
        }
        throw new HttpException(400, json_encode($package->errors));
    }

    public function actionIndex()
    {
        return Package::find()->orderBy(['hits' => SORT_DESC])->all();
    }

    public function actionView($name = null)
    {
        $package = Package::find()->where(['name' => $name])->one();
        if ($package) {
            $package->hits++;
            $package->save();
            return $package;
        }
        throw new HttpException(404);
    }

    public function actionSearch($name)
    {
        return Package::find()->where(['name' => $name])->orderBy(['hits' => SORT_DESC])->all();
    }

}
