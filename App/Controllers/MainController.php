<?php
namespace App\Controllers;

class MainController  extends Controller
{
    public function page()
    {
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/':
                $namePage = 'home';
                $title = 'Home page';
                break;
            case '/sign-in.php':
                $namePage = 'registration';
                $title = 'User registration';
                break;
            case '/personal.php':
                $namePage = 'personal';
                $title = 'Your personal page';
                break;
            default:
                $namePage = '/404';
                $title = 'Page not found';
        }

        $datas = ['namePage' => $namePage, 'title' => $title];

        return $datas;
    }
}

