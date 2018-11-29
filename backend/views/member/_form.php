<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \backend\models\User\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">
        <?= $form->field($model, 'username')->textInput()->label('用户名') ?>
        <?= $form->field($model, 'mobile')->textInput()->label('手机号') ?>
        <?= $form->field($model, 'remark')->textInput()->label('备注') ?>
        <?= $form->field($model, 'password')->textInput()->label('密码')->hint('不填写不修改密码') ?>
        <?= $form->field($model, 'status')->dropDownList(\common\models\User::getStatusOptions(), ['default' => 1])->label('状态')?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
