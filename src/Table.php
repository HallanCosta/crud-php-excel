<?php 

require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/User.php';

class Table {
    private $connection;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function CreateAttribute($sql) {
        $db = $this->connection->connect();
        $sth = $db->prepare($sql);
        $sth->execute();
        return true;
    }
    
    public function CreateAttributes($sqls) {
        foreach ($sqls as $sql) {
          $this->CreateAttribute($sql);
        }
    }
    
    public function CreateTable($sql) {
        $db = $this->connection->connect();
        $sth = $db->prepare($sql);
        $sth->execute();
        return true;
    }

    public function DropTable($sql) {
        $db = $this->connection->connect();
        $sth = $db->prepare($sql);
        $sth->execute();
        return true;
    }
}