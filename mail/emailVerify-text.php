<?php

/** @var yii\web\View $this */
/** @var app\models\User $user */

$verifyLink = Yii::$app
    ->urlManager
    ->createAbsoluteUrl(['/user/user/verify-email', 'token' => $user->verification_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>
