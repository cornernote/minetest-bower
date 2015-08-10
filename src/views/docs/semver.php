<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Semantic Versioning';
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-bower-json-format">

    <h1><?= Html::encode($this->title) ?></h1>


    <h2>Summary</h2>

    Given a version number MAJOR.MINOR.PATCH, increment the:

    <ul>
        <li>MAJOR version when you make incompatible API changes,</li>
        <li>MINOR version when you add functionality in a backwards-compatible manner, and</li>
        <li>PATCH version when you make backwards-compatible bug fixes.</li>
        <li>Additional labels for pre-release and build metadata are available as extensions to the MAJOR.MINOR.PATCH format.</li>
    </ul>

    <p>More information is available at <a href="http://semver.org">semver.org</a>.</p>


    <h2>Creating Versions</h2>

    <p>To create a version of your mod, simply create a tag with the version number. If you are using GitHub you can goto
        <em>Releases</em> then click <em>Create a new relese</em>.</p>


    <h2>Dependancy Versions</h2>

    <ul>
        <li><code>1.2.3</code> - requires an exact version.</li>
        <li><code>^1.2.3</code> or <code>>=1.2.3 <2.0.0</code> - requires version
            <code>1.2.3</code> or above, but less than <code>2.0.0</code>.
        </li>
        <li><code>~1.2.3</code> or <code>>=1.2.3 <1.3.0</code> - requires version
            <code>1.2.3</code> or above, but less than <code>1.3.0</code>.
        </li>
    </ul>

    <p>More information is available at <a href="https://github.com/npm/node-semver">node-semver</a>.</p>


    <h2>Notes</h2>

    <p>Any version below <code>1.0.0</code> is considered alpha and may contain incompatible API changes.</p>

</div>
