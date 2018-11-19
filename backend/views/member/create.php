<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \backend\models\User\User */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '会员管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
