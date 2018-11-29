<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index box box-primary">
    <?= "<?=" ?>
    $this->render('@app/views/layouts/_tab.php')?>
    <?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : ''
    ?>
    <div class="box-header with-border">
        <?= "<?php if(\mdm\admin\components\Helper::checkRoute('create')) { ?>\n"?>
            <?= "<?= " ?>Html::a(<?= $generator->generateString('Create') ?>, ['create'], ['class' =>'btn btn-success btn-flat']) ?>
        <?= "<?php } ?>\n" ?>
    </div>
    <div class="box-body table-responsive">
        <?php if (!empty($generator->searchModelClass)): ?>
            <?= "        <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php endif;

        if ($generator->indexWidgetType === 'grid'):
            echo "<?= " ?>GridView::widget([
            'dataProvider' => $dataProvider,
            <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n            'layout' => \"{items}\\n{summary}\\n{pager}\",\n            'columns' => [\n" : "'layout' => \"{items}\\n{summary}\\n{pager}\",\n            'columns' => [\n"; ?>
            <?php
            $count = 0;
            if (($tableSchema = $generator->getTableSchema()) === false) {
                foreach ($generator->getColumnNames() as $name) {
                    if (++$count < 6) {
                        echo "                '" . $name . "',\n";
                    } else {
                        echo "                // '" . $name . "',\n";
                    }
                }
            } else {
                foreach ($tableSchema->columns as $column) {
                    $format = $generator->generateColumnFormat($column);
                    if (++$count < 6) {
                        echo "                [\n                    'label' => '" . $column->name . "',\n                    'format' => 'raw',\n                    'attribute' => '" . $column->name . "', \n                    'value' => function(\$model) {\n                         return \$model->" . $column->name . ";\n                    }\n                ],\n";
                    } else {
                        echo "                // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                    }
                }
            }
            ?>

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
        <?php else: ?>
            <?= "<?= " ?>ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
            },
            ]) ?>
        <?php endif; ?>
    </div>
    <?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
</div>
