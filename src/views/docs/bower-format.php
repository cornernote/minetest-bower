<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'bower.json Format';
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docs-bower-json-format">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Example <code>bower.json</code></h2>

    <pre>{
  "name": "my_example",
  "description": "Description of my minetest mod.",
  "keywords": [
    "example",
    "rainbow"
  ],
  "homepage": "http://example.com/",
  "screenshots": [
    "http://example.com/screenshot1.png",
    "http://example.com/screenshot2.png"
  ],
  "authors": [
    "Example Author &lt;author@example.com&gt;"
  ],
  "license": "WTFPL",
  "dependencies": {
    "some_mod": "~1.2.3",
    "another_mod": "~4.2.11"
  },
  "ignore": [
    "**/.*",
    "mods",
    "test"
  ]
}</pre>

    <h2>Specifications</h2>

    <h3><code>name</code></h3>

    <p><strong>Required</strong></p>

    <p>Type: <code>String</code></p>

    <p>The name of the package as stored in the registry.</p>
    <ul>
        <li>Must be unique.</li>
        <li>Should be slug style for simplicity, consistency and compatibility. Example: <code>unicorn_cake</code></li>
        <li>Lowercase, a-z, can contain digits, 0-9, can contain dash or dot but not start/end with them.</li>
        <li>Consecutive dashes or dots not allowed.</li>
        <li>50 characters or less.</li>
    </ul>


    <h3><code>description</code></h3>

    <p><strong>Recommended</strong></p>

    <p>Type: <code>String</code></p>

    <p>Any character. Max 140.</p>

    <p>Help users identify and search for your package with a brief description. Describe what your package does, rather than what it's made of. Will be displayed in search/lookup results on the CLI and the website that can be used to search for packages.</p>


    <h3><code>keywords</code></h3>

    <p><strong>Recommended</strong></p>

    <p>Type: <code>Array</code> of <code>String</code></p>

    <p>Same format requirements as <code>name</code>.</p>

    <p>Used for search by keyword. Helps make your package easier to discover without people needing to know its name.</p>


    <h3><code>homepage</code></h3>

    <p><strong>Recommended</strong></p>

    <p>Type: <code>String</code></p>

    <p>URL to learn more about the package. Falls back to GitHub/BitBucket project if not specified and it's a GitHub or BitBucket endpoint.</p>


    <h3><code>screenshots</code></h3>

    <p><strong>Recommended</strong></p>

    <p>Type: <code>Array</code> of <code>String</code></p>

    <p>Used to display screenshots of your package.</p>


    <h3><code>authors</code></h3>

    <p><strong>Recommended</strong></p>

    <p>Type: <code>Array</code> of (<code>String</code> or <code>Object</code>)</p>

    <p>A list of people that authored the contents of the package.</p>

    <p>Either:</p>

    <pre>"authors": [
    "John Doe",
    "John Doe &lt;john@doe.com&gt;",
    "John Doe &lt;john@doe.com&gt; (http://johndoe.com)"
]</pre>

    <p>or:</p>

    <pre>"authors": [
    { "name": "John Doe" },
    { "name": "John Doe", "email": "john@doe.com" },
    { "name": "John Doe", "email": "john@doe.com", "homepage": "http://johndoe.com" }
]</pre>


    <h3><code>license</code></h3>

    <p><strong>Recommended</strong></p>

    <p>Type: <code>String</code> or <code>Array</code> of <code>String</code></p>

    <p><a href="https://spdx.org/licenses/">SPDX license identifier</a> or path/url to a license.</p>


    <h3><code>dependencies</code></h3>

    <p><strong>Optional</strong></p>

    <p>Type: <code>Object</code></p>

    <p>Dependencies are specified with a simple hash of package name to a semver compatible identifier or URL.</p>

    <ul>
        <li>Key must be a valid <code>name</code>.</li>
        <li>Value must be a valid
            <a href="https://github.com/npm/node-semver#ranges">semver range</a>, a Git URL, or a URL (inc. tarball and zipball).
        </li>
        <li>Git URLs can be restricted to a reference (revision SHA, branch, or tag) by appending it after a hash, e.g.
            <code>https://github.com/owner/package.git#branch</code>.
        </li>
        <li>Value can be an owner/package shorthand, i.e. owner/package. By default, the shorthand resolves to GitHub -> git://github.com/{{owner}}/{{package}}.git. This may be changed in
            <code>.bowerrc</code> <a href="http://bower.io/docs/config/#shorthand-resolver">shorthand_resolver</a>.
        </li>
        <li>Local paths may be used as values for local development, but they will be disallowed when registering.</li>
    </ul>


    <h3><code>ignore</code></h3>

    <p><strong>Recommended</strong></p>

    <p>Type: <code>Array</code> of <code>String</code></p>

    <p>A list of files for Bower to ignore when installing your package.</p>

    <p>Note: symbolic links will always be ignored. However `bower.json` will never be ignored.</p>

    <p>The ignore rules follow the same rules specified in the
        <a href="http://git-scm.com/docs/gitignore">gitignore pattern spec</a>.</p>


</div>
