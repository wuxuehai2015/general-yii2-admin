<?php

namespace common\models\Article;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title 标题
 * @property int $pid 父级ID
 * @property int $status 状态
 * @property string $content 内容
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Article extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid', 'content', 'created_at', 'updated_at'], 'required'],
            [['pid', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'pid' => Yii::t('app', '父级ID'),
            'status' => Yii::t('app', '状态'),
            'content' => Yii::t('app', '内容'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }
}
