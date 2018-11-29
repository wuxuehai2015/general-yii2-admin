<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \backend\models\User\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '会员管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'label' => '用户头像',
                    'format' => 'raw',
                    'value' => function($model){
                        return "<img src='{$model->avatar}' style='width: 50px;'/>" ;
                    }
                ],
                [
                    'label' => '用户名',
                    'format' => 'raw',
                    'value' => function($model){
                        return $model->username;
                    }
                ],
                [
                    'label' => '手机号',
                    'format' => 'raw',
                    'value' => function($model){
                        return $model->mobile;
                    }
                ],
                [
                    'label' => '备注',
                    'format' => 'raw',
                    'value' => function($model){
                        return $model->remark;
                    }
                ],
                [
                    'label' => '状态',
                    'format' => 'raw',
                    'value' => function($model){
                        return \backend\models\User\User::getStatusName($model->status);
                    }
                ],
                [
                    'label' => '最近IP',
                    'format' => 'raw',
                    'value' => function($model){
                        return $model->last_ip;
                    }
                ],
                [
                    'label' => '最近登录时间',
                    'format' => 'raw',
                    'value' => function($model){
                        return Yii::$app->formatter->asDatetime($model->last_login_at);
                    }
                ],
                [
                    'label' => '注册时间',
                    'format' => 'raw',
                    'value' => function($model){
                        return Yii::$app->formatter->asDatetime($model->created_at);
                    }
                ],
            ],
        ]) ?>
    </div>
</div>
