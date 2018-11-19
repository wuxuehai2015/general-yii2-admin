<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/7/31 Time: 上午11:01
//---------------------------------------------------------
namespace common\services;

use yii\base\BaseObject;

class CallBackService extends BaseObject
{
    public $success = null;
    public $message = null;
    public $data = null;

    /**
     * @param bool $success
     * @param string $message
     * @param array $data
     * @return $this
     */
    public function result(bool $success = true, string $message = '', array $data = [])
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        return $this;
    }
}