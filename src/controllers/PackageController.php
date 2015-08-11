<?php

namespace app\controllers;

use app\components\Git;
use app\models\Package;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class PackageController
 * @package app\controllers
 */
class PackageController extends Controller
{
    /**
     * @var bool
     */
    public $enableCsrfValidation = false;

    /**
     * @return array
     */
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

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * @return \app\models\Package[]|array
     */
    public function actionIndex()
    {
        return Package::find()
            ->select(['name', 'url', 'hits'])
            ->orderBy(['hits' => SORT_DESC])
            ->all();
    }

    /**
     * @param $name
     * @return Package|array|null
     * @throws HttpException
     */
    public function actionView($name)
    {
        $package = Package::find()
            ->where(['name' => $name])
            ->one();
        if ($package) {

            // add a hit once per user per 24 hours
            $cacheKey = $package->name . '_' . Yii::$app->request->userIP;
            if (!Yii::$app->cache->get($cacheKey)) {
                Yii::$app->cache->set($cacheKey, true, (60 * 60 * 24));
                $package->hits++;
                $package->save(false, ['hits']);
            }

            return $package;
        }
        throw new HttpException(404, 'Package not found.');
    }

    /**
     * @param $search
     * @return \app\models\Package[]|array
     */
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

    /**
     * @return string
     * @throws HttpException
     */
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
