<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/19 Time: 10:50 AM
//---------------------------------------------------------

namespace common\services;


use Overtrue\EasySms\EasySms;
use yii\base\BaseObject;

class SmsService extends BaseObject
{
    public $error;

    public $config = [
        // HTTP 请求的超时时间（秒）
        'timeout' => 5.0,
        // 默认发送配置
        'default' => [
            // 网关调用策略，默认：顺序调用
            'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
            // 默认可用的发送网关
            'gateways' => [
                'aliyun',
            ],
        ],
        // 可用的网关配置
        'gateways' => [
            'errorlog' => [
                'file' => '/tmp/easy-sms.log',
            ],
            'aliyun' => [
                'access_key_id' => '',
                'access_key_secret' => '',
                'sign_name' => '',
            ],
        ],
    ];

    public function sendVerifyCode($mobile, $code)
    {
        $easySms = new EasySms($this->config);

        try {
            $res = $easySms->send($mobile, [
                'content' => "验证码{$code}，您正在进行身份验证，打死不要告诉别人哦！",
                'template' => 'SMS_146445096',
                'data' => [
                    'code' => $code
                ],
            ]);

            if ($res['aliyun']['result']['Message'] == 'OK') {
                return true;
            } else {
                $this->error = $res['aliyun']['result']['Message'];
                return false;
            }
        } catch (\Exception $e) {
            $this->error = $e->getExceptions()['aliyun']->getMessage();
            return false;
        }
    }
}
