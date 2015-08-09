<?php

namespace app\models;

use app\components\Git;
use app\models\query\PackageQuery;
use cebe\markdown\GithubMarkdown;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%package}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $hits
 * @property string $bower
 * @property string $readme
 * @property string $description
 * @property string $homepage
 * @property string $keywords
 * @property string $screenshot
 * @property string $created_at
 * @property string $updated_at
 */
class Package extends ActiveRecord
{

    /**
     * @var array
     */
    public $bowerData;

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
            [['url'], function ($attribute, $params) {
                if (Git::getFile($this->$attribute, '') === false) {
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
            'keywords' => 'Keywords',
            'screenshot' => 'Screenshot',
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
            [
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
        $this->bowerData = json_decode($this->bower, true);
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->harvestModInfo();
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return bool
     */
    public function harvestModInfo()
    {
        $this->readme = Git::getFile($this->url, 'README.md');
        $this->bower = Git::getFile($this->url, 'bower.json');
        if (!$this->bower) {
            return false;
        }
        $this->bowerData = json_decode($this->bower, true);
        if (isset($this->bowerData['description'])) {
            $this->description = $this->bowerData['description'];
        }
        $this->homepage = isset($this->bowerData['homepage']) ? $this->bowerData['homepage'] : Git::getUrl($this->url);
        if (isset($this->bowerData['keywords'])) {
            $this->keywords = implode(',', $this->bowerData['keywords']);
        }
        if (isset($this->bowerData['screenshots'])) {
            $this->screenshot = $this->bowerData['screenshots'][0];
        }
        return true;
    }

    /**
     * @return string
     */
    public function getScreenshotsHtml()
    {
        $screenshots = [];
        if (isset($this->bowerData['screenshots'])) {
            foreach ($this->bowerData['screenshots'] as $screenshot) {
                $screenshots[] = Html::img($screenshot, [
                    'style' => 'max-width:100%',
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
        if (isset($this->bowerData['authors'])) {
            foreach ($this->bowerData['authors'] as $author) {
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
        if (isset($this->bowerData['license'])) {
            if (is_array($this->bowerData['license'])) {
                foreach ($this->bowerData['license'] as $license) {
                    $licenses[] = $license;
                }
            } else {
                $licenses[] = $this->bowerData['license'];
            }
        }
        return $licenses ? implode('<br>', $licenses) : null;
    }

    /**
     * @return string
     */
    public function getRepositoryHtml()
    {
        $url = Git::getUrl($this->url);
        return Html::a($url, $url);
    }

    /**
     * @return string
     */
    public function getReadmeHtml()
    {
        $parser = new GithubMarkdown();
        return $parser->parse($this->readme);
    }
}
