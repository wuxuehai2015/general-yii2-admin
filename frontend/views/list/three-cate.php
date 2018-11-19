<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/3 Time: 3:44 PM
//---------------------------------------------------------

use yii\helpers\Url;
use frontend\models\Document;

/* @var $category \frontend\models\Category*/
/* @var $active_id int 0*/

$sub_cate_list = \frontend\models\Category::getListByPid($category->id);

?>
<div class="sub-cate-list">
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
