<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Banner\Banner */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '轮播图集'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
