<?php

namespace app\models;

use app\components\Git;
use app\components\Serialize;
use app\models\query\PackageQuery;
use bigpaulie\fancybox\FancyBox;
use cebe\markdown\GithubMarkdown;
use Github\Client;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\widgets\Menu;

/**
 * This is the model class for table "{{%package}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $hits
 * @property string $bower
 * @property string $readme
 * @property string $readme_format
 * @property string $description
 * @property string $homepage
 * @property string $forum
 * @property string $keywords
 * @property string|array $authors
 * @property string|array $screenshots
 * @property string|array $license
 * @property string $created_at
 * @property string $updated_at
 */
class Package extends ActiveRecord
{
    /**
     * @var array
     */
    public $serializeAttributes = ['bower', 'screenshots', 'authors', 'license', 'readme'];

    /**
     * @var bool
     */
    public $serialized = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%package}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255],
            [['name', 'url'], 'unique'],
            [['name', 'url'], 'trim'],
            [['name'], 'match', 'pattern' => '/^[-a-z0-9_]+$/', 'message' => '{attribute} can only contain lowercase letters, numbers, "_" and "-"'],
            [['url'], 'match', 'pattern' => '%(git|http(s)?)(:(//)?)([\w./\-~]+)(\.git)%', 'message' => '{attribute} must be a valid git endpoint.'],
            [['url'], function ($attribute) {
                if ($this->isNewRecord && Git::getFile($this->$attribute) === false) {
                    $this->addError($attribute, 'Could not fetch remote repository.');
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'URL',
            'hits' => 'Hits',
            'bower' => 'Bower',
            'readme' => 'Readme',
            'description' => 'Description',
            'homepage' => 'Homepage',
            'forum' => 'Forum',
            'keywords' => 'Keywords',
            'authors' => 'Authors',
            'license' => 'License',
            'screenshots' => 'Screenshots',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return PackageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PackageQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->serialized = true;
        $this->unserializeAttributes(false);
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        // trim description
        if (strlen($this->description) > 140) {
            $this->description = substr($this->description, 0, 137) . '...';
        }
        // set hits
        if ($this->hits === null) {
            $this->hits = 0;
        }
        $this->serializeAttributes();
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->serialized = true;
        $this->unserializeAttributes();
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function getDirtyAttributes($names = null)
    {
        if ($names === null) {
            $names = $this->attributes();
        }
        $names = array_flip($names);
        $attributes = [];
        $oldAttributes = $this->oldAttributes;
        if ($oldAttributes === null) {
            foreach ($this->attributes as $name => $value) {
                if (isset($names[$name])) {
                    $attributes[$name] = $value;
                }
            }
        } else {
            foreach ($this->serializeAttributes as $attribute) {
                if (isset($oldAttributes[$attribute])) {
                    $oldAttributes[$attribute] = Serialize::unserialize($oldAttributes[$attribute]);
                }
            }
            foreach ($this->attributes as $name => $value) {
                if (isset($names[$name]) && (!array_key_exists($name, $oldAttributes) || $value !== $oldAttributes[$name])) {
                    $attributes[$name] = $value;
                }
            }
        }
        return $attributes;
    }

    /**
     * @param bool $lob
     */
    public function serializeAttributes($lob = true)
    {
        if (!$this->serialized) {
            foreach ($this->serializeAttributes as $attribute) {
                if ($lob) {
                    $this->$attribute = [Serialize::serialize($this->$attribute), \PDO::PARAM_LOB];
                } else {
                    $this->$attribute = Serialize::serialize($this->$attribute);
                }
            }
            $this->serialized = true;
        }
    }

    /**
     * @param bool $lob
     */
    public function unserializeAttributes($lob = true)
    {
        if ($this->serialized) {
            foreach ($this->serializeAttributes as $attribute) {
                if ($lob) {
                    $_attribute = $this->$attribute;
                    $this->$attribute = Serialize::unserialize($_attribute[0]);
                } else {
                    $this->$attribute = Serialize::unserialize($this->$attribute);
                }
            }
            $this->serialized = false;
        }
    }

    /**
     * @return bool
     */
    public function harvestModInfo()
    {
        // fetch bower.json
        $this->bower = json_decode(Git::getFile($this->url, 'bower.json'), true);
        if ($this->bower) {
            // set fields from bower
            if (isset($this->bower['description'])) {
                $this->description = $this->bower['description'];
            }
            if (isset($this->bower['homepage'])) {
                $this->homepage = $this->bower['homepage'];
            }
            if (isset($this->bower['forum'])) {
                $this->forum = $this->bower['forum'];
            }
            if (isset($this->bower['keywords'])) {
                $this->keywords = implode(',', $this->bower['keywords']);
            }
            if (isset($this->bower['authors'])) {
                $this->authors = $this->bower['authors'];
            }
            if (isset($this->bower['screenshots'])) {
                $this->screenshots = $this->bower['screenshots'];
            }
            if (isset($this->bower['license'])) {
                $this->license = $this->bower['license'];
            }
        } else {
            $this->bower = '';
            // no bower, get from github api
            if (strpos($this->url, 'github.com')) {
                $url = parse_url(Git::getUrl($this->url));
                $path = explode('/', trim($url['path'], '/'));
                $github = new Client();
                $github->authenticate(getenv('GITHUB_TOKEN'), Client::AUTH_URL_TOKEN);
                $repo = false;
                try {
                    $repo = $github->api('repo')->show($path[0], $path[1]);
                } catch (\Exception $e) {
                    // error fetching repo, just proceed
                }
                if ($repo) {
                    if (isset($repo['description'])) {
                        $this->description = $repo['description'];
                    }
                    if (isset($repo['homepage'])) {
                        $this->homepage = $repo['homepage'];
                    } elseif (isset($repo['html_url'])) {
                        $this->homepage = $repo['html_url'];
                    }
                    if (isset($repo['owner']['login'])) {
                        $this->authors = [$repo['owner']['login']];
                    }
                }
            }
        }

        // fetch screenshot
        if (!$this->screenshots) {
            $file = Git::getUrl($this->url, 'screenshot.png');
            if (strpos(@get_headers($file)[0], '200')) {
                $this->screenshots = [$file];
            }
        }

        // fetch description
        if (!$this->description) {
            $this->description = Git::getFile($this->url, 'description.txt');
        }

        // fetch authors
        if (!$this->authors && !strpos($this->url, 'repo.or.cz')) {
            $url = parse_url(Git::getUrl($this->url));
            $path = explode('/', trim($url['path'], '/'));
            $this->authors = [$path[0]];
        }

        // fetch readme
        foreach (['README.md', 'readme.md', 'Readme.md'] as $file) {
            $this->readme = Git::getFile($this->url, $file);
            if ($this->readme) {
                $this->readme_format = 'markdown';
                break;
            }
        }
        if (!$this->readme) {
            foreach (['README.txt', 'readme.txt', 'Readme.txt', 'README', 'readme'] as $file) {
                $text = strtolower($file) != 'readme';
                if (!$text) {
                    foreach (get_headers(Git::getUrl($this->url, $file)) as $header) {
                        if ($header == 'Content-Type: text/plain') {
                            $text = true;
                        }
                    }
                }
                if ($text) {
                    $this->readme = Git::getFile($this->url, $file);
                    if ($this->readme) {
                        break;
                    }
                }
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function getScreenshotsHtml()
    {
        $screenshots = [];
        if ($this->screenshots) {
            foreach ($this->screenshots as $screenshot) {
                $screenshots[] = FancyBox::widget([
                    'type' => 'image',
                    'item' => [
                        'href' => $screenshot,
                        'src' => $screenshot,
                    ],
                    'htmlOptions' => [
                        'imageOptions' => [
                            'class' => 'thumbnail',
                        ],
                    ],
                ]);
            }
        }
        return $screenshots ? implode('', $screenshots) : null;
    }

    /**
     * @return string
     */
    public function getAuthorsHtml()
    {
        $authors = [];
        if ($this->authors) {
            foreach ($this->authors as $author) {
                $authors[] = '<li>' . $this->formatAuthor($author) . '</li>';
            }
        }
        return $authors ? '<ul class="list-unstyled" style="margin-bottom:0">' . implode('', $authors) . '</ul>' : null;
    }

    /**
     * @param $author
     * @return string
     */
    public function formatAuthor($author)
    {
        $authorInfo = [];
        if (is_array($author)) {
            if (isset($author['name'])) {
                $authorInfo['name'] = $author['name'];
            }
            if (isset($author['email'])) {
                $authorInfo['email'] = Html::a($author['email'], 'mailto:' . $author['email']);
            }
            if (isset($author['homepage'])) {
                $authorInfo['homepage'] = Html::a($author['homepage'], $author['homepage']);
            }
            return implode(' ', $authorInfo);
        } else {
            // https://github.com/jonschlinkert/author-regex/blob/master/index.js
            preg_match_all('/^([^<(]+?)?[ \t]*(?:<([^>(]+?)>)?[ \t]*(?:\(([^)]+?)\)|$)/', $author, $result, PREG_SET_ORDER);
            if (isset($result[0][1])) {
                $authorInfo['name'] = $result[0][1];
            }
            if (isset($result[0][2])) {
                $authorInfo['email'] = Html::a($result[0][2], 'mailto:' . $result[0][2]);
            }
            if (isset($result[0][3])) {
                $authorInfo['homepage'] = Html::a($result[0][3], $result[0][3]);
            }
        }
        return implode(' ', $authorInfo);
    }

    /**
     * @return string
     */
    public function getLicenseHtml()
    {
        $licenses = [];
        if ($this->license) {
            if (is_array($this->license)) {
                foreach ($this->license as $license) {
                    $licenses[] = $license;
                }
            } else {
                $licenses[] = $this->license;
            }
        }
        return $licenses ? implode('<br>', $licenses) : null;
    }

    /**
     * @param bool $inline
     * @return string
     * @throws \Exception
     */
    public function getLinksHtml($inline = true)
    {
        $items = [];
        $items[] = ['label' => 'Download', 'url' => Git::getDownload($this->url)];
        if ($this->homepage && $this->homepage != Git::getUrl($this->url) && $this->homepage != $this->forum) {
            $items[] = ['label' => 'Homepage', 'url' => $this->homepage];
        }
        if ($this->forum) {
            $items[] = ['label' => 'Forum', 'url' => $this->forum];
        }
        $items[] = ['label' => 'Project', 'url' => Git::getUrl($this->url)];
        return Menu::widget([
            'options' => ['class' => 'list-unstyled' . ($inline ? ' list-inline' : ''), 'style' => 'margin-bottom:0;'],
            'items' => $items,
        ]);
    }

    /**
     * @return string
     */
    public function getReadmeHtml()
    {
        if ($this->readme) {
            if ($this->readme_format == 'markdown') {
                $parser = new GithubMarkdown();
                return $parser->parse($this->readme);
            }
            if ($this->readme_format == 'text') {
                $readme = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1">$1</a>', $this->readme);
                return '<pre class="readme">' . $readme . '</pre>';
            }
        }
        return '';
    }

    /**
     * @return string
     */
    public function getBowerJson()
    {
        if ($this->bower) {
            $bower = json_encode($this->bower, JSON_PRETTY_PRINT);
        } else {
            $bower = json_encode([
                'name' => $this->name,
                'description' => $this->description ? $this->description : 'Description of your mod.',
                'keywords' => [$this->name],
                'homepage' => $this->homepage ? $this->homepage : Git::getUrl($this->url),
                'screenshots' => $this->screenshots ? $this->screenshots : ['https://example.com/screenshot1.png'],
                'authors' => $this->authors ? $this->authors : ['Your Name'],
                //'license' => $this->license ? $this->license : 'WTFPL',
            ], JSON_PRETTY_PRINT);
        }
        $bower = str_replace('\/', '/', $bower);
        return '<pre>' . $bower . '</pre>';
    }
}
