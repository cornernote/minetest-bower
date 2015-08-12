<?php

use app\components\Git;
use app\widgets\DetailView;
use yii\bootstrap\Alert;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-view">

    <div class="row">
        <div class="col-lg-8">
            <?= $model->getReadmeHtml() ?>
            <?php
            if (!$model->readme) {
                echo '<h1>' . Html::encode($model->name) . '</h1>';
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-danger',
                    ],
                    'closeButton' => false,
                    'body' => 'This mod has no <code>README.md</code> or <code>README.txt</code> file.  If you are the owner please consider adding one to the <a href="' . Git::getUrl($model->url) . '">repository</a>.',
                ]);
            }
            ?>
        </div>
        <div class="col-lg-4 small">
            <?= DetailView::widget([
                'model' => $model,
                'hideIfEmpty' => true,
                'attributes' => [
                    'name',
                    //'description',
                    'keywords',
                    [
                        'label' => 'Authors',
                        'value' => $model->getAuthorsHtml(),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'License',
                        'value' => $model->getLicenseHtml(),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Links',
                        'value' => $model->getLinksHtml(),
                        'format' => 'raw',
                    ],
                    //'hits',
                    //'created_at',
                    //[
                    //    'attribute' => 'updated_at',
                    //    'value' => $model->updated_at . '&nbsp;&nbsp;[' . Html::a('update', ['update', 'name' => $model->name]) . ']',
                    //    'format' => 'raw',
                    //],
                ],
            ]) ?>

            <p class="text-center">
                <?= Html::a('Update <i class="glyphicon glyphicon-chevron-right"></i>', ['update', 'name' => $model->name], ['class' => 'btn btn-sm btn-default']); ?>
                &nbsp;&nbsp;
                <?= Html::a('View bower.json <i class="glyphicon glyphicon-chevron-right"></i>', ['bower', 'name' => $model->name], ['class' => 'btn btn-sm btn-default']); ?>
            </p>

            <div class="text-center">
                <?= $model->getScreenshotsHtml(); ?>
            </div>

            <?php if (!$model->bower) { ?>
                <?= Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'closeButton' => false,
                    'body' => 'This mod has no valid <code>bower.json</code> file.  If you are the owner please consider adding one to the repository, then click Update.',
                ]); ?>
            <?php } ?>

        </div>
    </div>

    <hr class="comments">
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = 'minetest-bower';
        (function () {
            var dsq = document.createElement('script');
            dsq.type = 'text/javascript';
            dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>

</div>
