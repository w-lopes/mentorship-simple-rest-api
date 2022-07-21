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

    public function insert(string $table, array $data): bool
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

    public function select(string $table, array $fields = [], array $where = []): mixed
    {
        $selectedFields = empty($fields) ? "*" : implode(", ", $fields);
        $selectedWhere  = implode(" and ", array_map(function ($field) {
            return "{$field}=:{$field}";
        }, array_keys($where)));
        $query = "select {$selectedFields} from {$table} where {$selectedWhere}";
        $stmt = self::$instance->prepare($query);
        $stmt->execute($where);

        return $stmt->fetch();
    }

    // fazer o selectAll
}