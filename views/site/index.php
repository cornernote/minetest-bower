<?php

/* @var $this yii\web\View */

$this->title = 'Minetest Bower';
$this->params['jumbotron'] = '/site/_index-jumbotron';

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Install Bower</h2>

                <p>Bower is a command line utility. Install it with npm.</p>
                <pre>$ npm install -g bower</pre>
                <p>Bower requires <a href="http://nodejs.org/">Node</a> and npm and <a href="http://git-scm.com/">Git</a>.</p>

                <h2>Configure Bower</h2>
                <p>Create <code>.bowerrc</code> in your home directory or minetest folder:</p>
                <pre>{
    "registry": "https://minetest-bower.herokuapp.com/",
    "directory" : "mods"
}</pre>
            </div>
            <div class="col-lg-6">
                <h2>Install Packages</h2>

                <p>Install packages with <code>bower install</code>.</p>
                <pre>$ bower install &lt;package&gt;</pre>

                <h2>Create Packages</h2>
                <p>Create packages with <code>bower register</code>.</p>
                <pre>$ bower register &lt;name&gt; &lt;url&gt;

$ bower register mymod git://github.com/username/mymod.git</pre>

                <!--
                <h2>Search Packages</h2>
                -->

            </div>
        </div>

    </div>
</div>
