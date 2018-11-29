<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/7/31 Time: 上午11:24
//---------------------------------------------------------
namespace common\services;

use Yii;
use common\models\OperationLog;

class HelpService
{
    /**
     * 操作日志
     * @param $action
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public static function operationLog($action)
    {
        $identity = Yii::$app->user->identity;
        $operationLog = new OperationLog();
        $operationLog->action = $action;
        $operationLog->uri = Yii::$app->getRequest()->getUrl();
        $operationLog->ip = Yii::$app->getRequest()->getRemoteIP();
        $operationLog->identity_id = $identity->getId();
        $operationLog->identity_name = $identity->username;
        $operationLog->created_at = time();
        return $operationLog->save(false);
    }
}
