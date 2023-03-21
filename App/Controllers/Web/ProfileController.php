<?php

namespace App\Controllers\Web;

use App\models\Survey;

class ProfileController extends Controller
{
    public function postProces()
    {
        if (isset($_POST['deleteSurvey'])) {
            $this->removeSurveys($_POST['deleteSurvey']['title']);
        } else {
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
                $response = array('success' => true, 'message' => 'Survey successfully created');

            } else {
                $response = array('success' => false, 'message' => 'Some trouble survey was not created');
            }
            echo json_encode($response);
        }
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
        if (!empty($survs)) {
            foreach ($survs as $survey) {
                $surveys[$survey['title']]['questions'][] = ['questions' => $survey['questions'], 'countOfVoices' =>  $survey['countOfVoices']];
                $surveys[$survey['title']]['status'] =  $survey['status'];
            }
        }
        $path = $this->getView($namePage);

        include($path);
    }

    public function removeSurveys ($title)
    {
        $userId = $this->getUserId();

        $removeSurvey = new Survey();
        if ($removeSurvey->removeSurveys($userId, $title)) {
            $response = array('success' => true);
        } else {
            $response = array('error' => true, 'message' => 'Surveys was not deleted');
        }
        echo json_encode($response);

        exit();
    }

    public function getUserId ()
    {
        return $_SESSION['user_id'];
    }
    public function getStatus ()
    {
        return 'чeрнетка';
    }
}