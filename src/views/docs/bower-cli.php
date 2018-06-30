<?php

/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\helpers\Html;

$this->title = 'Bower CLI';
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-install">

    <h1>Using Bower to Manage Mods</h1>

    <p>You can use Bower to install Minetest mods and dependency mods quickly
        and easily under Linux, Windows, and Mac OS X. Bower needs primarily two software packages named
        <a href="http://nodejs.org/">NodeJS</a> and <a href="http://git-scm.com/">Git</a>, which are easy to install.</p>

    <h2>Installation</h2>

    <div class="row">
        <div class="col-lg-4">
            <h2>Windows</h2>

            <ol>
                <li>Download and install <a href="http://nodejs.org/">nodejs</a>.</li>
                <li>Download and install <a href="http://git-scm.com/download/win">git</a>.</li>
            </ol>

            <p>Install bower</p>
            <pre class="prettyprint lang-bash">C:\> npm install -g bower</pre>

        </div>
        <div class="col-lg-4">
            <h2>Mac</h2>

            <ol>
                <li>Download and install <a href="http://nodejs.org/">nodejs</a>.</li>
                <li>Download and install <a href="http://git-scm.com/download/mac">git</a>.</li>
            </ol>

            <p>Install bower</p>
            <pre class="prettyprint lang-bash">$ npm install -g bower</pre>

        </div>
        <div class="col-lg-4">
            <h2>Ubuntu/Debian</h2>

            <p>Install nodejs, npm and git</p>
            <pre class="prettyprint lang-bash">$ sudo apt-get install nodejs npm git-core</pre>

            <p>Ubuntu users, link nodejs to node</p>
            <pre class="prettyprint lang-bash">$ sudo ln -s /usr/bin/nodejs /usr/bin/node</pre>

            <p>Install bower</p>
            <pre class="prettyprint lang-bash">$ sudo npm install -g bower</pre>

        </div>
    </div>

    <h2>Configuration</h2>

    <p>In order to connect to the minetest-bower registry you need to configure bower.</p>

    <p>Create a
        <code>.bowerrc</code> file in your home directory or minetest folder with the following contents.
    </p>
                <pre class="prettyprint lang-js">{
    "registry": "https://minetest-bower.herokuapp.com/",
    "directory" : "mods"
}</pre>

    <h2>Usage</h2>

    <div class="row">
        <div class="col-md-4">
            <h3>Install Mods</h3>

            <p>Install mods and their dependencies with <code>bower install</code>.</p>
            <pre class="prettyprint lang-bash">$ bower install &lt;mod&gt;</pre>
        </div>
        <div class="col-md-4">
            <h3>Search Mods</h3>

            <p>Find mods that you can install with
                <code>bower search</code> or <?= Html::a('browse the repository', ['/mod/index']) ?>.</p>
            <pre class="prettyprint lang-bash">$ bower search &lt;keyword&gt;

# for example
$ bower search rainbow</pre>
        </div>
        <div class="col-md-4">
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

</div>
