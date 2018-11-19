<?php

use common\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->registerCssFile('@web/bower_components/Ionicons/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/js/dashboard.js',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/js/demo.js',['depends'=>['backend\assets\AppAsset']]);

$this->title = '数据总览';

?>
<div class="site-index">
    <div class="body-content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>0</h3>
                        <p>总文档</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?=User::count()?></h3>
                        <p>注册用户</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>0</h3>
                        <p>剩余积分</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?=0?><sup style="font-size: 20px">.00</sup></h3>
                        <p>充值金额</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
    </div>
</div>
