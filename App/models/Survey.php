<?php

namespace App\models;

class Survey
{
    private $id;
    private $title;
    private $description;

    public function __construct($id, $title, $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getQuestions()
    {
        // Здесь должен быть код для получения списка вопросов
    }
}