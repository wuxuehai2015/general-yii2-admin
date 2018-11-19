<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $name 文件名称
 * @property string $path 路径
 * @property string $extension 后缀
 * @property int $size 文件大小
 * @property int $md5
 * @property int $identity_id 上传者id
 * @property string $identity_name 上传者名称
 * @property int $created_at
 * @property int $updated_at
 */
class File extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['size', 'md5', 'identity_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'path', 'extension', 'identity_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '文件名称'),
            'path' => Yii::t('app', '路径'),
            'extension' => Yii::t('app', '后缀'),
            'size' => Yii::t('app', '文件大小'),
            'md5' => Yii::t('app', 'Md5'),
            'identity_id' => Yii::t('app', '上传者id'),
            'identity_name' => Yii::t('app', '上传者名称'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
