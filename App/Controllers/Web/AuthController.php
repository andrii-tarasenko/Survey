<?php

namespace App\Controllers\Web;

use App\models\User;
use App\models\Validation;
use App\Services\Session;

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
                        } else {
                            $response = array('error' => true, 'message' => 'You are email or password is wrong or is not exist');
                        }
                        echo json_encode($response);
                        exit();
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
                $userId = $newUser->findByEmail($email);
                Session::setSesion($userId['0']['id']);

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
                Session::setSesion($user['0']['id']);

                return true;
            }
        }

        return false;
    }
}