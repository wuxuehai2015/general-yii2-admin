<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SystemConfig\SystemConfig */

$this->title = Yii::t('app', 'Update: ', [
    'modelClass' => 'System Config',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="system-config-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
