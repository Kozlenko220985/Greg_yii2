<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use frontend\models\search\PostSearch;

class PostController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

}