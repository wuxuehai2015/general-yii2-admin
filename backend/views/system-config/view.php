<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SystemConfig\SystemConfig */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-config-view box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                ['label' => 'id', 'format' => 'raw', 'attribute' => 'id', 'value' => function($model){return $model->id;}],
                ['label' => 'key', 'format' => 'raw', 'attribute' => 'key', 'value' => function($model){return $model->key;}],
                ['label' => 'name', 'format' => 'raw', 'attribute' => 'name', 'value' => function($model){return $model->name;}],
                ['label' => 'value', 'format' => 'raw', 'attribute' => 'value', 'value' => function($model){return $model->value;}],
                ['label' => 'created_at', 'format' => 'raw', 'attribute' => 'created_at', 'value' => function($model){return $model->created_at;}],
                ['label' => 'updated_at', 'format' => 'raw', 'attribute' => 'updated_at', 'value' => function($model){return $model->updated_at;}],
            ],
        ]) ?>
    </div>
</div>
