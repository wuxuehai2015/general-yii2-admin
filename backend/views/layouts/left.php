<?php

?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php try {
            echo \backend\components\Menu::widget(
                [
                    "encodeLabels" => true,
                    "options" => ["class" => "sidebar-menu tree", 'data-widget' => 'tree'],
                    "items" => \common\services\AdminMenuService::getLeftAssignedMenu()
                ]);
        } catch (Exception $e) {
            echo $e->getMessage();die;
        } ?>
    </section>
</aside>
