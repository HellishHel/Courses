<?php

    namespace PensionFund\Controller;

    class MyAccountController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/myAccount.php';
        }
    }