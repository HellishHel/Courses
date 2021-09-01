<?php
    namespace PensionFund;

    session_start();
    
    require_once __DIR__ . '/bootstrap.php';
    include_once __DIR__ . '/config.php';

    use PensionFund\Controller\{
        AuthorizationController,
        RegistrationController,
        CategoryController,
        MyCourseController,
        MyAccountController,
        CourseController,
        ScheduleController
    };

    $uri = $_SERVER['REQUEST_URI'];

    if ($_SESSION['auth'] !== 1 && $uri !== '/authorization' && $uri !== '/registration') {
        header("Location:/authorization");
    }

    // Получаем GET переменные.
    $uri = explode('?', $uri);
    $getParams = $uri[1];
    $uri = $uri[0];

    switch ($uri) {
        case '/authorization': {
            $page = new AuthorizationController();
            $checkUser = $page->checkLogIn();

            if (count($checkUser->errors) > 0) {
                $_SESSION['authorizationMessage'] = array_shift($checkUser->errors);

                header("Location:" . $_SERVER['HTTP_REFERER']);
            } else if ($checkUser->isLogin && empty($checkUser->errors)) {
                $_SESSION['auth'] = 1;
                $_SESSION['user'] = $checkUser;

                header('Location:/course');
            }

            $page->execute();
        } break;
        case '/registration': {
            $page = new RegistrationController();

            if (!empty($_POST['signIn'])) {
                $page->insert();
                
               header("Location:/authorization");
            }

            $page->execute();
        } break;
        case '/myCourse': {
            (new MyCourseController())->execute();
        } break;
        case '/myAccount': {
            (new MyAccountController())->execute();
        } break;
        case '/course': {
            (new CourseController())->execute();
        } break;
        case '/category': {
            (new CategoryController())->execute();
        } break;
        case '/schedule': {
            (new ScheduleController())->execute();
        } break;
        case '/logout': {
            session_destroy();
            header("Location:/authorization");
        } break;
    }