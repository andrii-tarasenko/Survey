<?php

namespace App\Services;

class Session
{
    public static function setSesion ($userId)
    {
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION['user_id'] = $userId;
    }
}