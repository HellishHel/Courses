<?php

    namespace PensionFund\Controller;

    class ScheduleController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/schedule.php';
        }
    }