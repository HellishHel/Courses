<?php
    include_once 'config.php';

    $title = \PensionFund\Config::getProjectName();
?>

<!-- <i id="hamburger" class="fa fa-bars"></i> -->

<div class="menu">
    <nav>
        <!-- <i id="closeMenu" class="fas fa-times"></i> -->
        <h1><?= $title; ?></h1>
        <a class="navLink" href="/course">Курсы</a>
        <a class="navLink" href="/schedule">Расписание</a>
        <a class="navLink" href="/myAccount">Личный кабинет</a>
        <?php if ($_SESSION['user']->user['role'] == 1): ?>
            <a class="navLink" href="/myCourse">Мои курсы</a>
            <a class="navLink" href="/category">Категории</a>
        <?php endif; ?>
        <a class="navLink" href="src/images/lits-2021.jpg" target="_blank">Сертификат</a>

        <a class="navLink" id="logoutBtn" href="/logout">Выход</a>
    </nav>
</div>

<!-- <script src="src/scripts/menu/menuOpenClose.js"></script> -->