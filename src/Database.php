<?php

class Database extends PDO {
  public function __construct($dns, $username, $password) {
    parent::__construct($dns, $username, $password);
  }

  public function __destruct() {
    foreach ($this as $property) {
      unset($this->$property);
    }
  }

}