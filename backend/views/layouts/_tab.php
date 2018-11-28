<ul class="nav nav-tabs" style="">
    <?php

    use yii\helpers\Url;

    $tabMenu = \common\services\AdminMenuService::getTabAssignedMenu();
    $controller_id = Yii::$app->controller->id;
    $action_id = Yii::$app->controller->action->id;
    $route = explode('/', Yii::$app->controller->route);

    if (isset($tabMenu[$route[0]]['tab'])) {
        foreach ($tabMenu[$route[0]]['tab'] as $menu) {

            $include = $menu['options']['include'] ?? [];
            ?>
            <li class="<?=in_array($controller_id . '/' . $action_id, $include) ? 'active' : '' ?>">
                <a href="<?= Url::to($menu['url']) ?>"><?= $menu['name'] ?></a>
            </li>
        <?php }
    } ?>
</ul>
