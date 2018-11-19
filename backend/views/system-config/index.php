<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model \common\models\SystemConfig\SystemConfig */

$this->title = Yii::t('app', 'System Configs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-config-index box box-primary">
    <?=$this->render('@app/views/layouts/_tab.php')?>
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
    </div>
    <div class="box-body table-responsive">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body table-responsive">

            <?= $form->field($model, 'site_name')->textInput() ?>

            <?= $form->field($model, 'icp')->textInput() ?>

            <?= $form->field($model, 'ga_icp')->textInput() ?>

            <?= $form->field($model, 'cnzz')->textInput() ?>

            <?= $form->field($model, 'seo_keywords')->textInput() ?>

            <?= $form->field($model, 'seo_description')->textInput() ?>

            <?= $form->field($model, 'point_register')->textInput() ?>

            <?= $form->field($model, 'point_login')->textInput() ?>

            <?= $form->field($model, 'point_continuity_login')->textInput() ?>

            <?= $form->field($model, 'point_bind_wexin')->textInput() ?>

            <?= $form->field($model, 'point_bind_webo')->textInput() ?>

            <?= $form->field($model, 'point_feedback')->textInput() ?>

            <?= $form->field($model, 'point_update_avatar')->textInput() ?>

            <?= $form->field($model, 'point_browse_document')->textInput() ?>

            <?= $form->field($model, 'point_comment_document')->textInput() ?>

            <?= $form->field($model, 'point_share_document')->textInput() ?>

            <?= $form->field($model, 'wx_qr_code')->widget('common\widgets\webUpload\FileInput', [
            ])->hint('微信公众号二维码'); ?>
            <?= $form->field($model, 'default_avatar')->widget('common\widgets\webUpload\FileInput', [
            ])->hint('用户默认头像'); ?>
            <?= $form->field($model, 'report_template')->widget('common\widgets\webUpload\FileInput', [
            ])->hint('举报模板'); ?>

        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
