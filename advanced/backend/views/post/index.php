<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= \backend\components\HeadTitleComponent::widget([
    'label'   => Html::encode($this->title),
    'buttons' => [
        ['title' => 'Create post', 'url' => ['create'], ['class' => 'btn btn-success btn-sm']]
    ]
]) ?>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'draft:boolean',
                ['class' => 'backend\utilities\AuditColumn'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['view', 'slug' => $model->slug]));
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['update', 'slug' => $model->slug]));
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(['delete', 'slug' => $model->slug]));
                        }
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
