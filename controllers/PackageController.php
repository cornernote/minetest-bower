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
        foreach ($package->errors as $attributeErrors) {
            foreach ($attributeErrors as $error) {
                if (strpos($error, 'has already been taken')) {
                    throw new HttpException(403, 'Package already registered');
                }
            }
        }
        if (isset($package->errors['name'])) {
            throw new HttpException(400, 'Invalid Package Name: ' . implode(', ', $package->errors['name']));
        }
        if (isset($package->errors['url'])) {
            throw new HttpException(400, 'Invalid URL: ' . implode(', ', $package->errors['url']));
        }
        $errors = [];
        foreach ($package->errors as $attribute => $attributeErrors) {
            foreach ($attributeErrors as $error) {
                $errors[] = $attribute . ': ' . $error;
            }
        }
        throw new HttpException(400, 'Error: ' . implode(', ', $errors));
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
