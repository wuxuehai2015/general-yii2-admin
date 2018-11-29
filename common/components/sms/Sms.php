<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/11/29 Time: 10:53 AM
//---------------------------------------------------------

namespace common\components\sms;


use common\components\BaseComponents;
use Overtrue\EasySms\EasySms;

class Sms extends BaseComponents
{
    public $config;

    /**
     * @var EasySms;
     */
    protected $sms;

    public function init()
    {
        $this->sms = new EasySms($this->config);
    }

    public function sendCode($mobile, $code, $templateId)
    {
        $content = [
            'content' => "验证码{$code}，您正在进行身份验证，打死不要告诉别人哦！",
            'template' => $templateId,
            'data' => [
                'code' => $code
            ],
        ];

        try{
            $this->sms->send($mobile, $content);
            return true;
        }catch (\Exception $e){
            \Yii::error('发送验证码失败:' . $e->getMessage());
            return false;
        }
    }
}
