<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\forms\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
    $('#form-signup').on('afterValidateAttribute', function (e, attribute, messages, deferreds) {
        attribute.name === 'password_repeat' && $('#signupform-password').trigger('blur');
        return true;
    });
")
?>
<div class="site-signup">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Please fill out the following fields to signup:</p>

    <div class="row justify-content-center">
        <div class="col-lg-5 bg-light rounded-1">
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label me-lg-3 text-nowrap'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => false]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'password_repeat')->label('Repeat Password')->passwordInput() ?>

                <?= $form->field($model, 'email') ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
