<?php

namespace backend\controllers;

use common\models\Tag;
use common\models\TagsToPost;
use Yii;
use yii\filters\{
    AccessControl, VerbFilter
};
use yii\helpers\Url;
use yii\web\{
    Controller, NotFoundHttpException, UploadedFile
};

use backend\models\Post;
use backend\models\search\PostSearch;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param  string $slug
     * @return mixed
     */
    public function actionView($slug)
    {
        return $this->render('view', [
            'model' => $this->findModel($slug),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $db   = Yii::$app->db;
            $tags = explode(',', $model->relatedTags);

            if (($transaction = $db->getTransaction()) === null) {
                $transaction = $db->beginTransaction();
            }

            try {
                $flag = $model->save();

                if(!$flag) {
                    $transaction->rollBack();
                }

                foreach ($tags as $item) {
                    $item = trim($item);
                    $tag = Tag::findOne(['name' => $item]);
                    if(empty($tag)){
                        $tag = new Tag([
                            'name' => $item
                        ]);
                    }

                    $flag = $flag && $tag->save();

                    if(!$flag) {
                        $transaction->rollBack();
                    }

                    (new TagsToPost([
                        'post_id' => $model->id,
                        'tag_id'  => $tag->id
                    ]))->save();
                }

                $transaction->commit();

            } catch (\Exception $exception) {
                $transaction->rollBack();
            }



            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  string $slug
     * @return mixed
     */
    public function actionUpdate($slug)
    {
        $model = $this->findModel($slug);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  string $slug
     * @return mixed
     */
    public function actionDelete($slug)
    {
        $this->findModel($slug)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  string $slug
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Post::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
