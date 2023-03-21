<?php
session_start();
require_once 'config/config.php';

use App\Controllers\Web\ProfileController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new ProfileController();
    $auth->postProces();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mainController = new ProfileController();
    $page = $mainController->page();

    $mainController->render($page);
}