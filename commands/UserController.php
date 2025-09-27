<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\modules\user\models\User;

class UserController extends Controller
{
    /**
     * Adds a new user from console.
     * Example:
     * yii user/create "john" "john@example.com" "secret123"
     */
    public function actionCreate(string $username, string $email): int
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $password = $this->prompt('Enter password: ', ['required' => true/* , 'pattern' => '.{6,}' */]);
        $user->setPassword($password);
        $user->generateAuthKey();

        if ($user->save()) {
            $this->stdout("User {$username} created successfully.\n", \yii\helpers\Console::FG_GREEN);
            return ExitCode::OK;
        } else {
            $this->stderr("Failed to create user:\n", \yii\helpers\Console::FG_RED);
            foreach ($user->errors as $field => $errors) {
                foreach ($errors as $error) {
                    $this->stderr("- {$field}: {$error}\n", \yii\helpers\Console::FG_YELLOW);
                }
            }
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}
