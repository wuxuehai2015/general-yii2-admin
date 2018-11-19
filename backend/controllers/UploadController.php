<?php

namespace backend\controllers;


use Yii;
use yii\web\Response;
use common\services\UploadService;


class UploadController extends BaseController
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * 上传图片
     * @return array
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $uploadService = new UploadService();

        if (Yii::$app->request->isPost) {

            $res = $uploadService->upload();

            if ($res->success) {
                return ['code' => 0, 'url' => $res->data['path'], 'attachment' => $res->data['path']];
            } else {
                return ['code' => 1, 'msg' => $res->message];
            }
        }
        return ['code' => 1, 'msg' => '上传失败'];
    }

    public function actionWangUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $uploadService = new UploadService();

        if (Yii::$app->request->isPost) {

            $res = $uploadService->upload();

            if ($res->success) {
                return ['errno' => 0, 'data' => [$res->data['path']]];
            } else {
                return ['errno' => 1, 'msg' => $res->message];
            }
        }
        return ['errno' => 1, 'msg' => '上传失败'];
    }
}
