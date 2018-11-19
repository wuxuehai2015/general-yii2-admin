<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\redis\Cache',
            'keyPrefix' => 'cache.'
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => 'redis'
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ]
    ],
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
];
