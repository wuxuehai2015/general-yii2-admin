<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/11/29 Time: 11:07 AM
//---------------------------------------------------------

namespace common\components\payment;


use common\components\BaseComponents;
use Yansongda\Pay\Pay;
use yii\base\InvalidConfigException;

class Payment extends BaseComponents
{
    /**
     * @var [] 配置
     */
    public $config;

    /**
     * @return \Yansongda\Pay\Gateways\Alipay
     * @throws InvalidConfigException
     */
    public function getAli()
    {
        if (!isset($this->config['ali']) || !is_array($this->config['ali']) || empty($this->config['ali'])) {
            throw new InvalidConfigException('支付宝支付参数配置错误');
        }
        return Pay::alipay($this->config['ali']);
    }

    /**
     * @return \Yansongda\Pay\Gateways\Wechat
     * @throws InvalidConfigException
     */
    public function getWx()
    {
        if (!isset($this->config['wx']) || !is_array($this->config['wx']) || empty($this->config['wx'])) {
            throw new InvalidConfigException('微信支付参数配置错误');
        }
        return Pay::wechat($this->config['wx']);
    }
}
