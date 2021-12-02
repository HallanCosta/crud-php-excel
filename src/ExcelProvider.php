<?php
require_once('PHPExcel/Classes/PHPExcel.php');

class ExcelProvider {
    private $activeSheet;
    private $totalDatas;
    private $totalAttributes;
    private $alphabet;


    function __construct($filename) {
        $this->activeSheet = $this->Run($filename);
        $this->totalDatas = $this->getTotalDatas();
        $this->totalAttributes = $this->getTotalAttributes();
        $this->alphabet = $this->GenerateAlphabet();
    }

    private function Run($filename) {
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($filename);

        $activeSheet = $objPHPExcel->getActiveSheet(); // Pegar planilha excel

        return $activeSheet;
    }

    public function GenerateAlphabet() { // Responsável em gerar o alfabeto pelo total de atributos
        $i = 0;
        $alphabetArray = [];

        for ($alphabet = 'A'; $i < $this->totalAttributes; $alphabet++){
            $i++;
            $alphabetArray[] = $alphabet;
        }
            
        return $alphabetArray;
    }

    public function SearchUsersInTable() { // Responsável em procurar os dados na tabela
        $rowsDatas = [];

        // Percorre em todas as linhas exemplo: 1, 2, 3, 4
        for ($i = 1; $i <= $this->totalDatas; $i++) {
            $columnsDatas = [];
            
            // Percorre em todas as colunas exemplo: B2, C2, D2, E2
            for ($x = 1; $x < $this->totalAttributes; $x++) {
                $pos = $i + 1;
                $cell = $this->alphabet[$x] . "$pos";
                $columnsDatas[] = $this->activeSheet->getCell($cell)->getValue(); // Pegando os atributos da tabela na primeira linha
            }

            $rowsDatas[] = $columnsDatas;
        }

        return $rowsDatas;
    }

    // Getters
    public function getAttributesNames() {
        $alphabets = $this->GenerateAlphabet();
    
        $attributesNames = [];
        for ($i = 1; $i < $this->getTotalAttributes(); $i++) {
            $attributeName = $this->getActiveSheet()->getCell($alphabets[$i] . "1")->getValue(); // Pegando os atributos da tabela na primeira linha 
            
            $attributeNameLowerCase = strtolower($attributeName);

            $attributesNames[] = $attributeNameLowerCase;
        }

        return $attributesNames;
    }

    public function getActiveSheet() {
        return $this->activeSheet;
    }

    public function getTotalDatas() { // Responsável em pegar tamanho de todos os dados
        $lenght = [];
        $i = 0;

        $rowIterator = $this->activeSheet->getRowIterator();

        $rows = [];
        foreach ($rowIterator as $row) {
            $lenght[] = $i++;
        }   

        return count($lenght) - 1;     
    }

    public function getTotalAttributes() { // Responsável em pegar o total de atributos da tabela
        $lenght = [];
        $i = 0;

        $rowIterator = $this->activeSheet->getRowIterator(1)->current(); // Pegando a primeira linha
        $cellIterator = $rowIterator->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
    
        foreach ($cellIterator as $cell) {
            $lenght[] = $i++;
        }

        return count($lenght);        
    }
}
