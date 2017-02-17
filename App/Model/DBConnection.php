<?php

require_once __DIR__ . '/../Core/config.php';

class DBConnection
{
    public function connect()
    {
        $con = null;

        try {
            $con = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE . ';charset=utf8', DB_USER,
                DB_PASSWORD);
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        return $con;
    }

}
