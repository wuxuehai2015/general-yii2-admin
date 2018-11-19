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
        <?= $form->field($model, 'is_admin')->checkbox([], false)->label('是后台管理员')->hint('是否后台管理员') ?>
        <?= $form->field($model, 'allow_upload_doc')->checkbox([], false)->label('前端上传文档')->hint('是否允许用户前端上传文档') ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
