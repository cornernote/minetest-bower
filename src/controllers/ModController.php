<?php

namespace app\controllers;

use app\components\Git;
use Yii;
use app\models\Package;
use app\models\search\PackageSearch;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModController implements the CRUD actions for Package model.
 */
class ModController extends Controller
{
    /**
     * @var bool
     */
    public $enableCsrfValidation = false;

    /**
     * Lists all Package models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackageSearch();
        $dataProvider = $searchModel->search(['PackageSearch' => Yii::$app->request->queryParams]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Redirects to a random mod.
     * @return mixed
     */
    public function actionRandom()
    {
        $driver = Package::getDb()->driverName;
        if ($driver == 'mysql') {
            $rand = new Expression('RAND()');
        } elseif ($driver == 'pgsql') {
            $rand = new Expression('RANDOM()');
        } else {
            return $this->redirect(['index']);
        }
        $model = Package::find()->orderBy($rand)->one();
        return $this->redirect(['view', 'name' => $model->name]);
    }

    /**
     * Displays a single Package model.
     * @param string $name
     * @return mixed
     */
    public function actionView($name)
    {
        $model = $this->findModel($name);

        // add a hit once per user per 24 hours
        $cacheKey = $model->name . '_' . Yii::$app->request->userIP;
        if (!Yii::$app->cache->get($cacheKey)) {
            Yii::$app->cache->set($cacheKey, true, (60 * 60 * 24));
            $model->hits++;
            $model->save(false, ['hits']);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Package models bower info.
     * @param string $name
     * @return mixed
     */
    public function actionBower($name)
    {
        $model = $this->findModel($name);
        return $this->render('bower', [
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
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Mod has been updated from remote repository.'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Error while saving mod updates.'));
            }
        } else {
            Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Mod has been updated from remote repository, however no change was detected.'));
        }
        return $this->redirect(['view', 'name' => $model->name]);
    }


    /**
     * Renders a tag cloud of popular keywords
     * @return mixed
     */
    public function actionCloud()
    {
        $keywords = Yii::$app->cache->get('mod.cloud.keywords');
        if (!$keywords) {
            $keywords = [];
            $packages = Package::find()->where(['is not', 'keywords', null])->all();
            foreach ($packages as $package) {
                foreach (explode(',', $package->keywords) as $keyword) {
                    if (!isset($keywords[$keyword])) {
                        $keywords[$keyword] = [
                            'text' => $keyword,
                            'weight' => 0,
                            'link' => Url::to(['/mod/index', 'search' => $keyword]),
                        ];
                    }
                    $keywords[$keyword]['weight']++;
                }
            }
            Yii::$app->cache->set('mod.cloud.keywords', $keywords, 60 * 60);
        }
        return $this->render('cloud', ['keywords' => $keywords]);
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
}
