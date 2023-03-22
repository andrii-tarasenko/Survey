<?php
require_once 'config/config.php';

use App\Controllers\Web\AuthController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $auth->postProces();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mainController = new AuthController();
    $page = $mainController->page();

    $mainController->render($page);
}