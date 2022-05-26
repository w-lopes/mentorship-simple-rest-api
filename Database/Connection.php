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

    public function insert(string $table, array $data)
    {
        $dataKeys = array_keys($data);
        $fields = implode(", ", $dataKeys);
        $values = implode(", ", array_map(function($key) {
            return ":{$key}";
        }, $dataKeys));
        $query = "insert into {$table} ({$fields}) values ({$values})";
        $stmt = self::$instance->prepare($query);

        return $stmt->execute($data);
    }
}