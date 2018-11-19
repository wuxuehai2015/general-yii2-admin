<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use common\models\SystemConfig\SystemConfig;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title)?>-<?=SystemConfig::getValueByName('site_name')?></title>
    <meta name="keywords" content="<?=SystemConfig::getValueByName('seo_keywords')?>">
    <meta name="description" content="<?=SystemConfig::getValueByName('seo_description')?>">
    <?php $this->head() ?>

    <script>
        var _csrf = '<?=Yii::$app->request->getCsrfToken()?>';
        var get_cate_list_by_pid_url = '<?=\yii\helpers\Url::to(['/site/get-cate-list-by-pid'])?>';
        var delete_document_url = '<?=\yii\helpers\Url::to(['/user/delete-document'])?>';
        var commit_comment_url = '<?=\yii\helpers\Url::to(['/view/create-comment'])?>';
        var get_comment_list_url = '<?=\yii\helpers\Url::to(['/view/get-comment'])?>';
        var get_comment_list_url = '<?=\yii\helpers\Url::to(['/view/get-comment'])?>';
        var create_favorite_url = '<?=\yii\helpers\Url::to(['/view/create-favorite'])?>';

        function changeURLArg(url,arg,arg_val){
            var pattern=arg+'=([^&]*)';
            var replaceText=arg+'='+arg_val;
            if(url.match(pattern)){
                var tmp='/('+ arg+'=)([^&]*)/gi';
                tmp=url.replace(eval(tmp),replaceText);
                return tmp;
            }else{
                if(url.match('[\?]')){
                    return url+'&'+replaceText;
                }else{
                    return url+'?'+replaceText;
                }
            }
            return url+'\n'+arg+'\n'+arg_val;
        }
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="main">
        <?=$this->render('header')?>
        <?=$this->render('nav')?>
        <?=$content?>
    </div>
</div>
<?=$this->render('footer')?>
<?php $this->endBody() ?>

<div style="display: none">
    <?=SystemConfig::getValueByName('cnzz')?>
</div>
</body>
</html>
<?php $this->endPage() ?>
