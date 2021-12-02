<?php 
    session_start();

    require_once 'src/ExcelProvider.php';
    require_once 'src/GenerateCommand.php';
    require_once 'src/Table.php';
    require_once 'src/User.php';

    $excelProvider = new ExcelProvider($_SESSION['table_name']); // Passando diretório do arquivo para abrir
    $totalDatas = $excelProvider->getTotalDatas(); // Pegando o total de dados (usuários) da tabela
    $rowsDatas = $excelProvider->SearchUsersInTable(); // Procurando usuários na tabela 

    $generateCommand = new GenerateCommand($excelProvider);
    $commandSQLCreateTable = $generateCommand->GenerateCommandCreateTable("usuarios"); // Gerando comando de criar tabela
    $commandSQLCreateAttributes = $generateCommand->GenerateCommandsCreateAttributes(); // Gerando commandos de inserir atributos
    $commandSQLInsertUsers = $generateCommand->GenerateInsertCommands($rowsDatas, $totalDatas); // Gerando commandos de inserir da usuários
    
    $table = new Table();
    $table->CreateTable($commandSQLCreateTable); // Criando a tabela
    $table->CreateAttributes($commandSQLCreateAttributes); // Criando atributos da tabela

    $user = new User();
    $user->Saves($commandSQLInsertUsers); // Salvando todos os usuários no banco de dados

    header('location: index.php');