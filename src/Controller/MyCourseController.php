<?php

    namespace PensionFund\Controller;

    class MyCourseController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/myCourse.php';
        }
    }