<?php
session_start();
require_once 'config/config.php';

use App\Controllers\MainController;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mainController = new MainController();
    $page = $mainController->page();

    $mainController->render($page);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mainController = new MainController();

    if ($mainController->deleteSession()) {
        header("Location: /");
        exit();
    }
}






