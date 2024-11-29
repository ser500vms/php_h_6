<?php
require_once '../src/Application.php';
require_once '../src/Render.php';
require_once '../src/UserController.php';

try {
    $app = new Application();
    $db = $app->getDb();
    $controller = new UserController($db);

    $action = $_GET['action'] ?? null;
    $params = $_GET;

    if ($action === 'update') {
        echo $controller->updateUser($params);
    } elseif ($action === 'delete') {
        echo $controller->deleteUser($params);
    } else {
        throw new Exception("Неизвестное действие");
    }
} catch (Exception $e) {
    echo Render::renderExceptionPage($e);
}
