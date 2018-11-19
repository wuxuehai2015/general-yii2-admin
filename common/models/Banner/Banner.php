<?php

namespace common\models\Banner;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $image 图片地址
 * @property string $link 链接地址
 * @property int $sort 排序
 * @property int $status 状态，0-禁用，1-正常
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Banner extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'link'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        return ArrayHelper::merge($scenario, [
            'update_attribute' => ['title', 'sort', 'link', 'status']
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'image' => Yii::t('app', '图片'),
            'link' => Yii::t('app', '链接'),
            'sort' => Yii::t('app', '排序'),
            'status' => Yii::t('app', '状态'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @return array|Banner[]|\frontend\models\Category[]|\frontend\models\DocumentComment[]|\frontend\models\UserDownloadHistory[]|\frontend\models\UserDownloads[]|\frontend\models\UserHistory[]|\yii\db\ActiveRecord[]
     */
    public static function getList()
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE])->all();
    }
}
