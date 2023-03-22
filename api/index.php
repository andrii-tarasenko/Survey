<?php
require_once '../vendor/autoload.php';

use App\Controllers\API\SendSurvey;

if (isset($_POST)) {
    $sendSurvey = new SendSurvey();
    $sendSurvey->sendResponce($_POST);
}
