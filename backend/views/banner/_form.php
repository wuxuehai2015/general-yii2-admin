<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sort')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList(\common\models\Banner\Banner::getStatusOptions(), ['value' => \common\models\Banner\Banner::STATUS_ACTIVE]) ?>

        <?= $form->field($model, 'image')->widget('common\widgets\webUpload\FileInput', [
        ])->hint('banner图 770*470'); ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
