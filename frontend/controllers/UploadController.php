<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/11 Time: 12:48 PM
//---------------------------------------------------------

namespace frontend\controllers;

use frontend\models\forms\UploadImageFrom;
use Yii;

class UploadController extends BaseController
{
    public function actionIndex()
    {
        $model = new UploadImageFrom();

        if (!$model->upload()) {
            return $this->returnJson(500, implode('', $model->getFirstErrors()));
        } else {
            return $this->returnJson(200, '上传成功', [
                'url' => $model->savePath . $model->saveName
            ]);
        }
    }

    public function actionBase64()
    {
        $base64_img = Yii::$app->request->post('base64_img', '');

        $res = '';
        if (!preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $res)) {
            return $this->returnJson(500, '上传失败');
        }

        //获取图片类型
        $type = $res[2];

        if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
            return $this->returnJson(500, '文件类型不被允许');
        }

        $model = new UploadImageFrom();

        $res = $model->uploadBase64(base64_decode(str_replace($res[1], '', $base64_img)), $res[2]);

        if (!$res) {
            return $this->returnJson(500, '上传失败');
        } else {
            return $this->returnJson(200, '上传成功', ['url' => $res]);
        }
    }
}
