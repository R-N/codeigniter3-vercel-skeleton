<?php

if (!function_exists('consoleLog')){
    function consoleLog($obj, $script=TRUE){
        $obj = "console.log(" . json_encode($obj, JSON_PRETTY_PRINT) . ");";
        if ($script){
            $obj = "<script>" . $obj . "</script>";
        }
        echo $obj;
    }
}

if (!function_exists('fixPath')) {
    function fixPath($path){
        if (!isset($_SERVER['DOCUMENT_ROOT']) || ENVIRONMENT !== 'production'){
            return $path;
        }
        return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $path;
    }
}

if (!function_exists('redirect2')){
    function redirectGraceful($target){
        ob_end_clean();
        header('Location: ' . site_url($target));
    }
}
