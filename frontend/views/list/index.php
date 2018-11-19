<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 3:20 PM
//---------------------------------------------------------

/* @var $category Category*/

use frontend\models\Document;
use yii\helpers\Url;
use frontend\models\Category;
use yii\helpers\ArrayHelper;

$this->title = "{$category->name}-文章列表";
$this->registerCssFile('/css/document_list.css', ['depends'=>['frontend\assets\AppAsset']]);
//顶级分类
$first_cate = null;
$second_cate = null;
$second_active_id = 0;
$three_active_id = 0;


if($category->deep == Category::FIRST_DEEP){
    $first_cate = $category;
    $second_cate = $category;
}

if($category->deep == Category::SECOND_DEEP){
    $first_cate = Category::findOne($category->pid_1);
    $second_active_id = $category->id;
    $second_cate = $category;
}

if($category->deep == Category::THREE_DEEP){

    $first_cate = Category::findOne($category->pid_1);
    $second_cate = Category::findOne($category->pid_2);
    $second_active_id = $second_cate->id;
    $three_active_id = $category->id;
}

$this->params['first_cate_id'] = $first_cate->id;


//文档列表
$doc_list = \frontend\models\Document::getList($category->id, $category->deep);

?>
<div class="document">
    <div class="container">
        <?php
            $sub_cate_list = Category::getListByPid($first_cate->id);
        ?>
        <div class="mobile-middle-cate-list hidden-md hidden-lg">
            <h4><?=$category->name?></h4>
            <ul>
                <li>
                    <a  class="<?=$second_active_id == 0 ? 'active' : ''?>" href="<?=Url::to(['list/index', 'id' =>  $category->id])?>">不限分类 ( <?=Document::getCountByPid($category->id, $category->deep)?> ) </a>
                </li>
                <?php foreach($sub_cate_list as $v){ ?>
                    <li>
                        <a class="<?=$second_active_id == $v->id ? 'active' : ''?>" href="<?=Url::to(['list/index', 'id' =>  $v->id])?>"><?=$v->name?> ( <?=Document::getCountByPid($v->id, $v->deep)?> )</a>
                    </li>
                <?php } ?>
                <i class="clearfix"></i>
            </ul>
        </div>
        <div class="pull-left">
            <?php if($category->deep != Category::FIRST_DEEP) { ?>
            <?=$this->render('three-cate', ['category' => $second_cate, 'active_id' => $three_active_id])?>
            <?php } ?>
            <div class="document-filter">
                <form action="">
                    <div class="filter-item-extension">
                        <select name="" id="" class="form-control">
                            <option value="" <?=ArrayHelper::getValue($_GET, 'extension') == '' ? 'selected' : ''; ?>>所有格式</option>
                            <option value="word" <?=ArrayHelper::getValue($_GET, 'extension') == 'word' ? 'selected' : ''; ?>>word</option>
                            <option value="excel" <?=ArrayHelper::getValue($_GET, 'extension') == 'excel' ? 'selected' : ''; ?>>excel</option>
                            <option value="ppt" <?=ArrayHelper::getValue($_GET, 'extension') == 'ppt' ? 'selected' : ''; ?>>ppt</option>
                            <option value="pdf" <?=ArrayHelper::getValue($_GET, 'extension') == 'pdf' ? 'selected' : ''; ?>>pdf</option>
                            <option value="other" <?=ArrayHelper::getValue($_GET, 'extension') == 'other' ? 'selected' : ''; ?>>其他</option>
                        </select>
                    </div>
                    <div class="filter-item-sort">
                        <select name="" id="" class="form-control">
                            <option value="" <?=ArrayHelper::getValue($_GET, 'sort') == '' ? 'selected' : ''; ?>>默认排序</option>
                            <option value="views" <?=ArrayHelper::getValue($_GET, 'sort') == 'views' ? 'selected' : ''; ?>>阅读最多</option>
                            <option value="comments" <?=ArrayHelper::getValue($_GET, 'sort') == 'comments' ? 'selected' : ''; ?>>评论最多</option>
                            <option value="favorites" <?=ArrayHelper::getValue($_GET, 'sort') == 'favorites' ? 'selected' : ''; ?>>收藏最多</option>
                            <option value="comment_score" <?=ArrayHelper::getValue($_GET, 'sort') == 'comment_score' ? 'selected' : ''; ?>>评分最多</option>
                            <option value="created_at" <?=ArrayHelper::getValue($_GET, 'sort') == 'created_at' ? 'selected' : ''; ?>>最新发布</option>
                        </select>
                    </div>
                    <div class="input-group filter-item-keyword">
                        <input type="text" name="keywords" id="keywords" class="form-control" placeholder="搜索该分类" value="<?=ArrayHelper::getValue($_GET, 'keywords')?>">
                        <div class="input-group-addon search-form-btn">
                            <img src="/image/search.svg" alt="">
                        </div>
                    </div>
                    <i class="clearfix"></i>
                </form>
            </div>

            <div class="document-list-item">
                <?php if(!empty($doc_list['list'])) { ?>
                <ul>
                    <?php foreach($doc_list['list'] as $v) { ?>
                    <li>
                        <div class="document-icon">
                            <img src="<?=\frontend\models\Document::getIconUrlByExtension($v['extension'])?>" alt="">
                        </div>
                        <div class="document-info">
                            <div class="document-title">
                                <a href="<?=\yii\helpers\Url::to(['view/index', 'id' =>  $v['id']])?>"><?=$v['title']?></a>
                            </div>
                            <div class="document-desc">
                                <span class="document-cate"><a href="">[ <?=Category::getNameById($v['gc_3'])?> ]</a></span>
                                <span class="document-author"><?=$v['owner_name']?></span>
                                <span class="document-size">大小: <?=$v['size'] / 1000?>Kb</span>
                                <span class="document-pageTotal">页数: <?=$v['pages']?></span>
                                <span class="document-score">评分: <?=$v['comment_score']?> 分</span>
                                <span class="document-time">时间: <?=date('Y-m-d', $v['created_at'])?></span>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                    <!--分页数据-->
                    <?= frontend\components\LinkPager::widget([
                        'pagination' => $doc_list['pagination'],
                        'hideOnSinglePage' => false,
                        'nextPageLabel'=>'下一页',
                        'prevPageLabel'=>'上一页',
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                    ]) ?>
                <?php } else {?>
                    <p class="empty-list">未查到相关数据</p>
                <?php } ?>
            </div>
        </div>
        <div class="pull-right">
            <?=$this->render('second-cate', ['category' => $first_cate, 'active_id' => $second_active_id])?>
        </div>
        <i class="clearfix"></i>
    </div>
</div>
<?php
$js = <<<JS
$('.document-filter .filter-item-extension select').change(function(){
    var value = $(this).val();
    var url = changeURLArg(window.location.href, 'extension', value);
    window.location.href = url;
});

$('.document-filter .filter-item-sort select').change(function(){
    var value = $(this).val();
    var url = changeURLArg(window.location.href, 'sort', value);
    window.location.href = url;
});

$('.document-filter form').submit(function(){
    var value = $('.document-filter .filter-item-keyword #keywords').val();
    var url = changeURLArg(window.location.href, 'keywords', value);
    window.location.href = url;
    return false;
});

$('.document-filter .filter-item-keyword .search-form-btn').click(function(){
    var value = $('.document-filter .filter-item-keyword #keywords').val();
    var url = changeURLArg(window.location.href, 'keywords', value);
    window.location.href = url;
});

JS;

$this->registerJs($js);

?>
