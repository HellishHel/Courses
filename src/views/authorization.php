<?php
include_once 'config.php';

$page_name = 'авторизация';
$title = \PensionFund\Config::getProjectName() . ': ' . $page_name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/general.css">
    <link rel="stylesheet" href="src/styles/authorization.css">
    <title><?= $title; ?></title>
</head>
<body>
    <div class="wrapper">
        <div class="clear"></div>
        <div class="content-bl">
            <div class="authAndRegBlock" id="authBlock">
                <h1><?= mb_convert_case($page_name, MB_CASE_TITLE, 'UTF-8'); ?></h1>
                <form action="" method="POST">
                    <input class="addElement" name="email" type="text" placeholder="Email" value="<?= $_SESSION['login']; ?>">
                    <input class="addElement" name="password" type="password" placeholder="Пароль" value="<?= $_SESSION['password']; ?>">
                    <input class="primaryBtn" name="sendLogIn" id="logIn" type="submit" value="Войти">
                </form>
                <p>
                    <?= $_SESSION['authorizationMessage']; ?>
                </p>
                <a href="/registration">
                    Создать аккаунт
                </a>
            </div>          
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>