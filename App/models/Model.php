<?php

namespace App\models;

use App\models\MyDb;

class Model
{
    public static $tableName;

    /**
     * @return array
     */
    public function getColumn()
    {
    }

    /**
     * @return mixed
     */
    public function getTableName ()
    {
    }

    /**
     * @param $createTable
     * @return void
     */
    public function createTable($createTable)
    {
    }

    /**
     * @return bool
     */
    public function save()
    {
        $newModel = new MyDb();

        if (!$newModel->getTable($this->getTableName())) {
            $this->createTable($newModel);
        }
        $objectData = $this->getColumn();

        return $newModel->addObject($objectData, $this->getTableName());
    }
}