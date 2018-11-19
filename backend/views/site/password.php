<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \backend\models\User\User */

$this->title = Yii::t('app', '修改密码 [ ' . $model->username . ' ]');
?>
<div class="user-create">
    <div class="user-form box box-primary">
        <?=$this->render('@app/views/layouts/_tab.php')?>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body table-responsive">
            <?= $form->field($model, 'old_pass')->passwordInput()->label('旧密码') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('新密码') ?>
            <?= $form->field($model, 're_pass')->passwordInput()->label('确认密码') ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
