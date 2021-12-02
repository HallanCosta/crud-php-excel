<?php
// create function upload file excel
session_start();
var_dump($_FILES);
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Pegando a extensão do arquivo
$fileName = time() . '.' . $extension; // Criando um novo nome para o arquivo
$uploadFolder = 'uploads/' . $fileName; //diretório de upload do arquivo

// upload file to uploadFolder
move_uploaded_file($_FILES['file']['tmp_name'], $uploadFolder); // fazendo upload do arquivo;
$_SESSION['table_name'] = "uploads/" . $fileName; // criando uma sessão com o diretório da tabela excel
echo 'Success';

header('location: create.php'); // Mandando para area de criação da tabela