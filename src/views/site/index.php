<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Minetest Bower';
$this->params['jumbotron'] = '/site/_index-jumbotron';

?>
<div class="site-index">

    <div class="body-content">

        <h2>About Minetest Bower</h2>

        <p>Minetest Bower is a Minetest mod repository. If you are familiar with CLI, you can use Minetest Bower to install specified Minetest mods and dependency mods quickly and easily under Linux, Windows, and Mac OS X. Minetest Bower needs primarily two software packages named NodeJS and Git, which are easy to install.</p>

        <p>The repository is unmoderated. Anybody may submit mods using one of several different approaches. Different versions by different people of similar mods are permitted but each version must have different names.</p>

        <p>If you'd like to run a Minetest Bower mirror, this is encouraged and simple to set up. Simply copy the <?= Html::a('this JSON file', ['/package/index']) ?> to your website and update it periodically.</p>

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

                <h2>Install Mods</h2>

                <p>Install mods with <code>bower install</code>.</p>
                <pre>$ bower install &lt;mod&gt;</pre>

            </div>
            <div class="col-lg-6">

                <h2>Register Mods</h2>

                <p>Register mods with
                    <code>bower register</code> or <?= Html::a('submit a mod online', ['/mod/create']) ?>.</p>
                <pre>$ bower register &lt;my_mod_name&gt; &lt;git_endpoint&gt;

# for example
$ bower register rainbows https://github.com/user/rainbows.git</pre>

                <h2>Mod Information</h2>

                <p>Optionally, to add more information about your mod such as description, screenshots, and your own remarks, you can submit a JSON file along with your mod. To do so add a <?= Html::a('bower.json', ['/docs/bower-format']); ?> file to your mod's repository.</p>
                
            </div>
        </div>

    </div>
</div>
