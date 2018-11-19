<?php

namespace backend\controllers;

use Yii;
use common\models\SystemConfig\SystemConfig;

/**
 * SystemConfigController implements the CRUD actions for SystemConfig model.
 */
class SystemConfigController extends BaseController
{
    /**
     * Lists all SystemConfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = SystemConfig::findOne(1);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
