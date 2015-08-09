<?php

namespace app\models;

use app\components\Git;
use app\models\query\PackageQuery;
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
            [['url'], 'match', 'pattern' => '%(git|http(s)?)(:(//)?)([\w./\-~]+)(\.git)%', 'message' => '{attribute} must be a valid git endpoint on github or bitbucket.'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->bower = Git::getFile($this->url, 'bower.json');
            $this->setBowerData();
        }
        return parent::beforeSave($insert);
    }

    /**
     *
     */
    public function setBowerData()
    {
        $bower = json_decode($this->bower, true);
        if (isset($bower['description'])) {
            $this->description = $bower['description'];
        }
        $this->homepage = isset($bower['homepage']) ? $bower['homepage'] : Git::getUrl($this->url);
        if (isset($bower['keywords'])) {
            $this->keywords = implode(',', $bower['keywords']);
        }
        if (isset($bower['screenshots'])) {
            $this->screenshot = $bower['screenshots'][0];
        }
    }

    /**
     * @return string
     */
    public function getScreenshotsHtml()
    {
        $screenshots = [];
        $bower = json_decode($this->bower, true);
        if (isset($bower['screenshots'])) {
            foreach ($bower['screenshots'] as $screenshot) {
                $screenshots[] = Html::img($screenshot, [
                    'style' => 'max-width:100%',
                ]);
            }
        }
        return implode('', $screenshots);
    }

}
