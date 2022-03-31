<?php 

namespace Database;

class Connection 
{
    private static $instance = null;
    public function __construct()
    {
        if(!self::$instance) {
            self::$instance = new \PDO('sqlite:' . __DIR__ . '/../database.sqlite');
        }
    }
}