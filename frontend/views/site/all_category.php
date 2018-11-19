<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/25 Time: 5:50 PM
//---------------------------------------------------------

$this->title = '全部分类';
$this->registerCssFile('/css/category.css', ['depends'=>['frontend\assets\AppAsset']]);

$first_cate_list = \frontend\models\Category::getListByPid()
?>
<div class="category">
    <div class="container">
        <?php foreach($first_cate_list as $first) { ?>
        <div class="category-list-item">
            <h4><?=$first->name?> : </h4>
            <ul>
                <?php
                    $second_cate_list = \frontend\models\Category::getListByPid($first->id);
                ?>
                <?php foreach($second_cate_list as $second) { ?>
                <li><a href="<?=\yii\helpers\Url::to(['/list/index', 'id' => $second->id])?>"><?=$second->name?></a></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>
