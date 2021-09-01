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

    $isDelete = (new $model())->delete($data);

    if ($isDelete === true) {
        echo 'Ok';
    } else if ($isDelete === false) {
        echo 'Error';
    } else if ($isDelete === -1) {
        echo $data->errorMessage;
    }
