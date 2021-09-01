<?php
include_once 'config.php';

$page_name = 'курсы';
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

                    <?php if ($_SESSION['user']->user['role'] == 0): ?>
                        <th>Запись на курс</th>
                    <?php endif; ?>
                </tr>
            </table>

            <div id="loader"></div>

            <button class="primaryBtn reportBtn" id="reportBtn">Отчёт PDF</button>

        </div>
    </div>
    <div class="clear"></div>
</div>

<script src="src/scripts/course/config.js"></script>
<script src="src/scripts/config.js"></script>

<script type="text/javascript" language="javascript">
    config.userId = <?= $_SESSION['user']->user['id'] ?>;

    config.additionFuelds = {
        user_id: <?= $_SESSION['user']->user['id']; ?>
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

<?php if ($_SESSION['user']->user['role'] == 0): ?>
    <script src="src/scripts/course/makeClaim.js"></script>
<?php endif; ?>
</body>
</html>