<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/11/29 Time: 11:46 AM
//---------------------------------------------------------

namespace common\components;

use yii\base\Component;

class BaseComponents extends Component
{
    /**
     * @var [] 配置
     */
    public $config;

    public function setConfig($key, $value)
    {
        $this->config[$key] = $value;
    }
}
