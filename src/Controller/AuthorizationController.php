<?php

    namespace PensionFund\Controller;

    use PensionFund\Model\AuthorizationModel;
    use PensionFund\Dev\Debug;

    class AuthorizationController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/authorization.php';
        }

        public function checkLogIn()
        {
            $errors = [];
            $model = new AuthorizationModel();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $send = $_POST['sendLogIn'];

            $_SESSION['login'] = $email;
            $_SESSION['password'] = $password;

            if (!empty($send)) {
                if (empty($email)) {
                    $errors[] = 'Введите email';
                }

                if (empty($password)) {
                    $errors[] = 'Введите пароль';
                }

                if (count($errors) === 0) {
                    $user = $model->get($email, $password);

                    if (empty($user)) {
                        $errors[] = 'Такого пользователя не существует';
                    }
                }

                $answer = new \stdClass();
                $answer->user = $user;
                $answer->isLogin = count($errors) === 0 ? true : false;
                $answer->errors = $errors;

                return $answer;
            }
        }
    }
