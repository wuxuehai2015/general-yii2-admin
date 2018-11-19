<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 2:21 PM
//---------------------------------------------------------

$this->title = '首页';
$this->registerCssFile('/css/index.css', ['depends'=>['frontend\assets\AppAsset']]);

//获取分类
$top_menu = \frontend\models\Category::getListByPid();

$banner = \common\models\Banner\Banner::getList();

$ads = \common\models\Ad\Ad::getList(\common\models\Ad\Ad::POS_INDEX);
?>
<div class="banner">
    <div class="container">
        <div class="banner-left">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                <!-- 轮播（Carousel）指标 -->
                <ol class="carousel-indicators">
                    <?php foreach($banner as $k => $b) { ?>
                        <li data-target="#myCarousel" data-slide-to="<?=$k?>" class="<?=$k==0 ? 'active' : ''?>"></li>
                    <?php } ?>
                </ol>
                <!-- 轮播（Carousel）项目 -->
                <div class="carousel-inner">
                    <?php foreach($banner as $k => $b) { ?>
                        <div class="item <?=$k==0 ? 'active' : ''?>">
                            <img src="<?=$b->image?>" alt="">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="banner-right hidden-xs">
            <?php if(!empty($ads)) { ?>
                <?php foreach ($ads as $k => $ad) { ?>
                    <div class="banner-right-<?=$k+1?>">
                        <a href="<?=$ad->link?>" target="_blank"><img src="<?=$ad->image?>" alt=""></a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="hidden-sm hidden-xs index-cate-list">
    <div class="container">
        <?php foreach ($top_menu as $key => $item) { ?>
            <?php if($key == 4){break;}?>
        <div class="col-md-3 col-xs-12 index-cate-list-item">
            <h4 class="index-cate-list-title"><?=$item->name?></h4>
            <?php $sub_menu = \frontend\models\Category::getListByPid($item->id);?>
            <ul>
                <?php foreach($sub_menu as $v) { ?>
                <li>
                    <a href="<?=\yii\helpers\Url::to(['list/index', 'id' =>  $v['id']])?>"><?=$v->name?></a>
                </li>
                <?php } ?>
                <span class="clearfix"></span>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>

<div class="index-document-list">
    <div class="container">
        <?php foreach($top_menu as $v) { ?>
        <div class="index-document-list-item">
            <div class="index-document-list-item-header">
                <div class="pull-left">
                    <h4><?=$v->name?></h4>
                </div>
                <div class="more pull-right">
                    <a href="<?=\yii\helpers\Url::to(['/list/index', 'id' => $v->id])?>">更多 > ></a>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="index-document-list-item-body">
                <div class="list-cover hidden-sm hidden-xs">
                    <img src="<?=$v->cover?>" alt="" style="background: #666666;height:100%;width: 100%">
                </div>
                <div class="list-item">
                    <?php $list = \frontend\models\Document::getList($v->id, 1, 5)?>
                    <ul>
                        <?php if($list['list']) { ?>
                        <?php foreach($list['list'] as $item) { ?>
                            <li><a href="<?=\yii\helpers\Url::to(['/view/index', 'id' => $item->id])?>"><?=$item->title?></a></li>
                        <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <i class="clearfix"></i>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

