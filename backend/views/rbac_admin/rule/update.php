<?php

use yii\helpers\Html;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */

$this->title = Yii::t('rbac-admin', 'Update Rule') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Update');
?>
<div class="auth-item-update box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header with-border"></div>
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
</div>
