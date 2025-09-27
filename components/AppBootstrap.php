<?php

namespace app\components;

use yii\base\BootstrapInterface;

/**
 * App Bootstrap class
 */
class AppBootstrap implements BootstrapInterface
{
    /**
     * Bootstrap function
     *
     * @param \yii\base\Application $app
     * @return void
     */
    public function bootstrap($app)
    {
        require __DIR__ . '/../helpers/functions.php';
    }
}
