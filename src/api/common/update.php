<?php

    namespace PensionFund;

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $methodName = ucfirst($data->methodName);
    $model = '\PensionFund\Model\\' . $methodName . 'Model';

    require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model/' . $methodName . 'Model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

    if ($data && $data->additionMethods) {
        foreach ($data->additionMethods as $addMethod) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model/' . $addMethod . 'Model.php';
        }
    }

    if ((new $model())->update($data)) {
        echo 'Ok';
    } else {
        echo 'Error';
    }
