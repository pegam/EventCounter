<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoloader/autoloader.php';

try {
    ob_start();
    $dispatcher = new Core\Controller\Dispatcher\Dispatcher();
    $controller = $dispatcher->dispatch();
    $controller->execAction();
    $response = $controller->createResponse();
    $response->output();
    ob_end_flush();
} catch (Exception $e) {
    header('Content-Type: application/json');
    if ($e->getCode() === 400) {
        require_once MVC_DIR . '/View/Common/Error/Error400.php';
    } else if ($e->getCode() === 404) {
        require_once MVC_DIR . '/View/Common/Error/Error404.php';
    } else {
        require_once MVC_DIR . '/View/Common/Error/Error500.php';
    }
}