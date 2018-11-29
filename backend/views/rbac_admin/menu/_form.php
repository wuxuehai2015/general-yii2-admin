<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\admin\models\Menu;
use yii\helpers\Json;
use mdm\admin\AutocompleteAsset;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
        'menus' => Menu::getMenuSource(),
        'routes' => Menu::getSavedRoutes(),
    ]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
    <div class="row">
        <div class="col-sm-6 ui-front">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

            <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

            <?= $form->field($model, 'order')->input('number') ?>

            <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
        </div>
        <div class="col-sm-6">
            <?php

                $data = Json::decode($model->data);
                $icon = ArrayHelper::getValue($data, 'icon', '');
                $left_menu = ArrayHelper::getValue($data, 'group', false);
                $rule = implode("\r\n", ArrayHelper::getValue($data,'include', []));

            ?>
            <div class="form-group field-menu-data">
                <label class="control-label" for="menu-data">图标</label>
                <?=Html::textInput('data[icon]', $icon, ['class' => 'form-control'])?>
            </div>
            <div class="form-group field-menu-data">
                <label class="control-label" for="menu-data">右顶菜单</label>
                <?=Html::checkbox('data[sub]', $left_menu)?>
            </div>
            <div class="form-group field-menu-data">
                <label class="control-label" for="menu-data">高亮规则 一行一个 左侧controller_id 右顶controller_id/action_id</label>
                <?=Html::textarea('data[include]', $rule, ['class' => 'form-control', 'rows' => 4])?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord
                    ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
