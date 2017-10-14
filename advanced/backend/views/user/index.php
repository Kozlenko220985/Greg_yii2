<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= \backend\components\HeadTitleComponent::widget([
    'label'   => Html::encode($this->title),
    'buttons' => [
        ['title' => 'Create user', 'url' => ['create'], ['class' => 'btn btn-success btn-sm']],
        ['title' => 'Delete all users', 'url' => ['delete-all'], ['class' => 'btn btn-danger btn-sm']]
    ]
]) ?>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'email:email',
                'username',
                'created_at:datetime',
                'updated_at:datetime',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
