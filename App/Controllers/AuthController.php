<?php

namespace App\Controllers;

use App\models\User;
use App\models\Validation;

class AuthController extends Controller
{
    /**
     * @return void
     */
    public function postProces()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = Validation::check($_POST);
            if (empty($errors)) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if ($this->registration($email, $password)) {
                    $response = array('success' => true, 'message' => 'Account successfully created');
                } else {
                    $response = array('success' => false, 'error' => true, 'message' => 'Account already exists');
                }
            } else {
                $response = array('success' => false, 'message' => $errors);
            }
            echo json_encode($response);
        }
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function registration($email, $password)
    {
            $user = User::findByEmail($email);
            if (!$user) {
                $user = new User();
                $user->email = $email;
                $user->password = password_hash($password, PASSWORD_DEFAULT);
                if ($user->save()) {
                    return true;
                }
            }

        return false;
    }


//    /**
//     * @return void
//     */
//    public function login()
//    {
//        // перевірка методу запиту
//        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//            http_response_code(405);
//            echo "Method Not Allowed";
//            exit();
//        }
//
//        // перевірка переданих даних
//        if (!isset($_POST['email']) || !isset($_POST['password'])) {
//            http_response_code(400);
//            echo "Bad Request";
//            exit();
//        }
//
//        $email = $_POST['email'];
//        $password = $_POST['password'];
//
//        // перевірка валідності даних
//        if (empty(trim($email)) || empty(trim($password))) {
//            http_response_code(422);
//            echo "Unprocessable Entity";
//            exit();
//        }
//
//        // перевірка наявності користувача в БД
//        $user = User::where('email', $email)->first();
//
//        if (!$user || !password_verify($password, $user->password)) {
//            http_response_code(401);
//            echo "Unauthorized";
//            exit();
//        }
//
//        // створення сесії та редірект на домашню сторінку
//        $_SESSION['user_id'] = $user->id;
//        header("Location: /");
//        exit();
//    }
}