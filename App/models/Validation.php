<?php
namespace App\models;

class Validation
{
    public static function check($post)
    {
        $errors = [];
        // Get registration form data
        $email = $post['email'];
        $password = $post['password'];

        if (empty($password)) {
            $errors['password'] = 'Password must contain at least 6 characters.';
        }

        if (empty($email)) {
            $errors['email'] = 'Email cannot be empty.';
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
            $errors['password'] = 'Password must contain only letters and digits (upper or lower case).';
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Your email does not match the format.';
        }

        if (strlen($password) < 6) {
            $errors['password'] = 'Password must contain at least 6 characters.';
        }

        return $errors;
    }

    public function postProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = Validation::check($_POST);
            if (empty($errors)) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if ($this->register($email, $password)) {
                    $response = array('success' => true, 'message' => 'Account successfully created');
                    http_response_code(201);
                } else {
                    $response = array('success' => false, 'message' => 'Account already exists');
                    http_response_code(409);
                }
            } else {
                $response = array('success' => false, 'message' => $errors);
                http_response_code(422);
            }
            echo json_encode($response);
        }
    }
}