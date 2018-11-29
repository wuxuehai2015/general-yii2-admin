<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Article\Article */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
