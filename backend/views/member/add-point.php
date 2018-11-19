<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Common\models\User */

$this->title = Yii::t('app', '增加积分: ', [
    'modelClass' => 'User',
]) . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '会员管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', '增加积分');
?>
<div class="user-update">
    <div class="user-form box box-primary">
        <?=$this->render('@app/views/layouts/_tab.php')?>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body table-responsive">
            <?= $form->field($model, 'points')->textInput(['disabled' => 'disabled'])->label('当前积分') ?>
            <?= $form->field($model, 'add_point')->textInput(['value' => ''])->label('增加积分') ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
