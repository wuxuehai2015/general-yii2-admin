<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/6 Time: 下午3:56
//---------------------------------------------------------

namespace backend\controllers;

use backend\behaviors\OperationLogBehavior;
use common\models\Category\Category;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'operationLog' => [
                'class' => OperationLogBehavior::className()
            ]
        ];
    }
}
