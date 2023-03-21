<?php

namespace App\models;

class Survey extends Model
{
    public $id;
    public $user_id;
    public $title;
    public $questions;
    public $countOfVoices;
    public $status;

    public static $tableName = 'surveys';

    public function getTitle()
    {
        return $this->title;
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param $createTable
     * @return void
     */
    public function createTable($createTable)
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . self::$tableName . " (
            id INT(10) AUTO_INCREMENT PRIMARY KEY,
            user_id INT(10) NOT NULL,
            title VARCHAR(255) NOT NULL,
            questions CHAR(255) NOT NULL,
            countOfVoices INT(10) NOT NULL,
            status VARCHAR(11) NOT NULL,
            date_add timestamp NULL,
            date_update	timestamp NULL
        )";

        return $createTable->createTable($sql, self::$tableName);
    }

    /**
     * @param $userId
     *
     * @return bool
     */
    public function getSurveys ($userId = null)
    {
        $sql = "SELECT id, title, questions, countOfVoices, status FROM " . $this->getTableName();

        if ($userId !== null) {
            $sql .= " WHERE user_id = '" . $userId . "'";
        }

        $getObjects = new MyDb();
        return $getObjects->setQuery($sql);
    }

    public static function findByUserID($user_id): bool
    {
        $getSurvey = new MyDb();

        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE user_id = \'' . $user_id . '\'';

        if ($getSurvey->setQuery($sql)) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getColumn()
    {
        return [
            'user_id' => $this->user_id,
            'title' => $this->title,
            'questions' => $this->questions,
            'countOfVoices' => $this->countOfVoices,
            'status' => $this->status,
        ];
    }

    /**
     * @return mixed
     */
    public function getTableName ()
    {
        return self::$tableName;
    }
}