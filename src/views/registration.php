<?php
include_once 'config.php';

$page_name = 'регистрация';
$title = \PensionFund\Config::getProjectName() . ': ' . $page_name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/general.css">
    <title><?= $title; ?></title>
</head>
<body>
    <div class="wrapper">
        <div class="clear"></div>
        <div class="content-bl">
            <div class="authAndRegBlock" id="regBlock">
                <h1><?= mb_convert_case($page_name, MB_CASE_TITLE, 'UTF-8'); ?></h1>
                <form action="" method="POST">
                    <input class="addElement" name="surname" type="text" placeholder="Фамилия" data-input="inputCtrl" data-valid-pattern="[а-яА-Я]{2,50}">
                    <input class="addElement" name="firstname" type="text" placeholder="Имя" data-input="inputCtrl" data-valid-pattern="[а-яА-Я]{2,50}">
                    <input class="addElement" name="middlename" type="text" placeholder="Отчество" data-input="inputCtrl" data-valid-pattern="[а-яА-Я]{2,50}">
                    <input class="addElement" name="email" type="email" placeholder="Email" data-input="inputCtrl" data-valid-pattern="^([\w\.\-]+)@([\w\-]+)((\.(\w){2,})+)$">
                    <input class="addElement" name="password" type="password" placeholder="Пароль">
                    <input class="addElement" name="passwordAgain" type="password" placeholder="Повторите пароль">

                    <p style="text-align: left; font-size: 1.5rem;">
                        <input name="isAuthor" type="checkbox" style="margin-left: 0.5rem;">
                        я автор
                    </p>

                    <input class="primaryBtn" name="signIn" id="postBtn" type="submit" value="Регистрация">
                </form>
                <a href="/authorization">Пройти авторизацию</a>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <script src="src/scripts/config.js"></script>
    <script src="src/scripts/common/validate.js"></script>
</body>
</html>