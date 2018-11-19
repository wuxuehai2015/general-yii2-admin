<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $remark
 * @property string $avatar
 * @property string $mobile
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $wb_open_id
 * @property string $wx_open_id
 * @property integer $status
 * @property string $last_ip
 * @property integer $last_login_at
 * @property integer $points
 * @property integer $is_admin
 * @property integer $allow_upload_doc
 * @property integer $login_continuity_count
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends BaseModel implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }


    /**
     * Finds user by username
     *
     * @param $mobile
     * @return static|null
     */
    public static function findByUserMobile($mobile)
    {
        return static::find()->where(['mobile' => $mobile, 'status' => self::STATUS_ACTIVE])->one();
    }

    /**
     * Finds user by username
     *
     * @param $openId
     * @return static|null
     */
    public static function findByUserWbOpenId($openId)
    {
        return static::find()->where(['wb_open_id' => $openId, 'status' => self::STATUS_ACTIVE])->one();
    }

    /**
     * Finds user by username
     *
     * @param $openId
     * @return static|null
     */
    public static function findByUserWXOpenId($openId)
    {
        return static::find()->where(['wx_open_id' => $openId, 'status' => self::STATUS_ACTIVE])->one();
    }


    /**
     * @param $username
     * @return array|User|null|ActiveRecord
     */
    public static function findByUsernameOrMobile($username)
    {
        return static::find()->andWhere(
            [
                'or',
                ['status' => self::STATUS_ACTIVE, 'username' => $username],
                ['status' => self::STATUS_ACTIVE, 'mobile' => $username],
            ]
        )->one();
    }

    /**
     * @param $username
     * @return array|User|null|ActiveRecord
     */
    public static function findByBackendLogin($username)
    {
        return static::find()->andWhere(['and', ['status' => self::STATUS_ACTIVE, 'is_admin' => 1], ['username' => $username]])->orWhere(['and', ['status' => self::STATUS_ACTIVE], ['mobile' => $username]])->one();
    }


    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public static function countPoint()
    {
        return self::find()->sum('points');
    }

    /**
     * @param int $days
     * @return array
     */
    public static function statisticsRegister($days = 15)
    {
        $data = [];
        $currentDateTime = strtotime(date('Ymd'));
        for ($i = 0; $i < $days; $i++) {
            if ($i == 0) {
                $start = $currentDateTime;
            } else {
                $start = strtotime("-{$i}day", $currentDateTime);
            }

            $query = self::find()
                ->select(new Expression("count(id) as number"));

            $item = $query->andWhere(['between', 'created_at', $start, $start + 60 * 60 * 24])
                ->asArray()
                ->one();

            $data[$i] = [
                'date' => date('m月d日', $start),
                'number' => $item['number']
            ];

        }

        sort($data, SORT_DESC);

        $data = ArrayHelper::map($data, 'date', 'number');
        return $data;
    }
}