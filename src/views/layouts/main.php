<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
NavBar::begin([
    'brandLabel' => 'Minetest Mods',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-default navbar-fixed-top',
    ],
]);
echo '<a class="hidden-xs" href="https://github.com/cornernote/minetest-bower"><img style="position: absolute; top: 0; right: 0; border: 0; z-index: 1;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>';
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        //['label' => 'Browse', 'url' => ['/mod/index'], 'active' => (Yii::$app->controller->id == 'mod' && !in_array(Yii::$app->controller->action->id, ['create', 'cloud']))],
        //['label' => 'Random', 'url' => ['/mod/random']],
        //['label' => 'Cloud', 'url' => ['/mod/cloud']],
        ['label' => 'Submit', 'url' => ['/mod/create']],
        ['label' => 'Docs', 'url' => ['/docs/index'], 'active' => Yii::$app->controller->id == 'docs'],
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Minetest Home', 'url' => 'http://minetest.net'],
    ],
]);
NavBar::end();

if (isset($this->params['jumbotron'])) {
    echo $this->render($this->params['jumbotron']);
}
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted">
                    Have issues or questions?
                    <a href="https://github.com/cornernote/minetest-bower/issues/new">Contact us</a>
                </p>
            </div>
            <div class="col-md-6 text-right">
                <p class="text-muted">
                    Hosting sponsored by
                    <a href="https://heroku.com/">Heroku</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
