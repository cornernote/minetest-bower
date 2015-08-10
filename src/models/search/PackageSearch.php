<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Package;

/**
 * PackageSearch represents the model behind the search form about `app\models\Package`.
 */
class PackageSearch extends Package
{

    /**
     * @var string
     */
    public $search;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['search', 'keywords', 'name', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Package::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->search) {
            $query->andFilterWhere([
                'or',
                ['like', 'name', $this->search],
                ['like', 'keywords', $this->search],
            ]);
        }

        //$query->andFilterWhere([
        //    'id' => $this->id,
        //    'hits' => $this->hits,
        //    'created_at' => $this->created_at,
        //    'updated_at' => $this->updated_at,
        //]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords]);

        return $dataProvider;
    }
}
