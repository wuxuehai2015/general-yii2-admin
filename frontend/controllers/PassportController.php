<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/10/4 Time: 11:39 AM
//---------------------------------------------------------

namespace frontend\controllers;


use common\models\User;
use common\services\SmsService;
use EasyWeChat\Factory;
use frontend\models\forms\BindForm;
use frontend\models\forms\FindPasswordForm;
use frontend\models\forms\LoginForm;
use frontend\models\forms\RegisterForm;
use Yii;
use yii\helpers\Url;

class PassportController extends BaseController
{
    public $defaultAction = 'login';

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest && $action->id != 'logout') {
            return $this->redirect(['/site/index']);
        }
        return true;
    }

    /**
     * 登录
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/site/index'])->send();
        }

        return $this->renderPartial('login', ['model' => $model]);
    }


    /**
     * 注册
     * @return string|\yii\web\Response
     */
    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['/site/index']);
        }

        $model->agree_protocol = 1;
        return $this->renderPartial('register', ['model' => $model]);
    }


    /**
     * 重置密码
     * @return string|\yii\web\Response
     */
    public function actionFindPassword()
    {
        $model = new FindPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            return $this->redirect(['login']);
        }

        return $this->renderPartial('find-password', ['model' => $model]);
    }


    public function actionLoginWeiBo()
    {
        $code = Yii::$app->request->get('code', '');
        $weiBoAuth = new \SaeTOAuthV2('4033662937', 'a592c632f31d9bcb438618e8fcedaf1d');

        if (empty($code)) {
            $AuthorizeURL = $weiBoAuth->getAuthorizeURL(Url::to(['/passport/login-wei-bo'], true));
            return $this->redirect($AuthorizeURL)->send();
        } else {

            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = Url::to(['/passport/login-wei-bo'], true);

            try {
                $token = $weiBoAuth->getAccessToken('code', $keys);
                $user = User::findByUserWbOpenId($token['uid']);

                if ($user) {
                    Yii::$app->user->login($user);
                    return $this->goHome();
                } else {
                    Yii::$app->session->set('client', 'weibo');
                    Yii::$app->session->set('open_id', $token['uid']);
                    return $this->redirect(Url::to(['/passport/bind']))->send();
                }
            } catch (\Exception $e) {
                return $this->redirect(Url::to(['/passport/login-wei-bo']))->send();
            }
        }
    }

    public function actionLoginWeiXin()
    {
        $code = Yii::$app->request->get('code', '');

        $config = [
            'app_id' => 'wx9c562c34c972d02a',
            'secret' => '4941ab59c8a1d1e0bb9c18aedf8566ef',
            'oauth' => [
                'scopes'   => ['snsapi_login'],
                'callback' => '/passport/login-wei-xin.html',
            ],
        ];

        $app = Factory::officialAccount($config);
        $oauth = $app->oauth;

        if (empty($code)) {
            return $oauth->redirect()->send();
        } else {
            try {
                $open_id = $oauth->user()->getId();
                $user = User::findByUserWxOpenId($open_id);
                if ($user) {
                    Yii::$app->user->login($user);
                    return $this->goHome();
                } else {
                    Yii::$app->session->set('client', 'weixin');
                    Yii::$app->session->set('open_id', $open_id);
                    return $this->redirect(Url::to(['/passport/bind']))->send();
                }
            } catch (\Exception $e) {
                return $this->redirect(Url::to(['/passport/login-wei-xin']))->send();
            }
        }
    }

    public function actionBind()
    {
        $client = Yii::$app->session->get('client', '');
        $open_id = Yii::$app->session->get('open_id', '');

//        if (!$client || !$open_id) {
//            $this->redirect(['/passport']);
//        }

        $model = new BindForm();
        $model->client = $client;
        $model->open_id = $open_id;

        if ($model->load(Yii::$app->request->post()) && $model->bind()) {
            return $this->redirect(['/site/index']);
        }

        $model->agree_protocol = 1;
        return $this->renderPartial('bind', ['model' => $model]);
    }


    /**
     * 发送短信验证码
     * @return array
     */
    public function actionSendSmsCode()
    {
        $mobile = Yii::$app->request->post('mobile', '');
        $code = rand(111111, 999999);
        $smsService = new SmsService();
        if ($smsService->sendVerifyCode($mobile, $code)) {
            Yii::$app->redis->hset('sms_code', $mobile, $code);
            return $this->returnJson(200, '操作成功');
        } else {
            return $this->returnJson(500, $smsService->error);
        }
    }

    /**
     * 退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
