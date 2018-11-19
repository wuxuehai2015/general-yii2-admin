<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 2:21 PM
//---------------------------------------------------------

//获取分类
$nav_menu = \frontend\models\Category::getListByPid();
$user = Yii::$app->getUser()->isGuest ? null : Yii::$app->getUser()->identity;

$first_cate_id = $this->params['first_cate_id'] ?? 0;

$this->registerCssFile('/css/font-awesome.css', ['depends'=>['frontend\assets\AppAsset']]);
?>
<div class="nav">
    <div class="container no-padding-left no-padding-right">
        <div class="cate-list" style="padding-left: 0;padding-right: 0;">
            <ul>
                <li class="<?=$first_cate_id == 0 && Yii::$app->controller->action->id != 'all-category' ? 'active' : ''?>">
                    <a href="/">首页</a>
                </li>
                <?php foreach($nav_menu as $item) { ?>
                    <li class="<?=$first_cate_id == $item['id'] ? 'active' : ''?>">
                        <a href="<?=\yii\helpers\Url::to(['/list/index', 'id' =>  $item['id']])?>"><?=$item['name']?></a>
                    </li>
                <?php } ?>

                <li class="<?=Yii::$app->controller->action->id == 'all-category' ? 'active' : ''?>">
                    <a href="<?=\yii\helpers\Url::to(['/site/all-category'])?>">更多分类</a>
                </li>
                <i class="clearfix"></i>
            </ul>
            <div class="xs-menu">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="login-area">
            <a class="btn upload-doc hidden-sm hidden-xs"><i class="fa fa-upload" aria-hidden="true"></i>上传文档</a>
            <?php if ($user === null) { ?>
                <a href="<?=\yii\helpers\Url::to(['/passport'])?>" class="btn goto-login">登录</a>
            <?php } else { ?>
                <a href="<?=\yii\helpers\Url::to(['/user'])?>" class="goto-user-center btn"><i class="fa fa-user-circle" aria-hidden="true"></i>  欢迎您，<?=$user->username?></a>
            <?php } ?>
        </div>
    </div>
</div>
<?php
$js = <<<JS
var cur = $('.cate-list li.active');
$('.cate-list li').mouseover(function() {
    $('.cate-list li').removeClass('active');
    $(this).addClass('active');
})
$('.cate-list ul').mouseleave(function() {
    $('.cate-list li').removeClass('active');
    cur.addClass('active');
})

$('.upload-doc').click(function() {
  layer.msg('上传功能即将上线，敬请关注');
});
JS;
$this->registerJs($js, \yii\web\View::POS_END)
?>
