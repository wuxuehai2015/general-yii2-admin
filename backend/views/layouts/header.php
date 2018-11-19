<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$user = \backend\models\User\User::findOne(Yii::$app->getUser()->getId());
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"></span><span class="logo-lg">'. \common\models\SystemConfig\SystemConfig::getValueByName('site_name') .'</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=$user->username?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                            <p>
                                上次登录时间
                                <small><?=date('Y-m-d H:i:s', $user->last_login_at)?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    '修改密码',
                                    ['/site/password'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                                <?= Html::a(
                                    '退出',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
