<?php
    session_start();

    require_once 'src/ExcelProvider.php';
    require_once 'src/GenerateCommand.php';
    require_once 'src/Table.php';

    $excelProvider = new ExcelProvider($_SESSION['table_name']); // Abrindo arquivo excel

    $generateCommand = new GenerateCommand($excelProvider);
    $commandSQLDropTable = $generateCommand->GenerateCommandDropTable("usuarios"); // Criando codígo para deletar a tabela
    
    $table = new Table();
    $table->DropTable($commandSQLDropTable); // Deletando a tabela

    unlink($_SESSION['table_name']); // deletando arquivo.xlss

    session_destroy(); // destruindo a sessão

    header('Location: index.php'); // mandando para tela inicial
?>