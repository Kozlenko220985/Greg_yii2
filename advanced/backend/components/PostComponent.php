<?php

namespace backend\components;

use common\models\Post;
use yii\base\Component;

class PostComponent extends Component
{

    /**
     * @var integer $quantity
     */
    public $quantity;

    private $posts;

    public function init()
    {
        $this->setPosts();
        return $this->getPosts();
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @return void
     */
    private function setPosts()
    {
        $this->posts = Post::find()->asArray()->active()->all();
        $this->setQuantity();
    }

    private function setQuantity()
    {
        $this->quantity = count($this->posts);
    }

}