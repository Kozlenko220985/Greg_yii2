<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts'

?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'partials/_list-item',
]); ?>
