<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/7/31 Time: 下午3:40
//---------------------------------------------------------

namespace common\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class BaseModel extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ],
                'value' => time()
            ]
        ];
    }

    public function getHtmlError()
    {
        $htmlError = '';
        if ($this->hasErrors()) {
            foreach ($this->getFirstErrors() as $error) {
                $htmlError .= '<br/>' . $error;
            }
        }

        return $htmlError;
    }

    public static function getStatusOptions()
    {
        return [
            self::STATUS_INACTIVE => '关闭',
            self::STATUS_ACTIVE => '启用',
        ];
    }

    public static function getStatusName($status)
    {
        $item = static::getStatusOptions();
        return ArrayHelper::getValue($item, $status, '无');
    }

    public static function getStatusOptionsByHtml()
    {
        return [
            self::STATUS_INACTIVE => '<strong class="text-danger">关闭</strong>',
            self::STATUS_ACTIVE => '<strong class="text-success">启用</strong>',
        ];
    }

    public static function count()
    {
        return static::find()->where(['status' => self::STATUS_ACTIVE])->count();
    }


    /**
     * @param $id
     * @param $field
     * @return mixed|string
     */
    public static function getFieldById($id, $field)
    {
        $info = static::find()->where(['id' => $id])->cache(60)->asArray()->one();
        return ArrayHelper::getValue($info, $field, '');
    }
}
