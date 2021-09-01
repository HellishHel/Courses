<?php

    namespace PensionFund\Controller;

    class UserController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/user.php';
        }
    }