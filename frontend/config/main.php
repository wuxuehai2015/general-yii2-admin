<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                // your models
                'frontend\models\Category',
                'frontend\models\Document',
            ],
            'urls'=> [
                [
                    'loc' => \yii\helpers\Url::to('/site/index'),
                    'priority' => 0.8,
                ],
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                'list-<id:\d+>' => 'list/index',
                'view-<id:\d+>' => 'view/index',
                'help-<cate_id:\d+>' => 'help/index',
                'help-<cate_id:\d+>-<article_id:\d+>' => 'help/index',
                '<controller>/<action>' => '<controller>/<action>',
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
            ],
        ],
    ],
    'params' => $params,
];
