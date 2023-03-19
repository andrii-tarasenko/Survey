<?php
require_once 'config/config.php';

use App\Controllers\PersonalController;
use App\Controllers\MainController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new PersonalController();
    $auth->postProces();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mainController = new MainController();
    $page = $mainController->page();

    $mainController->render($page);
}