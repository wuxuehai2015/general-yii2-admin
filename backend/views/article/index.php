<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Article\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-primary">
    <?=    $this->render('@app/views/layouts/_tab.php')?>
        <div class="box-header with-border">
        <?php if(\mdm\admin\components\Helper::checkRoute('create')) { ?>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' =>'btn btn-success btn-flat']) ?>
        <?php } ?>
    </div>
    <div class="box-body table-responsive">
                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                            [
                    'label' => 'id',
                    'format' => 'raw',
                    'attribute' => 'id', 
                    'value' => function($model) {
                         return $model->id;
                    }
                ],
                [
                    'label' => 'title',
                    'format' => 'raw',
                    'attribute' => 'title', 
                    'value' => function($model) {
                         return $model->title;
                    }
                ],
                [
                    'label' => 'pid',
                    'format' => 'raw',
                    'attribute' => 'pid', 
                    'value' => function($model) {
                         return $model->pid;
                    }
                ],
                [
                    'label' => 'status',
                    'format' => 'raw',
                    'attribute' => 'status', 
                    'value' => function($model) {
                         return $model->status;
                    }
                ],
                [
                    'label' => 'content',
                    'format' => 'raw',
                    'attribute' => 'content', 
                    'value' => function($model) {
                         return $model->content;
                    }
                ],
                // 'created_at',
                // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => \mdm\admin\components\Helper::filterActionColumn('{view}{update}{delete}'),
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                            return \yii\helpers\Html::a("<i class='fa fa-fw fa-eye'></i>查看", ['view', 'id' => $key], ['class' => 'btn btn-primary']);
                    },
                    'update' => function ($url, $model, $key) {
                           return \yii\helpers\Html::a("<i class='fa fa-fw fa-edit'></i>编辑", ['update', 'id' => $key], ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return \yii\helpers\Html::a("<i class='fa fa-fw fa-recycle'></i>删除", ['delete', 'id' => $key],
                                            [
                                                'class' => 'btn btn-primary',
                                                'data' => [
                                                'confirm' => Yii::t('app', '是否确认删除?'),
                                                'method' => 'post'
                                            ]
                        ]);
                    }],
                ],
            ],
        ]); ?>
            </div>
    </div>
