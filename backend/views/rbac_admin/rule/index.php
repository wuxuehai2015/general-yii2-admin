<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\BizRule */

$this->title = Yii::t('rbac-admin', 'Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('rbac-admin', 'Create Rule'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => \mdm\admin\components\Helper::filterActionColumn('{view}{delete}'),
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return \yii\helpers\Html::a("<i class='fa fa-fw fa-eye'></i>查看", ['view', 'id' => $key], ['class' => 'btn btn-primary']);
                    },
                    'update' => function ($url, $model, $key) {
                        return \yii\helpers\Html::a("<i class='fa fa-fw fa-edit'></i>编辑", ['view', 'id' => $key], ['class' => 'btn btn-btn-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return \yii\helpers\Html::a("<i class='fa fa-fw fa-recycle'></i>删除", ['view', 'id' => $key], [
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
    ?>

</div>
