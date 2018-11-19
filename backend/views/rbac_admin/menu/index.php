<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'menuParent.name',
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
            ],
            'route',
            'order',
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
    ?>
<?php Pjax::end(); ?>

</div>
