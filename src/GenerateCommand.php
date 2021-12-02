<?php
    require_once 'ExcelProvider.php';

    class GenerateCommand {
        private $excelProvider;
        // private $commandSQLAlterArray = [];

        function __construct($excelProvider) {
            $this->excelProvider = $excelProvider;
        }

        public function GenerateCommandCreateTable($tableName) {
            $commandSQLCreateTable = "CREATE TABLE $tableName (id int AUTO_INCREMENT, PRIMARY KEY(id))";

            return $commandSQLCreateTable;
        }

        public function GenerateCommandDropTable($tableName) {
            $commandSQLDropTable = "DROP TABLE $tableName";

            return $commandSQLDropTable;
        }

        public function GenerateCommandsCreateAttributes() {
            $alphabets = $this->excelProvider->GenerateAlphabet();
    
            $commandSQLAlterArray = [];
            for ($i = 1; $i < $this->excelProvider->getTotalAttributes(); $i++) {
                $tableAttribute = $this->excelProvider->getActiveSheet()->getCell($alphabets[$i] . "1")->getValue(); // Pegando os atributos da tabela na primeira linha 
                $attributeLowerCase = strtolower($tableAttribute);
                
                $commandSQLAlter = "ALTER TABLE usuarios ADD COLUMN $attributeLowerCase VARCHAR(255) NOT NULL"; // Criando os comando sql
                
                $commandSQLAlterArray[] = $commandSQLAlter;
            }
    
            return $commandSQLAlterArray;
        }
        
        public function GenerateInsertCommands($rowsDatas, $totalDatas) { // Responsável em gerar os comandos para inserir na tabela
            $commandSQLInsertArray = [];
    
            for ($i = 0; $i < $totalDatas; $i++) {
                $commandSQLInsert = "INSERT INTO usuarios VALUES (NULL, "; // Criando os comando sql
    
                $commandSQLInsert .= '"' . implode($rowsDatas[$i], '", "') . '"';
    
                $commandSQLInsertArray[] = $commandSQLInsert . ")";
            }
                   
            return $commandSQLInsertArray;
        }

       
    }