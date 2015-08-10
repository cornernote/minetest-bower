<?php

namespace app\controllers;

use app\components\Git;
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

    public function actionIndex()
    {
        return Package::find()
            ->select(['name', 'url', 'hits'])
            ->orderBy(['hits' => SORT_DESC])
            ->all();
    }

    public function actionView($name)
    {
        $package = Package::find()
            ->where(['name' => $name])
            ->one();
        if ($package) {
            $package->hits++;
            $package->save();
            return $package;
        }
        throw new HttpException(404, 'Package not found.');
    }

    public function actionSearch($search)
    {
        return Package::find()
            ->select(['name', 'url', 'hits'])
            ->where([
                'or',
                ['like', 'name', $search],
                ['like', 'keywords', $search],
            ])
            ->orderBy(['hits' => SORT_DESC])
            ->all();
    }

    public function actionCreate()
    {
        $package = new Package();
        $package->setAttributes(Yii::$app->request->post());
        $package->harvestModInfo();
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
            throw new HttpException(400, 'Invalid Name: ' . implode(', ', $package->errors['name']));
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

}
