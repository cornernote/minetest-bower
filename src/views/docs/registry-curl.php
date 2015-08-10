<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Registry Requests using cURL';
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-registry-curl">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Create Mod</h2>

    <pre class="prettyprint lang-bash">curl https://minetest-bower.herokuapp.com/packages -v -F 'name=rainbows' -F 'url=https://github.com/user/rainbows.git'</pre>

    <h2>Find Mod</h2>

    <pre class="prettyprint lang-bash">curl https://minetest-bower.herokuapp.com/packages/rainbows</pre>

    <p>returns:</p>

    <pre class="prettyprint lang-js">{"name":"rainbows","url":"https://github.com/user/rainbows.git"}</pre>

    <h2>Search Mod</h2>

    <pre class="prettyprint lang-bash">curl https://minetest-bower.herokuapp.com/packages/search/rainbows</pre>

    <p>returns:</p>

    <pre class="prettyprint lang-js">[{"name":"rainbows","url":"https://github.com/user/rainbows.git"}, {"name":"rainbows_lib","url":"git://github.com/user/rainbows_lib.git"}]</pre>

</div>
