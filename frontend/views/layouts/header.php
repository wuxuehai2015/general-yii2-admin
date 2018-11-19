<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 2:20 PM
//---------------------------------------------------------
?>
<div class="header">
    <div class="container">
        <div id="logo" class="pull-left" style="">
            <a href="/">
                <img src="/image/logo.png" alt="logo">
            </a>
        </div>
        <div class="search-form pull-right">
            <form class="form-inline" action="<?=\yii\helpers\Url::to(['/search/index'])?>" method="get">
                <div class="input-group">
                    <input type="text" name="keywords" id="keywords" class="form-control" placeholder="请输入搜索内容">
                    <div class="input-group-addon search-form-btn">
                        <img src="/image/search.svg" alt="">
                    </div>
                </div>
            </form>
        </div>
        <i class="clearfix"></i>
    </div>
</div>
