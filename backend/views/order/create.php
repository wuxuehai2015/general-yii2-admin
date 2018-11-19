<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Order\Order */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">
    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
