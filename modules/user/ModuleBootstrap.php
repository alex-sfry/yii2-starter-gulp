<?php

namespace app\modules\user;

use yii\base\BootstrapInterface;

/**
 * User module Bootstrap class
 */
class ModuleBootstrap implements BootstrapInterface
{
    /**
     * Bootstrap function
     *
     * @param \yii\base\Application $app
     * @return void
     */
    public function bootstrap($app): void
    {
        $app->getUrlManager()->addRules([
            'user/verify-email' => USE_GUI_SIGNUP ? 'user/user/verify-email' : 'site/error',
            'user/resend-verification-email' => USE_GUI_SIGNUP ? 'user/user/resend-verification-email' : 'site/error',
            'user/reset-password' => USE_GUI_SIGNUP ? 'user/user/reset-password' : 'site/error',
            'user/request-password-reset' => USE_GUI_SIGNUP ? 'user/user/request-password-reset' : 'site/error',
            'user/signup' => USE_GUI_SIGNUP ? 'user/user/signup' : 'site/error',
            'user/login' => 'user/user/login',
            'user/logout' => 'user/user/logout'
        ]);
    }
}
