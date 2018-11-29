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


    public static function getConfig()
    {
        return \Yii::$app->params['smsConfig'];
    }

    public function sendVerifyCode($mobile, $code)
    {
        $easySms = new EasySms(self::getConfig());
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
