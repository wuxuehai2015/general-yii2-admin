<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/11/11 Time: 10:08 AM
//---------------------------------------------------------

namespace backend\models\forms;


use backend\models\User\User;

class ChangePassForm extends User
{
    public $old_pass;
    public $re_pass;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_pass', 're_pass', 'password'], 'required'],
            ['old_pass', 'validatePass'],
            ['re_pass', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码不一致'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_pass' => '旧密码',
            're_pass' => '重复密码',
            'password' => '新密码',
        ];
    }

    public function validatePass($attribute, $params)
    {
        if (!$this->validatePassword($this->old_pass)) {
            $this->addError($attribute, '旧密码不正确');
        }
    }

    /**
     * 修改用户资料
     * @return bool
     */
    public function changePass()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->setPassword($this->password);

        return $this->save(false);
    }

}
