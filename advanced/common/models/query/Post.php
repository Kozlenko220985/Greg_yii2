<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Post]].
 *
 * @see \common\models\Post
 */
class Post extends \yii\db\ActiveQuery
{

    public function active()
    {
        return $this->andWhere(['draft' => false]);
    }

    /**
     * @inheritdoc
     * @return \common\models\Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
