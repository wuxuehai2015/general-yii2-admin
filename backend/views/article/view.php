<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header">
        <?php if(\mdm\admin\components\Helper::checkRoute('update')) { ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?php } ?>
        <?php if(\mdm\admin\components\Helper::checkRoute('delete')) { ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' => 'id',
                    'format' => 'raw',
                    'attribute' => 'id',
                    'value' => function($model){
                        return $model->id;
                    }
                ],
                [
                    'label' => 'title',
                    'format' => 'raw',
                    'attribute' => 'title',
                    'value' => function($model){
                        return $model->title;
                    }
                ],
                [
                    'label' => 'pid',
                    'format' => 'raw',
                    'attribute' => 'pid',
                    'value' => function($model){
                        return $model->pid;
                    }
                ],
                [
                    'label' => 'status',
                    'format' => 'raw',
                    'attribute' => 'status',
                    'value' => function($model){
                        return $model->status;
                    }
                ],
                [
                    'label' => 'content',
                    'format' => 'raw',
                    'attribute' => 'content',
                    'value' => function($model){
                        return $model->content;
                    }
                ],
                [
                    'label' => 'created_at',
                    'format' => 'raw',
                    'attribute' => 'created_at',
                    'value' => function($model){
                        return $model->created_at;
                    }
                ],
                [
                    'label' => 'updated_at',
                    'format' => 'raw',
                    'attribute' => 'updated_at',
                    'value' => function($model){
                        return $model->updated_at;
                    }
                ],
            ],
        ]) ?>
    </div>
</div>
