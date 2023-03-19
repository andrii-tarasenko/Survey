<?php

namespace App\models;

use PDO;

class MyDb
{
    /** Parameters for Db conection */
    private $host;
    private $user;
    private $password;
    public $dataBase;
    private $db;

    public function __construct()
    {
        $this->host = "127.0.0.1";
        $this->user = "root";
        $this->password = "andre0991";
        $this->dataBase = "panda";

        $dBConfig = [
            'dsn' => 'mysql:host=' . $this->host . ';dbname=' . $this->dataBase,
            'username' => $this->user,
            'password' => $this->password
        ];

        $this->db = new PDO($dBConfig['dsn'], $dBConfig['username'], $dBConfig['password']);
    }

    /**
     * @param $query
     *
     * @return bool
     */
    public function setQuery ($query)
    {
        $getParameters = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);

//        var_dump($getParameters);

        foreach ($getParameters as $param) {
//            echo '<pre>';
//            print_r($param);
//            echo '</pre>';

        }

        return $getParameters;
    }

    public function createTable ($query, $tableName)
    {
        $this->db->query($query)->execute();

        if ($this->getTable($tableName)) {
            return true;
        }

        return false;
    }

    public function getTable ($tableName)
    {
        $sql = 'SELECT EXISTS (
                    SELECT 1
                    FROM information_schema.tables
                    WHERE table_schema = \'' . $this->dataBase . '\'
                        AND table_name = \'' . $tableName . '\')';

        return $this->db->query($sql)->fetchColumn();
    }

    public function addObject ($column1, $column2, $tableName)
    {
        $date = date("Y-m-d H:i:s");

        $stmt = $this->db->prepare("INSERT INTO " . $tableName . " (email, password, date_add) VALUES (:column1, :column2, :add_date)");
        $stmt->bindParam(':column1', $column1);
        $stmt->bindParam(':column2', $column2);
        $stmt->bindParam(':add_date', $date);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}