<?php

namespace app\models\query;

use yii\db\ActiveQuery;

class PostQuery extends ActiveQuery
{
    public function forUser($userId)
    {
        return $this->andWhere(['user_id' => $userId]);
    }

    public function latest($limit)
    {
        return $this->limit($limit)->orderBy(['id' => SORT_DESC]);
    }

    /**
     * @inheritdoc
     * @return \app\models\Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
