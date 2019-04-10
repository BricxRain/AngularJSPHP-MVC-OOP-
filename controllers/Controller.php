<?php

class Controller extends Database {

    public static function create_view($view_page_name) {
        require_once('./views/'.$view_page_name.'.php');
    }

}