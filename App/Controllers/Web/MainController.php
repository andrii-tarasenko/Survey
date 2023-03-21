<?php
namespace App\Controllers\Web;

use App\models\Survey;

class MainController  extends Controller
{
    public function deleteSession ()
    {
        $response = array('error' => true);

        if ($_POST['deleteSession']) {
            session_destroy();

            $response = array('success' => true);
        }
        echo json_encode($response);

        exit();
    }

    /**
     * @return void
     */
    public function renderBody($namePage)
    {
        $survey = new Survey();
        $survs = $survey->getSurveys();
        $surveys = [];
        $i = 0;
        foreach ($survs as $survey) {
            $i++;
            if ($i > 10) {
                break;
            }
            $surveys[$survey['title']]['questions'][] = ['questions' => $survey['questions'], 'countOfVoices' =>  $survey['countOfVoices']];
            $surveys[$survey['title']]['status'] =  $survey['status'];
        }
        $path = $this->getView($namePage);

        include($path);
    }
}

