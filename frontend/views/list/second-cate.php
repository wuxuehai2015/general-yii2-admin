<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 4:00 PM
//---------------------------------------------------------

use yii\helpers\Url;
use frontend\models\Document;
use frontend\models\Category;

/* @var $category \frontend\models\Category*/
/* @var $active_id int 0*/

$sub_cate_list = Category::getListByPid($category->id);

$ads = \common\models\Ad\Ad::getList(\common\models\Ad\Ad::POS_LIST);

?>
<div class="middle-cate-list hidden-sm hidden-xs">
    <h4><?=$category->name?></h4>
    <ul>
        <li>
            <a  class="<?=$active_id == 0 ? 'active' : ''?>" href="<?=Url::to(['list/index', 'id' =>  $category->id])?>">不限分类 ( <?=Document::getCountByPid($category->id, $category->deep)?> ) </a>
        </li>
        <?php foreach($sub_cate_list as $v){ ?>
            <li>
                <a class="<?=$active_id == $v->id ? 'active' : ''?>" href="<?=Url::to(['list/index', 'id' =>  $v->id])?>"><?=$v->name?> ( <?=Document::getCountByPid($v->id, $v->deep)?> )</a>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="ad">
    <?php if(!empty($ads)) { ?>
        <?php foreach ($ads as $k => $ad) { ?>
            <p>
                <a href="<?=$ad->link?>" target="_blank"><img src="<?=$ad->image?>" alt=""></a>
            </p>
        <?php } ?>
    <?php } ?>
</div>
