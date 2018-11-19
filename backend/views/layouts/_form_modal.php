
/* @var $this yii\web\View */
/* @var $model yii\data\ActiveDataProvider */

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">添加频道</h4>
            </div>
            <div class="modal-body">
                <?php use yii\helpers\Html;
                use yii\widgets\ActiveForm;

                $form = ActiveForm::begin(); ?>
                <div class="box-body table-responsive">

                    <?= $form->field($model, 'c_id')->textInput() ?>

                    <?= $form->field($model, 'c_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'cover')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'sort')->textInput() ?>

                    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',[]);?>

                </div>
                <div class="box-footer">

                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>