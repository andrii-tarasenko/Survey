<?php

namespace App\Controllers;

use App\models\Survey;

class ProfileController extends Controller
{
    public function postProces()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $surveyTitle = $_POST['surveyTitle'];
            unset($_POST['surveyTitle']);

            $setSurveys = [];

            $userID = $this->getUserId ();
            $status = $this->getStatus ();

            foreach ($_POST as $key => $value) {
                $rowVariable = explode('_', $key);
                $val = strip_tags($value);
                if (count($rowVariable) == 1) {
                    $setSurveys[0][$rowVariable[0]] = $val;
                } else {
                    $setSurveys[$rowVariable[1]][$rowVariable[0]] = $val;
                }
            }
            $newSurvey = new Survey();
            $res = false;

            foreach ($setSurveys as $setSurvey) {
                $newSurvey->questions = $setSurvey['question'];
                $newSurvey->title = $surveyTitle;
                $newSurvey->user_id = $userID;
                $newSurvey->countOfVoices = $setSurvey['voice'];
                $newSurvey->status = $status;
                if ($newSurvey->save()) {
                    $res = true;
                }
            }

            if ($res) {
                $response = array('success' => true, 'message' => 'Account successfully created');

            } else {
                $response = array('success' => false, 'message' => 'ghgfhfghfghfg');
            }
            echo json_encode($response);
        }
    }

    /**
     * @return void
     */
    public function renderHeader($page) {
        $title = $page;

        include(TEMPLATES . 'header2.php');
    }

    /**
     * @param $namePage
     *
     * @return void
     *
     * @throws \Exception
     */
    public function renderBody($namePage) {
        $userId = $this->getUserId();
        $survey = new Survey();
        $survs = $survey->getSurveys($userId);
        $surveys = [];
        $title = '';
        foreach ($survs as $survey) {
            $surveys[$survey['title']]['questions'][] = ['questions' => $survey['questions'], 'countOfVoices' =>  $survey['countOfVoices']];
            $surveys[$survey['title']]['status'] =  $survey['status'];

//            $surveys[] = [
//                'id' => $survey['id'],
//                'title' => $survey['title'],
//                'question' => $survey['questions'],
//                'countOfVoices' => $survey['countOfVoices'],
//                'status' => $survey['status']
//            ];
        }


//        echo '<pre>';
//        print_r($surveys);
//        echo '</pre>';
//
//
//        die();



        $path = $this->getView($namePage);

        include($path);
    }

    public function getSurveys () {
        $surveys = Survey::getSurveys();

        return $surveys;
    }

    public function getUserId ()
    {
        return 25;
    }
    public function getStatus ()
    {
        return 'чорновик';
    }

    public function index()
    {
        // Отримуємо список всіх опитувань
        $surveys = Survey::all();

        // Виводимо HTML сторінку з списком опитувань
        $html = '<h1>Список опитувань</h1>';
        foreach ($surveys as $survey) {
            $html .= '<div>';
            $html .= '<h2>' . $survey->title . '</h2>';
            $html .= '<p>' . $survey->description . '</p>';
            $html .= '<a href="/survey/' . $survey->id . '">Детальніше</a>';
            $html .= '</div>';
        }
        echo $html;
    }

    public function create()
    {
        // Виводимо HTML сторінку з формою створення нового опитування
//        $html = '<h1>Створити нове опитування</h1>';
//        $html .= '<form method="post" action="/survey/store">';
//        $html .= '<label for="title">Назва:</label><br>';
//        $html .= '<input type="text" id="title" name="title" required><br>';
//        $html .= '<label for="description">Опис:</label><br>';
//        $html .= '<textarea id="description" name="description" required></textarea><br>';
//        $html .= '<button type="submit">Зберегти</button>';
//        $html .= '</form>';
//        echo $html;
    }

    public function store()
    {
        // Зберігаємо нове опитування в базі даних
        $survey = new Survey();
        $survey->title = $_POST['title'];
        $survey->description = $_POST['description'];
        $survey->save();

        // Перенаправляємо користувача на сторінку зі списком опитувань
        header('Location: /survey');
    }

    public function show($id)
    {
        // Отримуємо дані про опитування за ідентифікатором
        $survey = Survey::find($id);

        // Виводимо HTML сторінку з детальною інформацією про опитування
        $html = '<h1>' . $survey->title . '</h1>';
        $html .= '<p>' . $survey->description . '</p>';
        echo $html;
    }

}