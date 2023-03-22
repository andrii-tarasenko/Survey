<?php

namespace App\Controllers\Web;

class Controller
{
    public function page()
    {
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/':
                $namePage = 'home';
                $title = 'Home page';
                break;
            case '/index.php':
                header("Location: /");
                exit();
            case '/sign-in.php':
                $namePage = 'registration';
                $title = 'User registration';
                break;
            case '/profile.php':
                if ($_SESSION['authenticated']) {
                    $namePage = 'profile';
                    $title = 'Your personal profile';
                } else {
                    header("Location: /");
                    exit();
                }
                break;
            case '/login.php':
                $namePage = 'login';
                $title = 'Login form';
                break;
            default:
                $namePage = '/404';
                $title = 'Page not found';
        }

        $datas = ['namePage' => $namePage, 'title' => $title];

        return $datas;
    }

    /**
     * @param $body
     * @return string
     * @throws \Exception
     */
    public function getView($body)
    {
        $path = TEMPLATES . $body . '.php';

        if (!file_exists($path)) {
            throw new \Exception('View not found');
        }

        return $path;
    }

    /**
     * @return void
     */
    public function render($page) {

        $this->renderHeader($page['title']);
        $this->renderBody($page['namePage']);
        $this->renderFooter();
    }

    /**
     * @return void
     */
    public function renderHeader($page) {
        $title = $page;

        include(TEMPLATES . 'header.php');
    }

    /**
     * @return void
     */
    public function renderBody($namePage) {
        $user = false;
        $path = $this->getView($namePage);

        include($path);
    }

    /**
     * @return void
     */
    private function renderFooter() {
        include(TEMPLATES . 'footer.php');
    }
}