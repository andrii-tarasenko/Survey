<?php

namespace App\models;

use App\models\MyDb;


class User  extends Model
{
    public static $tableName = 'users';
    public $id;
    public $email;
    public $password;

    public function createTable($createTable)
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . self::$tableName . "  (
            id INT(10) AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            date_add timestamp NULL,
            date_update	timestamp NULL
        )";

        return $createTable->createTable($sql, self::$tableName);
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function findByEmail($email)
    {
        $createTable = new MyDb();

        if (!$createTable->getTable(self::$tableName)) {
            $this->createTable($createTable);
        } else {
            $sql = 'SELECT id, email, password FROM ' . self::$tableName . ' WHERE email = \'' . $email . '\'';

            if (!empty($createTable->setQuery($sql))) {
                return $createTable->setQuery($sql);
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getColumn()
    {
        return ['email' => $this->email, 'password' => $this->password];
    }

    /**
     * @return mixed
     */
    public function getTableName ()
    {
        return self::$tableName;
    }

//    public function save()
//    {
//        $newUser = new MyDb();
//        $user = ['email' => $this->email, 'password' => $this->password];
//
//        return $newUser->addObject($user, self::$tableName);
//    }
}