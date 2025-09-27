<?php

namespace app\modules\user\models\forms;

use app\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => '\app\modules\user\models\User',
                'message' => 'This username has already been taken.'
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\app\modules\user\models\User',
                'message' => 'This email address has already been taken.'
            ],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Signs user up.
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup(): bool
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if (USE_EMAIL_CONFIRMATION) {
            $user->generateEmailVerificationToken();
            return $user->save() && $this->sendEmail($user);
        }

        return $user->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail(User $user): bool
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
