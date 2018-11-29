<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::className(),
            'db' => 'db', // DB connection component or its config
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::className(), // Mutex used to sync queries
        ],
        'payment' => [
            'class' => 'common\components\payment\Payment',
            'config' => [
                'wx' => [
                    'appid' => '', // APP APPID
                    'app_id' => '', // 公众号 APPID
                    'miniapp_id' => '', // 小程序 APPID
                    'mch_id' => '',
                    'key' => '',
                    'notify_url' => '',
                    'cert_client' => '', // optional，退款等情况时用到
                    'cert_key' => '',// optional，退款等情况时用到
                ],
                'ali' => [
                    'app_id' => '',
                    'notify_url' => '',
                    'return_url' => '',
                    'ali_public_key' => '',
                    // 加密方式： **RSA2**
                    'private_key' => '',
                    'log' => [ // optional
                        'file' => './logs/alipay.log',
                        'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
                        'type' => 'single', // optional, 可选 daily.
                        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
                    ],
                    'http' => [ // optional
                        'timeout' => 5.0,
                        'connect_timeout' => 5.0,
                        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
                    ],
                    'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
                ],
            ],
        ],
        'sms' => [
            'class' => 'common\components\sms\Sms',
            'config' => [
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
            ],
        ],
    ],
];
