<?php
include_once 'config.php';

$page_name = 'Личный кабинет';
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

                <table id="mainTable">
                    <tr>
                        <th data-value="firstname" data-caption="Имя">Имя</th>
                        <th data-value="surname" data-caption="Фамилия">Фамилия</th>
                        <th data-value="middlename" data-caption="Отчество">Отчество</th>

                        <th></th>
                    </tr>
                </table>

                <div id="loader"></div>

                <div class="addDataForm" id="addBlock">
                    <h2>Добавить</h2>
                    <input class="addElement"
                           data-input="inputCtrl"
                           type="text"
                           name="firstname"
                           placeholder="Имя"
                    />
                    <input class="addElement"
                           data-input="inputCtrl"
                           type="text"
                           name="surname"
                           placeholder="Фамилия"
                    />
                    <input class="addElement"
                           data-input="inputCtrl"
                           type="text"
                           name="middlename"
                           placeholder="Отчество"
                    />

                    <button class="addFormBtn primaryBtn" id="postBtn">Добавить</button>
                    <a class="addFormBtn ghostBtn" id="cancelBtn">Отмена</a>
                </div>

            </div>
        </div>
        <div class="clear"></div>
    </div>

    <script src="src/scripts/myAccount/config.js"></script>
    <script src="src/scripts/config.js"></script>

    <script type="text/javascript" language="javascript">
        config.letDelete = false;

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
</body>
</html>