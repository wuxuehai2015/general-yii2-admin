<?php

namespace common\models\SystemConfig;

use Yii;
use common\models\BaseModel;

/**
 * This is the model class for table "system_config".
 *
 * @property int $id
 * @property string $site_name 网站名称
 * @property string $icp 网站备案号
 * @property string $ga_icp 网站备案号
 * @property string $cnzz 网站备案号
 * @property string $seo_keywords 网站备案号
 * @property string $seo_description 网站备案号
 * @property string $wx_qr_code 网站备案号
 * @property string $default_avatar 网站备案号
 * @property string $report_template
 * @property string $point_register
 * @property string $point_login
 * @property string $point_continuity_login
 * @property string $point_browse_document
 * @property string $point_comment_document
 * @property string $point_share_document
 * @property string $point_feedback
 * @property string $point_bind_wexin
 * @property string $point_bind_webo
 * @property string $point_update_avatar
 *
 * @property string $created_at 网站备案号
 * @property string $updated_at 网站备案号
 */
class SystemConfig extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_name', 'icp', 'ga_icp', 'cnzz', 'seo_keywords', 'seo_description', 'wx_qr_code', 'default_avatar', 'report_template', 'point_register', 'point_login', 'point_bind_webo', 'point_bind_wexin', 'point_update_avatar', 'point_continuity_login', 'point_browse_document', 'point_comment_document', 'point_share_document', 'point_feedback'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'site_name' => Yii::t('app', '网站名称'),
            'icp' => Yii::t('app', '网站备案号'),
            'ga_icp' => Yii::t('app', '公安备案号'),
            'cnzz' => Yii::t('app', 'CNZZ统计代码'),
            'seo_keywords' => Yii::t('app', 'SEO关键字'),
            'seo_description' => Yii::t('app', 'SEO介绍'),
            'wx_qr_code' => Yii::t('app', '微信公众号二维码'),
            'default_avatar' => Yii::t('app', '用户默认头像'),
            'report_template' => Yii::t('app', '举报模板'),
            'point_register' => Yii::t('app', '注册积分'),
            'point_login' => Yii::t('app', '登录积分'),
            'point_bind_webo' => Yii::t('app', '绑定微博积分'),
            'point_bind_wexin' => Yii::t('app', '绑定微信积分'),
            'point_update_avatar' => Yii::t('app', '更新头像积分'),
            'point_continuity_login' => Yii::t('app', '连续登陆积分'),
            'point_browse_document' => Yii::t('app', '浏览文档积分'),
            'point_comment_document' => Yii::t('app', '评论文档积分'),
            'point_share_document' => Yii::t('app', '分享文档积分'),
            'point_feedback' => Yii::t('app', '反馈采纳积分')
        ];
    }

    /**
     * 根据名称获取值
     * @param $name
     * @return mixed|string
     */
    public static function getValueByName($name)
    {
        $info = self::findOne(1);
        return isset($info->$name) ? $info->$name : '';
    }
}
