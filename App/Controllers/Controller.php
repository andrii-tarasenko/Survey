<?php

namespace App\Controllers;

class Controller
{
    /**
     * @param $body
     * @return string
     * @throws \Exception
     */
    private function getView($body)
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
    private function renderHeader($page) {
        $title = $page;

        include(TEMPLATES . 'header.php');
    }

    /**
     * @return void
     */
    private function renderBody($namePage) {
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