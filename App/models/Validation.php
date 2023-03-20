<?php
namespace App\models;

class Validation
{
    /**
     * @param $post
     *
     * @return array
     */
    public static function userCheck($post): array
    {
        $errors = [];
        // Get registration form data

        if (!empty($post['password'])) {
            $password = $post['password'];
            if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
                $errors['password'] = 'Password must contain only letters and digits (upper or lower case).';
            }
            if (strlen($password) < 6) {
                $errors['password'] = 'Password must contain at least 6 characters.';
            }

            if (isset($_POST['confirm_password'])) {
                if ($_POST['confirm_password'] !== $password) {
                    $errors['password'] = 'Passwords must must be equal.';
                }
            }
        } else {
            $errors['password'] = 'Password must contain at least 6 characters.';
        }

        if (isset($post['email'])) {
            if (!empty($post['email'])) {
                $email = $post['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Your email does not match the format.';
                }
            } else {
                $errors['email'] = 'Email cannot be empty.';
            }
        }

        if (isset($post['login'])) {
            if (!empty($post['login'])) {
                if (!filter_var($post['login'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Your email does not match the format.';
                }
            } else {
                $errors['email'] = 'Email cannot be empty.';
            }
        }


        return $errors;
    }
}