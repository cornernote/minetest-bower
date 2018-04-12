<?php

/* @var $this yii\web\View */

use app\models\Package;
use app\models\search\PackageSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\db\Expression;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Minetest Mods: The Minetest mod repository.';
$this->params['jumbotron'] = '/site/_index-jumbotron';

?>
<div class="site-index">

    <div class="body-content">

        <h2>About Minetest Mods</h2>

        <p>Minetest Mods is a Minetest mod repository. The repository is unmoderated, anybody may <?=Html::a('submit a mod',['mod/create'])?>.
            Different versions by different people of similar mods are permitted but
            each version must have different names.</p>

        <p>If you'd like to run a Minetest Mods mirror, this is encouraged and simple to set up. Simply copy
            the <?= Html::a('this JSON file', ['package/index']) ?> to your website and update it periodically.</p>

        <?php
        //echo '<h2>Search Mods</h2>';
        //echo $this->render('/mod/_search', ['model' => new PackageSearch()]);
        ?>

        <?php
        echo '<h2>Mod List</h2>';
        $items = [];
        foreach (\app\models\Package::find()->orderBy(['name' => SORT_ASC])->all() as $package) {
            $items[] = Html::a($package->name, ['mod/view', 'name' => $package->name]);
        }
        echo Html::ul($items, [
            'encode' => false,
            'class' => 'list-inline',
        ]);
        //echo '<div class="row">';
        //$searchModel = new PackageSearch();
        //$query = Package::find();
        //$driver = Package::getDb()->driverName;
        //if ($driver == 'mysql') {
        //    $rand = new Expression('RAND()');
        //} elseif ($driver == 'pgsql') {
        //    $rand = new Expression('RANDOM()');
        //}
        //if (isset($rand)) {
        //    $query->orderBy($rand);
        //}
        //$query->limit(4);
        //$pagination = new Pagination(['totalCount' => 4]);
        //$pagination->pageSize = 4;
        //$pagination->pageSizeLimit = [4];
        //echo ListView::widget([
        //    'layout' => '{items}',
        //    'dataProvider' => new ArrayDataProvider(['allModels' => $query->all()]),
        //    'itemOptions' => ['class' => 'item'],
        //    'itemView' => function ($model, $key, $index, $widget) {
        //        return $this->render('_mod-view', ['model' => $model]);
        //    },
        //    'pager' => $pagination,
        //]);
        //echo '</div>';
        ?>

    </div>
</div>
