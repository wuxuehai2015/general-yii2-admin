<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SystemConfig\SystemConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'System Configs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-config-index box box-primary">
    <?= $this->render('@app/views/layouts/_tab.php') ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create'),
            ['create'],
            ['class' => 'btn btn-success btn-flat']
        )
        ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                [
                    'label' => 'KEY',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->key;
                    }
                ],
                [
                    'label' => '名字',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->name;
                    }
                ],
                [
                    'label' => '值',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->value;
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => \mdm\admin\components\Helper::filterActionColumn('{update}{delete}'),
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return \yii\helpers\Html::a("<i class='fa fa-fw fa-eye'></i>查看", ['view', 'id' => $key], ['class' => 'btn btn-primary']);
                        },
                        'update' => function ($url, $model, $key) {
                            return \yii\helpers\Html::a("<i class='fa fa-fw fa-edit'></i>编辑", ['update', 'id' => $key], ['class' => 'btn btn-primary']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return \yii\helpers\Html::a("<i class='fa fa-fw fa-recycle'></i>删除", ['delete', 'id' => $key], [
                                'class' => 'btn btn-primary',
                                'data' => [
                                    'confirm' => Yii::t('app', '是否确认删除?'),
                                    'method' => 'post',
                                ]
                            ]);
                        }
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
