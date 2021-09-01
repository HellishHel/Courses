<?php

    namespace PensionFund\Controller;

    class CategoryController implements IController
    {
        public function execute()
        {
            include_once __DIR__ . '/../views/category.php';
        }
    }