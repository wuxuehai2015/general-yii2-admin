<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/15 Time: 下午4:27
//---------------------------------------------------------

namespace common\widgets;


use yii\bootstrap\Widget;
use yii\helpers\Html;

class Select3 extends Widget
{
    public $names = [];

    public function run()
    {
        Html::beginTag('div');
        Html::label('频道', 'channel-id');
        Html::beginTag('select');
        Html::beginTag('option');
        Html::beginTag('options');
        Html::endTag('select');
        Html::endTag('div');
    }
}