<?php

namespace app\Classes;

use app\DB\DB;

class AutoManufacturer
{

    private $databaseConnection;

    /**
     * Make constructor.
     * setting the DB connection object and other dependencies.
     */
    public function __construct()
    {
        $this->databaseConnection = (new DB())->getmyDB();
    }

    /**
     * Get Data for the Manufacturers.
     *
     * @return array
     * @author Mufaddal.n
     */
    public function getData()
    {
        $stmt = $this->databaseConnection->prepare("SELECT id, name FROM manufacturer order by created_at DESC");
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $res = $stmt->fetchAll();

        return $res;
    }

    /***
     * Create a new Manufacturer.
     *
     * @param $name
     * @return bool
     * @author Mufaddal.n
     */
    public function create($name)
    {
        $stmt = $this->databaseConnection->prepare("INSERT INTO manufacturer(name) VALUES(:name)");

        $stmt->execute(["name" => $name]);

        if ($this->databaseConnection->lastInsertId()) {
            return header('Location: /dashboard?manufacturer=true');
            die;
        } else {
            return false;
        }
    }
}
