<?php

use common\models\Banner\Banner;
use kartik\editable\Editable;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Banner\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '轮播图集');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{items}\n{summary}\n{pager}",
                'columns' => [
                    'id',
                    [
                        'attribute' => 'title',
                        'enableSorting' => false,
                        'format' => 'raw',
                        'value' => function($model){
                            return $model->title;
                        }
                    ],
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'enableSorting' => false,
                        'filter' => false,
                        'value' => function($model){
                            return "<img style='width:100px;height:100px;' src='{$model->image}' />";
                        }
                    ],
                    [
                        'attribute' => 'link',
                        'enableSorting' => false,
                        'filter' => false,
                        'format' => 'raw',
                        'value' => function($model){
                            return $model->link;
                        }
                    ],
                    [
                        'attribute' => 'sort',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'filter' => Html::dropDownList('BannerSearch[status]', $searchModel->status, ['' => '全部'] + Banner::getStatusOptions(), ['class' => 'form-control']),
                        'value' => function ($model) {
                            return Banner::getStatusName($model->status);
                        }
                    ],
                    [
                        'attribute' => 'updated_at',
                        'filter' => false,
                        'value' => function($model){
                            return date('Y-m-d H:i:s', $model->updated_at);
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
                                    ]]);
                            }
                        ],
                    ]
                ],
            ]);
        } catch (Exception $e) {
        } ?>
    </div>
</div>
