<?php

namespace common\models\SystemLog;

use Yii;

/**
 * This is the model class for table "system_log".
 *
 * @property int $id
 * @property string $url
 * @property string $request
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 */
class SystemLog extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'request', 'content'], 'required'],
            [['url', 'request', 'content'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'request' => Yii::t('app', 'Request'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
