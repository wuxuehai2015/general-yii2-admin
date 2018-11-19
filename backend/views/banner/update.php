<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banner\Banner */

$this->title = Yii::t('app', 'Update: ', [
    'modelClass' => 'Banner',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '轮播图集'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="banner-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
