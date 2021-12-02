<?php
require_once __DIR__ . '/Database.php';

class Connection {
  public static function connect() {
    $db = new Database('mysql:host=localhost;dbname=fatec_eletiva_script', 'root', '');
    return $db;
  }
}