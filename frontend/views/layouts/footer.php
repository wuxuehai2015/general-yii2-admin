<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 2:19 PM
//---------------------------------------------------------

use yii\helpers\Url;
use common\models\FriendLink\FriendLink;
use common\models\SystemConfig\SystemConfig;
use common\models\ArticleCategory\ArticleCategory;


$friendLinks = FriendLink::getList();
$articleList = ArticleCategory::getList();
?>

<div class="side-nav-bar hidden-sm hidden-xs">
    <ul>
        <li><a href="<?=Url::to(['/help/feedback'])?>" target="_blank">反馈</a></li>
        <li class="go-top"><i class="glyphicon glyphicon-menu-up"></i></li>
    </ul>
</div>
<footer class="footer">
    <div class="container">
        <div>
            <div class="pull-left">
                <ul class="help-list">
                    <?php foreach($articleList as $v) { ?>
                    <li>
                        <a href="<?=Url::to(['/help/index', 'cate_id' => $v->id])?>"><?=$v->name?></a>
                    </li>
                   <?php } ?>
                    <i class="clearfix"></i>
                </ul>
                <ul class="friend-links">
                    <?php foreach ($friendLinks as $link) { ?>
                    <li>
                        <a href="<?=$link->link?>" target="_blank"><?=$link->name?></a>
                    </li>
                    <?php } ?>
                    <i class="clearfix"></i>
                </ul>
            </div>
            <div class="pull-right hidden-sm hidden-xs">
                <div class="col-md-12 text-center no-padding-right no-padding-left">
                    <img src="<?=SystemConfig::getValueByName('wx_qr_code')?>" style="width:142px;height: 152px;" alt="微信二维码">
                    <p class="">（ 关注我们 ）</p>
                </div>
            </div>
            <i class="clearfix"></i>
        </div>
        <div class="copyright">
            <p>
                    &copy;<?=date('Y')?> <?=SystemConfig::getValueByName('site_name')?>
                版权所有
                <a href="http://www.miitbeian.gov.cn/" target="_blank"><?=SystemConfig::getValueByName('icp')?></a>
            </p>
            <p>
                <a href="" target="_blank">
                    <img src="/image/ghs.png" alt=""><?=SystemConfig::getValueByName('ga_icp')?>
                </a>
            </p>
        </div>
    </div>
</footer>
