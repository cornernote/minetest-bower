<?php

/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\helpers\Html;

$this->title = 'Documentation';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Using Bower to Manage Mods and Dependencies</h2>

    <p>If you are familiar with CLI, you can use Minetest Bower to install Minetest mods and dependency mods quickly
        and easily under Linux, Windows, and Mac OS X. Minetest Bower needs primarily two software packages named
        NodeJS and Git, which are easy to install.</p>

    <div class="row">
        <div class="col-lg-6">

            <h3>Install Bower</h3>

            <p>Bower is a command line utility. It requires <a href="http://nodejs.org/">NodeJS and npm</a> and
                <a href="http://git-scm.com/">Git</a>.</p>
            <pre class="prettyprint lang-bash">$ npm install -g bower</pre>

            <p>Create a
                <code>.bowerrc</code> file in your home directory or minetest folder with the following contents.
            </p>
            <pre class="prettyprint lang-js">{
    "registry": "https://minetest-bower.herokuapp.com/",
    "directory" : "mods"
}</pre>
            <p><?= Html::a('Installation Guide &raquo;', ['/docs/install'], ['class' => 'btn btn-sm btn-default']); ?></p>

        </div>
        <div class="col-lg-6">

            <h3>Install Mods</h3>

            <p>Install mods and their dependencies with <code>bower install</code>.</p>
            <pre class="prettyprint lang-bash">$ bower install &lt;mod&gt;</pre>

            <h3>Search Mods</h3>

            <p>Find mods that you can install with
                <code>bower search</code> or <?= Html::a('browse the repository', ['/mod/index']) ?>.</p>
            <pre class="prettyprint lang-bash">$ bower search &lt;keyword&gt;

# for example
$ bower search rainbow</pre>

            <h3>Register Mods</h3>

            <p>Register mods with
                <code>bower register</code> or <?= Html::a('submit a mod online', ['/mod/create']) ?>.</p>
            <pre class="prettyprint lang-bash">$ bower register &lt;my_mod_name&gt; &lt;git_endpoint&gt;

# for example
$ bower register rainbows https://github.com/user/rainbows.git</pre>

            <p>Optionally, to add more information about your mod such as description, screenshots, authors and
                licence, you can submit a JSON file along with your mod. To do so add a
                <code>bower.json</code> file to to your mod's git repository. For the format to be
                used, <?= Html::a('click here', ['/docs/bower-format']); ?>.
            </p>

        </div>
    </div>

    <h2>Other Documentation</h2>

    <?= Nav::widget([
        'items' => [
            ['label' => 'Installation', 'url' => ['/docs/install']],
            ['label' => 'bower.json Format', 'url' => ['/docs/bower-format']],
            ['label' => 'Update Webhook', 'url' => ['/docs/update-webhook']],
            ['label' => 'Semantic Versioning', 'url' => ['/docs/semver']],
            ['label' => 'Registry Requests using cURL', 'url' => ['/docs/registry-curl']],
        ],
    ]) ?>

</div>
