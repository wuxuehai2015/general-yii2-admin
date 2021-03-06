<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/23 Time: 4:38 PM
//---------------------------------------------------------

namespace backend\models\User;


class User extends \common\models\User
{
    public $password;

    public $add_point;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'mobile'], 'required'],
            ['username', 'string', 'min' => 2],
            ['mobile', 'unique'],
            [['auth_key', 'email'], 'default', 'value' => ''],
            ['password', 'string', 'min' => 6, 'max' => 50, 'skipOnEmpty' => true],
            [['username', 'mobile', 'remark', 'password'], 'safe']
        ];
    }

    public function beforeSave($insert)
    {
        if (!empty($this->password)) {
            $this->setPassword($this->password);
        }

        return parent::beforeSave($insert);
    }

}
