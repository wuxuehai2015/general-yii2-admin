<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/iconfont.css',
    ];
    public $js = [
        'js/app.js',
        'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'bower_components/jquery-knob/dist/jquery.knob.min.js',
        'layer/layer.js',
        'js/lazyload.min.js',
        'js/echarts.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
