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
        $objects = false;

        if  (!empty($getParameters)) {
            $objects = $getParameters;
        }

        return $objects;
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

    public function addObject ($objectData, $tableName)
    {
        $count = count($objectData);

        $i = 1;

        $col = '';
        $val = '';

        foreach ($objectData as $column => $value) {
            if ($i < $count) {
                $col .= $column . ', ';
                $val .= '\'' . $value . '\', ';
            } else {
                $col .= $column;
                $val .= '\'' . $value . '\'';
            }
            $i++;
        }

        $sql = "INSERT INTO " . $tableName . " (" . $col . ") VALUES (" . $val . ")";

        $stmt = $this->db->prepare($sql);

        if ($stmt->execute()) {
            return true;
        } else {
            echo '<pre>';
            print_r($sql);
            echo '</pre>';

            echo '<pre>';
            print_r($stmt->execute());
            echo '</pre>';

            die();
        }

        return false;
    }
}