<?php

require 'controllers\Controller.php';

class ApiController extends Controller {

    public static function getAllInformation() {

        $query = "SELECT * FROM users ORDER BY id ASC";
        return json_encode( self::query($query) );

    }

    public static function insertUpdate() {

        $data_information = json_decode(file_get_contents("php://input"));
        
            // var_dump($data_information->information->name);

        if ( $data_information->status == "INSERT" ) {

            $paramsArray = array(
                ':name' => $data_information->information->name,
                ':email' => $data_information->information->email,
                ':age' => $data_information->information->age,
                ':password' => "xxx"
            );  

            $query = "INSERT INTO users(name, email, age, password) VALUES(:name, :email, :age, :password)";
            $result = self::query($query, $paramsArray);

            return $result;

        } else {
            
            $paramsArray = array(
                ':name' => $data_information->information->name,
                ':email' => $data_information->information->email,
                ':age' => $data_information->information->age,
                ':id' => $data_information->information->id,
            );

            $query = "UPDATE users SET name = :name, email = :email, age = :age WHERE id = :id";
            $result = self::query($query, $paramsArray);

            return $result;

        }

    }

    public static function deleteInformation() {

        $id = json_decode( file_get_contents("php://input") );
        // var_dump($id);

        $query = "DELETE FROM users WHERE id = :id";
        $result = self::query($query, [ ':id' => $id ]);

        return $result;

    }

} 