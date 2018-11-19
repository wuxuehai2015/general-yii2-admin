<?php

namespace backend\controllers;

use common\models\SystemConfig\SystemConfig;
use common\models\UserPointHistory\UserPointHistory;
use moonland\phpexcel\Excel;
use Yii;
use backend\models\User\User;
use backend\models\User\UserSearch;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;

/**
 * MemberController implements the CRUD actions for User model.
 */
class MemberController extends BaseController
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->avatar = SystemConfig::getValueByName('default_avatar');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAddPoint($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            UserPointHistory::change($model, $model->add_point, UserPointHistory::TYPE_BACKEND_ADD);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('add-point', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @return string
     */
    public function actionExcel()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        ob_end_clean();
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=会员列表.xls");
        return Excel::export([
            'models' => $dataProvider->query->orderBy(['id' => SORT_DESC])->all(),
            'columns' => [
                [
                    'attribute' => 'id',
                    'header' => '用户ID'
                ],
                [
                    'attribute' => 'username',
                    'header' => '用户昵称'
                ],
                [
                    'attribute' => 'mobile',
                    'header' => '用户手机'
                ],
                [
                    'attribute' => 'status',
                    'header' => '状态',
                    'value' => function($model){
                        return $model->status ? '正常' : '封禁';
                    }
                ],
                [
                    'attribute' => 'points',
                    'format' => 'text',
                    'header' => '用户积分',
                ],
                [
                    'attribute' => 'allow_upload_doc',
                    'header' => '允许上传文档',
                    'value' => function($model){
                        return $model->allow_upload_doc ? '是' : '否';
                    }
                ],
                [
                    'attribute' => 'is_admin',
                    'header' => '后台管理员',
                    'value' => function($model){
                        return $model->is_admin ? '是' : '否';
                    }
                ],
                [
                    'attribute' => 'wx_open_id',
                    'header' => '绑定微信',
                    'value' => function($model){
                        return $model->wx_open_id ? '是' : '否';
                    }
                ],
                [
                    'attribute' => 'wb_open_id',
                    'header' => '绑定微博',
                    'value' => function($model){
                        return $model->wb_open_id ? '是' : '否';
                    }
                ],
                [
                    'attribute' => 'login_continuity_count',
                    'header' => '联系签到天数',
                    'value' => function($model){
                        return $model->login_continuity_count;
                    }
                ],
                [
                    'attribute' => 'last_login_at',
                    'header' => '最后登录时间',
                    'value' => function($model){
                        return date('Y-m-d H:i:s', $model->last_login_at);
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'text',
                    'header' => '注册时间',
                    'value' => function($model){
                        return date('Y-m-d H:i:s', $model->created_at);
                    }
                ]
            ],
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
