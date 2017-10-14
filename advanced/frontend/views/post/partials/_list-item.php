<?php

/* @var \common\models\Post $model */

use yii\helpers\Html;

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?= Html::encode($model->title) ?></div>
            <div class="panel-body"><?= $model->description ?></div>
        </div>
    </div>
</div>
