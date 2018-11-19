<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "operation_log".
 *
 * @property int $id
 * @property string $action 动作
 * @property string $uri 地址
 * @property int $ip id地址
 * @property int $identity_id 身份id
 * @property string $identity_name 身份名称
 * @property int $created_at 添加时间
 */
class OperationLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operation_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'identity_id', 'created_at'], 'integer'],
            [['action', 'uri'], 'string', 'max' => 255],
            [['identity_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => '动作',
            'uri' => '地址',
            'ip' => 'id地址',
            'identity_id' => '身份id',
            'identity_name' => '身份名称',
            'created_at' => '添加时间',
        ];
    }
}
