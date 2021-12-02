<?php
require_once __DIR__ . '/Connection.php';
require_once __DIR__ . '/Table.php';
require_once __DIR__ . '/ExcelProvider.php';


class User {

    private $connection;
    private $commandsSQLInsertArray;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function Save($sql) {
        $db = $this->connection->connect();
        $sth = $db->prepare($sql);
        $sth->execute();
        return true;
    }

    public function Saves($sqls) {
        foreach ($sqls as $sql) {
            $this->Save($sql);
        }
    }

    public function SelectById($id) {
        try {
            $db = $this->connection->connect();
            $sth = $db->prepare("SELECT * FROM usuarios WHERE id = $id"); 
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_OBJ); // Retornar em formato de objeto
            return $result;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function SelectAll() {
        try {
            $db = $this->connection->connect();
            $sth = $db->prepare("SELECT * FROM usuarios"); 
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_OBJ); // Retornar em formato de objeto
            return $result;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function DeleteById($id) {
        try {
            $db = $this->connection->connect();
            $sth = $db->prepare("DELETE FROM `usuarios` WHERE id = $id"); 
            $sth->execute();
            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

    public function UpdateById($id, $postsArray) {
        try {
            $excelProvider = new ExcelProvider($_SESSION['table_name']);
            $attributesNames = $excelProvider->getAttributesNames();

            $commandSQLUpdate = "UPDATE `usuarios` SET "; // Criando os comando sql

            $totalAttributes = count($postsArray);

            for ($i = 0; $i < $totalAttributes; $i++) {
                if ($i == ($totalAttributes - 1)) {
                    $commandSQLUpdate .= "$attributesNames[$i] = '$postsArray[$i]' ";
                } else {
                    $commandSQLUpdate .= "$attributesNames[$i] = '$postsArray[$i]', ";
                }
            }
    
            $commandSQLUpdate .= "WHERE id = $id";

            $db = $this->connection->connect();
            $sth = $db->prepare($commandSQLUpdate); 
            $sth->execute();
            return true;
        } catch (PDOException $error) {
            return false;
        }
    }

}
