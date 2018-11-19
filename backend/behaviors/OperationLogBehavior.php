<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/1 Time: 下午6:41
//---------------------------------------------------------

namespace backend\behaviors;

use common\models\OperationLog;
use Yii;
use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\helpers\Inflector;
use yii\web\Controller;

class OperationLogBehavior extends Behavior
{
    /**
     * Declares event handlers for the [[owner]]'s events.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()
    {
        return [Controller::EVENT_AFTER_ACTION => 'afterAction'];
    }

    /**
     * @param ActionEvent $event
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function afterAction($event)
    {
        $identity = Yii::$app->user->identity;
        $action = $event->action->id;
        $controller = Inflector::camel2words(Yii::$app->controller->id);
        $method = Yii::$app->getRequest()->getMethod();

        $action = $identity->username . ' ' . Yii::t('app', $action) . ' ' . Yii::t('app', $controller) . ' ' . $method;

        $operationLog = new operationLog();
        $operationLog->action = $action;
        $operationLog->uri = Yii::$app->getRequest()->getUrl();
        $operationLog->ip = Yii::$app->getRequest()->getRemoteIP();
        $operationLog->identity_id = $identity->getId();
        $operationLog->identity_name = $identity->username;
        $operationLog->created_at = time();
        $operationLog->save(false);
        return true;
    }
}