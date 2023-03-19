<?php

namespace App\models;

//require_once MAIN_DIR . 'database.php';

use Illuminate\Database\Eloquent\Model;
use App\models\MyDb;
use Illuminate\Support\Facades\DB;
//use illuminate/support/Facades/Facade;

class User
{
    public static $tableName = 'users';
    public $id;
    public $email;
    public $password;

    public static function createTable($createTable)
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(10) AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            date_add timestamp NULL,
            date_update	timestamp NULL
        )";

        $createTable->createTable($sql, self::$tableName);
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public static function findByEmail($email)
    {
        $createTable = new MyDb();

        if (!$createTable->getTable(self::$tableName)) {
            self::createTable($createTable);
        } else {
            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE email = \'' . $email . '\'';

            if ($createTable->setQuery($sql)) {
                return true;
            }
        }

        return false;
    }

    public function save()
    {
        $newUser = new MyDb();

        return $newUser->addObject($this->email, $this->password, self::$tableName);
    }
}