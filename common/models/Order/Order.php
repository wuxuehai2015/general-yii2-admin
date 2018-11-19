<?php

namespace common\models\Order;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $order_sn
 * @property int $user_id
 * @property string $user_name
 * @property string $user_avatar
 * @property int $doc_id
 * @property string $doc_name
 * @property string $doc_extension
 * @property string $price
 * @property int $status
 * @property int $updated_at
 * @property int $created_at
 */
class Order extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'doc_id', 'price', 'status', 'updated_at', 'created_at'], 'required'],
            [['user_id', 'doc_id', 'status', 'updated_at', 'created_at'], 'integer'],
            [['price'], 'number'],
            [['order_sn'], 'string', 'max' => 20],
            [['user_name'], 'string', 'max' => 50],
            [['user_avatar', 'doc_name'], 'string', 'max' => 255],
            [['doc_extension'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_sn' => Yii::t('app', 'Order Sn'),
            'user_id' => Yii::t('app', 'User ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'user_avatar' => Yii::t('app', 'User Avatar'),
            'doc_id' => Yii::t('app', 'Doc ID'),
            'doc_name' => Yii::t('app', 'Doc Name'),
            'doc_extension' => Yii::t('app', 'Doc Extension'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
