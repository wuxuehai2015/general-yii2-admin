<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/common.css',
        '/css/iconfont.css',
    ];
    public $js = [
        '/js/bootstrap/js/bootstrap.js',
        '/js/layer/layer.js',
        '/js/bootstrap-rating.js',
        '/js/jquery.touchSwipe.min.js',
        '/js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
