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

    /**
     * @return array
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_INACTIVE => '关闭',
            self::STATUS_ACTIVE => '启用',
        ];
    }

    /**
     * @param $status
     * @return mixed
     */
    public static function getStatusName($status)
    {
        $item = static::getStatusOptions();
        return ArrayHelper::getValue($item, $status, '无');
    }

    /**
     * @return int|string
     */
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

    /**
     * @return \yii\caching\CacheInterface
     */
    public static function getCache()
    {
        return \Yii::$app->cache;
    }
}
