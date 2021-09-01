<?php

    namespace PensionFund\Controller;

    use PensionFund\Model\RegistrationModel;

    class RegistrationController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/registration.php';
        }

        public function insert()
        {
            $model = new RegistrationModel();
            return $model->insert($_POST);
        }
    }
