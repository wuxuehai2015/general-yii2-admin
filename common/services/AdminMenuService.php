<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/6 Time: 上午10:20
//---------------------------------------------------------

namespace common\services;


use mdm\admin\components\MenuHelper;
use Yii;

class AdminMenuService extends MenuHelper
{
    /**
     * 获取左侧菜单
     * @return array
     */
    public static function getLeftAssignedMenu()
    {
        return MenuHelper::getAssignedMenu(Yii::$app->user->id, null, function ($menu){
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //处理我们的配置
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标，默认图标大家可以自己随便修改
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
            $items && $return['items'] = $items;
            return $return;
        });
    }

    /**
     * 获取tab菜单
     * @return array
     */
    public static function getTabAssignedMenu()
    {
        $tabMenu = [];
        MenuHelper::getAssignedMenu(Yii::$app->user->id, null, function ($menu) use (&$tabMenu) {
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //处理我们的配置
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;

                $array_route = explode('/', $menu['route']);

                if (isset($data['group']) && !empty($data['group'])) {
                    $s_menu = [
                        'name' => $menu['name'],
                        'url' => $menu['route']
                    ];

                    if (isset($tabMenu[$array_route[1]])) {
                        if (!isset($tabMenu[$array_route[1]][$data['group']])) {
                            $tabMenu[$array_route[1]][$data['group']] = [$s_menu];
                        } else {
                            array_push($tabMenu[$array_route[1]][$data['group']], $s_menu);
                        }
                    } else {
                        $tabMenu[$array_route[1]] = [$data['group'] => [$s_menu]];
                    }
                }
            }
            //没配置图标的显示默认图标，默认图标大家可以自己随便修改
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
            $items && $return['items'] = $items;
            return $return;
        });

        return $tabMenu;
    }
}