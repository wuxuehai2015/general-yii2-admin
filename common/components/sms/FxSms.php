<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/12/3 Time: 2:44 PM
//---------------------------------------------------------

namespace common\components\sms;


use common\components\BaseComponents;
use GuzzleHttp\Client;

class FxSms extends BaseComponents
{
    public $regCode;
    public $password;

    protected $api = 'http://www.stongnet.com/sdkhttp/sendsms.aspx';

    public function send($mobile, $content)
    {
        $data = [
            'reg' => $this->regCode,
            'pwd' => $this->password,
            'sourceadd' => '',
            'phone' => $mobile,
            'content'=> $content,
        ];

        $client = new Client();

        $response = $client->post($this->api, ['form_params' => $data]);

        print_r($response);
    }
}
