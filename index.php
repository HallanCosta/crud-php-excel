<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload PHP</title>
  <link rel="stylesheet" href="index.css" type="text/css">
  <style>
    
  </style>
</head>
<body>
  <div class="container">

    <form class="upload-container" method="post" action="upload.php" enctype="multipart/form-data">
        <input type="file" id="input-upload" value="" name="file" hidden>
        
        <label for="input-upload">
        <span>Upload</span>
        </label>

        <button type="submit">Migrar Tabela</button>
        <span class="file-uploaded-message"><?= isset($_SESSION['table_name']) ? 'ARQUIVO ANEXADO COM SUCESSO!!' : null ?></span>

        <?= isset($_SESSION['table_name']) ? "<a href='list.php' class='button-list'>Listar usuários</a>" : null; ?>
        <?= isset($_SESSION['table_name']) ? "<a href='reset.php' class='button-delete'>Deletar Tabela</a>" : null; ?>
        
    </form>
    
  </div>

</body>
</html>