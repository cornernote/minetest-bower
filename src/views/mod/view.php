<?php

use app\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Package */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-view">

    <div class="row">
        <div class="col-lg-8">
            <?= $model->getReadmeHtml() ?>
        </div>
        <div class="col-lg-4 small">
            <?= DetailView::widget([
                'model' => $model,
                'hideIfEmpty' => true,
                'attributes' => [
                    'name',
                    'description',
                    [
                        'label' => 'Keywords',
                        'value' => $model->getKeywordsHtml(),
                        'format' => 'raw',
                    ],
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
                <?php
                $readmeClass = 'btn-default';
                if ($model->readme && $model->readme_format == 'markdown') {
                    $readmeClass = 'btn-success';
                }
                ?>
                <?= Html::a('README.md <i class="glyphicon glyphicon-chevron-right"></i>', ['readme', 'name' => $model->name], ['class' => 'btn btn-sm ' . $readmeClass]); ?>
                &nbsp;&nbsp;
                <?php
                $bowerClass = 'btn-default';
                if ($model->bower) {
                    $bowerClass = 'btn-success';
                }
                ?>
                <?= Html::a('bower.json <i class="glyphicon glyphicon-chevron-right"></i>', ['bower', 'name' => $model->name], ['class' => 'btn btn-sm ' . $bowerClass]); ?>
            </p>

            <div class="text-center">
                <?php
                if ($model->screenshots) {
                    echo $model->getScreenshotsHtml();
                } else {
                    echo Html::a(Html::img('@web/img/no-image.png', ['class' => 'thumbnail']), ['screenshots', 'name' => $model->name]);
                }
                ?>
            </div>

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
