<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\User\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '会员管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
        <?= Html::a(Yii::t('app', '导出Excel'), ['excel'] + Yii::$app->request->get(), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php  //$this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                [
                    'label' => '用户ID',
                    'attribute' => 'id',
                    'format' => 'raw',
                    'filter' => Html::textInput('UserSearch[id]', $searchModel->id, ['class' => 'form-control']),
                    'value' => function($model){
                        return $model->id;
                    }
                ],
                [
                    'label' => '用户头像',
                    'format' => 'raw',
                    'value' => function($model){
                        return "<img src='{$model->avatar}' style='width: 50px;'/>" ;
                    }
                ],
                [
                    'label' => '用户昵称',
                    'format' => 'raw',
                    'filter' => Html::textInput('UserSearch[username]', $searchModel->username, ['class' => 'form-control']),
                    'value' => function($model){
                        return $model->username;
                    }
                ],
                [
                    'label' => '备注',
                    'format' => 'raw',
                    'filter' => Html::textInput('UserSearch[remark]', $searchModel->remark, ['class' => 'form-control']),
                    'value' => function($model){
                        return $model->remark;
                    }
                ],
                [
                    'label' => '手机号',
                    'format' => 'raw',
                    'filter' => Html::textInput('UserSearch[mobile]', $searchModel->mobile, ['class' => 'form-control']),
                    'value' => function($model){
                        return $model->mobile;
                    }
                ],
                [
                    'label' => '用户状态',
                    'attribute' => 'status',
                    'format' => 'raw',
                    'filter' => Html::dropDownList('UserSearch[status]', $searchModel->status, ['' => '全部'] + \common\models\User::getStatusOptions(), ['class' => 'form-control']),
                    'value' => function($model){
                        return \common\models\User::getStatusName($model->status);
                    }
                ],
                [
                    'label' => '登录时间',
                    'attribute' => 'last_login_at',
                    'format' => 'raw',
                    'value' => function($model){
                        return date('Y-m-d H:i:s', $model->last_login_at);
                    }
                ],
                [
                    'label' => '注册时间',
                    'attribute' => 'created_at',
                    'format' => 'raw',
                    'value' => function($model){
                        return date('Y-m-d H:i:s', $model->created_at);
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => \mdm\admin\components\Helper::filterActionColumn('{view}{update}'),
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return \yii\helpers\Html::a("<i class='fa fa-fw fa-eye'></i>查看", ['view', 'id' => $key], ['class' => 'btn btn-primary']);
                        },
                        'update' => function ($url, $model, $key) {
                            return \yii\helpers\Html::a("<i class='fa fa-fw fa-edit'></i>编辑", ['update', 'id' => $key], ['class' => 'btn btn-primary']);
                        },
                    ],
                ]
            ],
        ]); ?>
    </div>
</div>
