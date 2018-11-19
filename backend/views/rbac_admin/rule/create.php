<?php

use yii\helpers\Html;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */

$this->title = Yii::t('rbac-admin', 'Create Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <div class="box-header with-border"></div>
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
