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
            if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])
                || isset($_POST['login']) && isset($_POST['password'])) {

                $errors = Validation::userCheck($_POST);
                if (empty($errors)) {
                    $password = trim($_POST['password']);
                    if (isset($_POST['login'])) {
                        $email = trim($_POST['login']);
                        if ($this->login($email, $password)) {
                            $response = array('success' => true, 'message' => 'You are successfully log in');
                        }
                    } else {
                        $email = trim($_POST['email']);
                        if ($this->registration($email, $password)) {
                            $response = array('success' => true, 'message' => 'Account successfully created');
                        } else {
                            $response = array('success' => false, 'error' => true, 'message' => 'Account already exists');
                        }
                    }
                } else {
                    $response = array('success' => false, 'message' => $errors);
                }
                echo json_encode($response);
            }
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
        $newUser = new User();
        $user = $newUser->findByEmail($email);

        if (!$user) {
            $newUser->email = $email;
            $newUser->password = md5($password);
            if ($newUser->save()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return void
     */
    public function login($email, $password)
    {
        $getUser = new User();
        $user = $getUser->findByEmail($email);

        if ($user) {
            $passwordFromDb = $user['0']['password'];
            if (md5($password) == $passwordFromDb) {
                session_start();
                $_SESSION['authenticated'] = true;
                $_SESSION['user_id'] = $user['0']['id'];

                return true;
            } else {
                $response = array('success' => false, 'error' => true, 'message' => 'Wrong password');
            }
        } else {
            $response = array('success' => false, 'error' => true, 'message' => 'This email is not exist.');
        }
        echo json_encode($response);
    }
}