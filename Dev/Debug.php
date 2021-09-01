<?php

    namespace PensionFund\Dev;

    class Debug
    {
        public static print($variable)
        {
            echo '<pre>';
            print_r($variable);
            echo '</pre>';
        }
    }
