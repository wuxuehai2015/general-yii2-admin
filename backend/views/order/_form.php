<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'order_sn')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'user_avatar')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'doc_id')->textInput() ?>

        <?= $form->field($model, 'doc_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'doc_extension')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
