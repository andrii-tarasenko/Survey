<?php
session_start();
//print_r($_SESSION); die();

require_once 'config/config.php';

use App\Controllers\Web\MainController;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $mainController = new MainController();
    $page = $mainController->page();

    $mainController->render($page);
} else {
    if (isset($_POST['deleteSession'])) {
        $mainController = new MainController();
        $mainController->deleteSession();
    }
}
