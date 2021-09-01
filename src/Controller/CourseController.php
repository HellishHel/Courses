<?php

    namespace PensionFund\Controller;

    class CourseController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/course.php';
        }
    }