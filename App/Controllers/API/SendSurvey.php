<?php

namespace App\Controllers\API;

use App\Controllers\Web\AuthController;
use App\Controllers\Web\ProfileController;
use App\models\User;
use App\models\Validation;
use SimpleXMLElement;

class SendSurvey
{
    public function sendResponce ()
    {
        header('Content-type: text/xml; charset=utf-8');
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><response></response>');

        if (!empty($_POST['email']) && !empty($_POST['email'])) {
            $errors = Validation::userCheck($_POST);

            if (!empty($errors)) {
                $xml->addChild('status', 'false');
                $xml->addChild('message', 'We waite for email and password');
                echo $xml->asXML();

                exit();
            }

            $email = $_POST['email'];
            $password = $_POST['password'];

            $newSession = new AuthController();
            if ($newSession->login($email, $password)) {
                $newUser = new User();
                $userId = $newUser->findByEmail($email);

                $getSurvey = new ProfileController();
                $data = $getSurvey->renderSurveys($userId['0']['id']);

                $title = array_rand($data);
                $finalSurvey = $data[$title];

                $survey = $xml->addChild('survey');
                $survey->addChild('title', $title);


                $questions = $survey->addChild('all questions');
                foreach ($finalSurvey as $question) {
                    $q = $questions->addChild('question1');
                    $q->addChild('question', $question['question']);
                    $q->addChild('voice', $question['countOfVoices']);
                }
                echo $xml->asXML();

                exit();
            } else {
                $xml->addChild('status', 'false');
                $xml->addChild('message', 'You are email or password is wrong or is not exist');
                echo $xml->asXML();

                exit();
            }
        } else {
            $xml->addChild('status', 'false');
            $xml->addChild('message', 'Your email or password is empty');
            echo $xml->asXML();

            exit();
        }
    }
}