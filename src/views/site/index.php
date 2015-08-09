<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Minetest Bower';
$this->params['jumbotron'] = '/site/_index-jumbotron';

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Install Bower</h2>

                <p>Bower is a command line utility. It requires <a href="http://nodejs.org/">NodeJS and npm</a> and
                    <a href="http://git-scm.com/">Git</a>.</p>
                <pre>$ npm install -g bower</pre>

                <p>Create a
                    <code>.bowerrc</code> file in your home directory or minetest folder with the following contents.
                </p>
                <pre>{
    "registry": "https://minetest-bower.herokuapp.com/",
    "directory" : "mods"
}</pre>
                <p><?= Html::a('Installation Guide &raquo;', ['/docs/install'], ['class' => 'btn btn-sm btn-default']); ?></p>

            </div>
            <div class="col-lg-6">
                <h2>Install Mods</h2>

                <p>Install mods with <code>bower install</code>.</p>
                <pre>$ bower install &lt;mod&gt;</pre>

                <h2>Register Mods</h2>

                <p>Register mods with
                    <code>bower register</code> or <?= Html::a('submit a mod online', ['/mod/create']) ?>.</p>
                <pre>$ bower register &lt;my_mod_name&gt; &lt;git_endpoint&gt;

# for example
$ bower register example https://github.com/user/example.git</pre>

                <h2>Mod Information</h2>

                <p>Mod information is collected from a <code>bower.json</code> file in the repository</p>

                <p><?= Html::a('bower.json Format  &raquo;', ['/docs/bower-format'], ['class' => 'btn btn-sm btn-default']); ?></p>

            </div>
        </div>

    </div>
</div>
