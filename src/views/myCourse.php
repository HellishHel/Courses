<?php
include_once 'config.php';

$page_name = 'мои курсы';
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

                <input class="search" id="searchInput" type="text" placeholder="Поиск по курсам...">
                <table id="mainTable">
                    <tr>
                        <th data-value="name" data-caption="Наименование курса">Наименование курса</th>
                        <th data-value="type" data-caption="Тип курса">Тип курса</th>
                        <th data-value="author" data-caption="Автор курса">Автор курса</th>
                        <th data-value="count_users" data-caption="Всего записано">Всего записано</th>

                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </table>

                <div id="loader"></div>

                <button class="primaryBtn reportBtn" id="reportBtn">Отчёт PDF</button>

                <a class="ghostBtn" id="addNewBtn">Добавить <?= $page_name ?></a>

                <div class="addDataForm" id="addBlock">
                    <h2>Добавить новый курс</h2>
                    <input class="addElement"
                           data-input="inputCtrl"
                           type="text"
                           name="name"
                           placeholder="Наименование курса"
                    />
                    <h3>Тип курса</h3>
                    <select class="addElement"
                            name="category_id"
                            data-input="inputCtrl"
                            data-select="category"
                            data-placeholder="Выбирите тип курса">
                    </select>

                    <button class="addFormBtn primaryBtn" id="postBtn">Добавить</button>
                    <a class="addFormBtn ghostBtn" id="cancelBtn">Отмена</a>
                </div>

            </div>
        </div>
        <div class="clear"></div>
    </div>

    <script src="src/scripts/myCourse/config.js"></script>
    <script src="src/scripts/config.js"></script>

    <script type="text/javascript" language="javascript">
        config.additionFuelds = {
            author_id: <?= $_SESSION['user']->user['id']; ?>
        };
    </script>

    <script src="src/scripts/common/form.js"></script>
    <script src="src/scripts/common/update.js"></script>
    <script src="src/scripts/common/delete.js"></script>
    <script src="src/scripts/common/render.js"></script>
    <script src="src/scripts/common/search.js"></script>
    <script src="src/scripts/common/report.js"></script>
    <script src="src/scripts/common/post.js"></script>
    <script src="src/scripts/common/fillSelectCtrl.js"></script>
    <script src="src/scripts/common/validate.js"></script>

    <script src="src/scripts/myCourse/gotoSchedule.js"></script>
</body>
</html>