<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Common\models\User */

$this->title = Yii::t('app', 'Update: ', [
    'modelClass' => 'User',
]) . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '会员管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
