<ul class="nav nav-tabs"
    style="">
    <?php

    use yii\helpers\Url;

    $tabMenu = \common\services\AdminMenuService::getTabAssignedMenu();
    $route = explode('/', Yii::$app->controller->route);
    if (isset($tabMenu[$route[0]]['tab'])) {
        foreach ($tabMenu[$route[0]]['tab'] as $menu) {
            ?>
            <li class="<?php if ($route[0] . '/' . $route[1] == trim($menu['url'], '/')) {
                echo "active";
            } ?>">
                <a href="<?= Url::to($menu['url']) ?>"><?= $menu['name'] ?></a>
            </li>
        <?php }
    } ?>
</ul>