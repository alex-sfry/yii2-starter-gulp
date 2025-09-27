<?php

/** @var yii\web\View $this */
/** @var app\models\forms\ResendVerificationEmailForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Account is inactive';
$this->registerJs("
    (function showResendForm() {
        $('#showResendForm').on('click', function () {
            $('#resendActivationEmailForm').removeClass('d-none');
            $(this).hide();
        })
    })()
")
?>
<h1 class="text-center text-danger"><?= e($this->title) ?></h1>

<p class="text-light text-center">Activate account by clicking on a link sent to your email.</p>

<div class="text-center">
    <button id="showResendForm" class="btn btn-success text-center">Resend activation email</button>
</div>

<div id="resendActivationEmailForm" class="row justify-content-center d-none">
    <div class="col-lg-4">

        <?php $form = ActiveForm::begin(['action' => Url::to(['user/resend-verification-email'])]); ?>
        <?= $form
            ->field($model, 'email', ['labelOptions' => ['class' => 'col-form-label text-light']])
            ->textInput() ?>
        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
        <?php $form = ActiveForm::end(); ?>

    </div>
</div>