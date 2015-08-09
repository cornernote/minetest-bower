<?php

/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\helpers\Html;

$this->title = 'Installation';
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-install">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <h2>Windows</h2>

            <ol>
                <li>Download and install <a href="http://nodejs.org/">nodejs</a>.</li>
                <li>Download and install <a href="http://git-scm.com/download/win">git</a>.</li>
            </ol>

            <p>Install bower</p>
            <pre>C:\> npm install -g bower</pre>

        </div>
        <div class="col-lg-4">
            <h2>Mac</h2>

            <ol>
                <li>Download and install <a href="http://nodejs.org/">nodejs</a>.</li>
                <li>Download and install <a href="http://git-scm.com/download/mac">git</a>.</li>
            </ol>

            <p>Install bower</p>
            <pre>$ npm install -g bower</pre>

        </div>
        <div class="col-lg-4">
            <h2>Ubuntu/Debian</h2>

            <p>Install nodejs, npm and git</p>
            <pre>$ sudo apt-get install nodejs npm git-core</pre>

            <p>Install bower</p>
            <pre>$ npm install -g bower</pre>

        </div>
    </div>

</div>
