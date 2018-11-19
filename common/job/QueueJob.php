<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/21 Time: 下午6:05
//---------------------------------------------------------
namespace common\job;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use common\services\DocumentService;

class QueueJob extends BaseObject implements JobInterface
{
    public $handle;
    public $param;

    public function execute($queue)
    {
        echo '执行任务中....' . PHP_EOL;
        $res = call_user_func([$this, $this->handle], $this->param);
    }

    public function generateFiles($id)
    {
        return DocumentService::generateFiles($id);
    }
}