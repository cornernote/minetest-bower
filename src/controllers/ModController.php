<?php

namespace app\controllers;

use app\components\Git;
use Yii;
use app\models\Package;
use app\models\search\PackageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModController implements the CRUD actions for Package model.
 */
class ModController extends Controller
{

    /**
     * Lists all Package models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Package model.
     * @param string $name
     * @return mixed
     */
    public function actionView($name)
    {
        $model = $this->findModel($name);
        //$model->hits++;
        //$model->save(false, ['hits']); // todo, this breaks serialize
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Package model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Package();

        if ($model->load(Yii::$app->request->post()) && $model->harvestModInfo() && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Mod has been registered.'));
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Package model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $name
     * @return mixed
     */
    public function actionUpdate($name)
    {
        $model = $this->findModel($name);
        $model->harvestModInfo();
        if ($model->getDirtyAttributes()) {
            $model->save();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Mod has been updated from remote repository.'));
        } else {
            Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Mod has been updated from remote repository, however no change was detected.'));
        }
        return $this->redirect(['view', 'name' => $model->name]);
    }

    /**
     * Finds the Package model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return Package the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        if (($model = Package::find()->where(['name' => $name])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest()
    {
        $test = Yii::$app->cache->get('test');
        if (!$test) {
            $test = 0;
        }
        $test++;
        Yii::$app->cache->set('test', $test);
        echo $test;
    }
}
