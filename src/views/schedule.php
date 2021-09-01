<?php
    include_once 'config.php';

    $page_name = 'расписание';
    $title = \PensionFund\Config::getProjectName() . ': ' . $page_name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="src/styles/general.css">
    <link rel="stylesheet" href="src/styles/measure.css">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <title><?= $title; ?></title>
</head>
<body>
    <div class="wrapper">
        <?php require_once __DIR__ . '/menu.php'; ?>
        <!-- <div class="clear"></div> -->
        <div class="content">
            <div class="insideContent">
                <h1><?= mb_convert_case($page_name, MB_CASE_TITLE, 'UTF-8'); ?></h1>
                
                <input class="search" id="searchInput" type="text" placeholder="Поиск по расписанию...">
                <table id="mainTable">
                    <tr>
                        <th data-value="date" data-caption="Дата">Дата</th>
                        <th data-value="link" data-caption="Ссылка">Ссылка</th>
                        <th data-value="course_name" data-caption="Курс">Курс</th>
                        <?php if ($_SESSION['user']->user['role'] != 0 && !empty($_GET['courseId'])): ?>
                            <th></th>
                            <th></th>
                        <?php endif; ?>
                    </tr>
                </table>

                <div id="loader"></div>

                <button class="primaryBtn reportBtn" id="reportBtn">Отчёт PDF</button>

                <?php if ($_SESSION['user']->user['role'] != 0 && !empty($_GET['courseId'])): ?>

                    <a class="ghostBtn" id="addNewBtn">Добавить <?= $page_name ?></a>

                    <div class="addDataForm" id="addBlock">
                        <h2>Добавить расписание</h2>
                        <input class="addElement" data-input="inputCtrl" type="datetime-local" name="date" placeholder="Дата"/>
                        <input class="addElement" data-input="inputCtrl" type="text" name="link" placeholder="Ссылка"/>

                        <button class="addFormBtn primaryBtn" id="postBtn">Добавить</button>
                        <a class="addFormBtn ghostBtn" id="cancelBtn">Отмена</a>
                    </div>

                <?php endif; ?>

            </div>          
        </div>
        <div class="clear"></div>
    </div>

    <script src="src/scripts/schedule/config.js"></script>
    <script src="src/scripts/config.js"></script>

    <script type="text/javascript" language="javascript">
        config.additionFuelds = {
            course_id: <?= $_GET['courseId'] ? $_GET['courseId'] : 'null'; ?>
        };
    </script>

    <?php if ($_SESSION['user']->user['role'] == 0 || empty($_GET['courseId'])): ?>
        <script>
            config.letUpdate = false;
            config.letDelete = false;
        </script>
    <?php endif; ?>

    <?php if ($_SESSION['user']->user['role'] == 0): ?>
        <script>
            config.additionFuelds.user_id = <?= $_SESSION['user']->user['id']; ?>;
        </script>
    <?php else: ?>
        <script>
            config.additionFuelds.author_id = <?= $_SESSION['user']->user['id']; ?>;
        </script>
    <?php endif; ?>

    <script src="src/scripts/common/form.js"></script>
    <script src="src/scripts/common/update.js"></script>
    <script src="src/scripts/common/delete.js"></script>
    <script src="src/scripts/common/render.js"></script>
    <script src="src/scripts/common/search.js"></script>
    <script src="src/scripts/common/report.js"></script>
    <script src="src/scripts/common/post.js"></script>
    <script src="src/scripts/common/validate.js"></script>

    <script src="src/scripts/schedule/checkLostDate.js"></script>
    <script src="src/scripts/schedule/makeLink.js"></script>
</body>
</html>