<?php

namespace backend\controllers;

use moonland\phpexcel\Excel;
use Yii;
use common\models\DocumentComment\DocumentComment;
use backend\models\DocumentComment\DocumentCommentSearch;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;

/**
 * DocumentCommentController implements the CRUD actions for DocumentComment model.
 */
class CommentController extends BaseController
{
    /**
     * Lists all DocumentComment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing DocumentComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing DocumentComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionAdopt($id)
    {
        $this->findModel($id)->adopt();
        return $this->redirect(['index']);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionMultipleAdopt()
    {
        $id = Yii::$app->request->get('id');

        $all = DocumentComment::find()->where(['id' => $id])->all();
        foreach ($all as $model) {
            $model->adopt();
        }

        return $this->asJson(['message' => '通过成功']);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionMultipleDelete()
    {
        $id = Yii::$app->request->get('id');
        DocumentComment::deleteAll(['id' => $id]);
        return $this->asJson(['message' => '通过成功']);
    }

    /**
     * @return string
     */
    public function actionExcel()
    {
        $searchModel = new DocumentCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        ob_end_clean();
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=评论列表.xls");
        return Excel::export([
            'models' => $dataProvider->query->orderBy(['id' => SORT_DESC])->all(),
            'fileName' => '文档列表',
            'columns' => [
                [
                    'attribute' => 'id',
                    'header' => '记录ID'
                ],
                [
                    'header' => '文档名称',
                    'format' => 'text',
                    'value' => function ($model) {
                        return $model->doc_name;
                    }
                ],
                [
                    'attribute' => 'user_name',
                    'format' => 'text',
                    'header' => '用户昵称',
                ],
                [
                    'attribute' => 'score',
                    'format' => 'text',
                    'header' => '评分',
                ],
                [
                    'attribute' => 'content',
                    'format' => 'text',
                    'header' => '评论内容',
                ],
                [
                    'attribute' => 'status',
                    'format' => 'text',
                    'header' => '下载数',
                    'value' => function ($model) {
                        return $model->status ? '通过' : '审核中';
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'text',
                    'header' => '创建时间',
                    'value' => function ($model) {
                        return date('Y-m-d H:i:s', $model->created_at);
                    }
                ]
            ],
        ]);
    }


    /**
     * Finds the DocumentComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentComment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
