<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SystemConfig\SystemConfig */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-config-create">
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
