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
        if ($_SERVER['SERVER_NAME'] == 'panda.bezgmo.tot') {
            $this->host = "127.0.0.1";
            $this->user = "root";
            $this->password = "andre0991";
            $this->dataBase = "panda";
        } else {
            $this->host = "mysql315.1gb.ua";
            $this->user = "gbua_z_bez7fb16";
            $this->password = "azxM22pm@3Jj";
            $this->dataBase = "gbua_z_bez7fb16";
        }

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
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->dataBase);

        $result = mysqli_query($conn, $query);
        mysqli_close($conn);
        $rows = [];

        if (is_object($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $getParameters[] = $row;
            }
            if  (!empty($getParameters)) {
                return $getParameters;
            }
        } elseif ($result) {
            return true;
        }
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

        $sql = 'INSERT INTO ' . $tableName . ' (' . $col . ') VALUES (' . $val . ')';

        $stmt = $this->db->prepare($sql);

        if ($stmt->execute()) {
            return true;
        } else {
            $response = array('error' => true, 'message' => 'Some trouble in addObject');
            echo json_encode($response);

            exit();
        }

        return false;
    }
}