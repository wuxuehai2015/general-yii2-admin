<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SystemConfig\SystemConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-config-form box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'key')->textInput(['maxlength' => true])->label('KEY') ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('名') ?>

        <?= $form->field($model, 'value')->textInput(['maxlength' => true])->label('值') ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
