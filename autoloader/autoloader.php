<?php

define('MVC_DIR', __DIR__ . '/../src/mvc');
define('LIB_DIR', __DIR__ . '/../src/lib');
spl_autoload_register(
    function($className) {
        if (!class_exists($className)) {
            $pathPart = str_replace('\\', '/', $className) . '.php';
            $path = LIB_DIR . '/' . $pathPart;
            if (file_exists($path)) {
                include $path;
            } else {
                $path = MVC_DIR . '/' . $pathPart;
                if (file_exists($path)) {
                    include $path;
                }
            }
        }
    }
);