<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/11/28 Time: 4:28 PM
//---------------------------------------------------------

namespace backend\controllers\rbac;


use yii\helpers\Json;

class MenuController extends \mdm\admin\controllers\MenuController
{
    public function actionCreate()
    {
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $data = [
                'icon' => $post['data']['icon'],
                'include' => explode("\r\n", $post['data']['include'])
            ];

            if (isset($data['data']['sub']) && $data['data']['sub']) {
                $data['visible'] = 0;
                $data['group'] = 'tab';
            }

            $post['Menu']['data'] = Json::encode($data);
            \Yii::$app->request->setBodyParams($post);
        }

        return parent::actionCreate();
    }

    public function actionUpdate($id)
    {
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $data = [
                'icon' => $post['data']['icon'],
                'include' => explode("\r\n", $post['data']['include'])
            ];

            if (isset($post['data']['sub']) && $post['data']['sub']) {
                $data['visible'] = 0;
                $data['group'] = 'tab';
            }

            $post['Menu']['data'] = Json::encode($data);
            \Yii::$app->request->setBodyParams($post);

        }

        return parent::actionUpdate($id); // TODO: Change the autogenerated stub
    }
}
