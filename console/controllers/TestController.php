<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/22 Time: 上午10:14
//---------------------------------------------------------

namespace console\controllers;

use yii\console\Controller;
use common\services\DocumentService;

class TestController extends Controller
{
    public function actionIndex()
    {
        DocumentService::generateFiles(32);
    }
}
