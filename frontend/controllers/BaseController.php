<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 2:18 PM
//---------------------------------------------------------

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{

    public function returnJson($code = 200, $message = '操作成功', $data = [])
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['code' => $code, 'message' => $message, 'data' => $data];
    }
}
