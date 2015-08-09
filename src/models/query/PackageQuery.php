<?php

namespace app\models\query;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Package]].
 *
 * @see \app\models\Package
 */
class PackageQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     * @return \app\models\Package[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Package|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}