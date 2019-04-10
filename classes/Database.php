<?php

class Database {

    public static $host = 'localhost';
    public static $database = 'db_information';
    public static $username = 'root';
    public static $password = '';

    public static function connect() {
        
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$database.";charset=utf8", self::$username, self::$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;

    }

    public static function query($query, $params = array()) {

        $data = '';
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        if( explode(' ', strtoupper($query))[0] == 'SELECT' ) {
            $data = array(
                "data" => $statement->fetchAll()
            );
        } else if ( explode(' ', strtoupper($query))[0] == 'INSERT' ) {
            $data = array(
                "data" => "Data has been inserted."
            );
        } else if ( explode(' ', strtoupper($query))[0] == 'UPDATE' ) {
            $data = array(
                "data" => "Data has been updated."
            );
        } else if ( explode(' ', strtoupper($query))[0] == 'DELETE' ) {
            $data = array(
                "data" => "Data has been deleted."
            );
        }
        echo json_encode($data);

    }

}