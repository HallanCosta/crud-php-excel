<?php 
    session_start();
    
    echo "<pre>";

    require_once 'src/ExcelProvider.php';
    require_once 'src/User.php';

    $excelProvider = new ExcelProvider($_SESSION['table_name']);
    $attributesNames = $excelProvider->getAttributesNames();

    $user = new User();
    $users = $user->SelectAll(); // Buscando todos usuários do banco

    echo "</pre>";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="list.css">
    <title>Listar Usuários</title>
</head>
<body>
    <a class="button-back" style="text-decoration: none;" href="index.php">&larr;</a>

    <h1>Listagem de Usuários</h1>

    <table border="2px">
        <thead>
            <th>#</th>
            <?php foreach ($attributesNames as $attributeName) { ?> <!-- Populando atributos da tabela -->
            
            <th><?= $attributeName; ?></th>

            <?php } ?>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?> <!-- Populando usuários da tabela -->
            <tr>

                <td><?= $user->id; ?></td>
                <?php foreach ($attributesNames as $attributeName) { ?> <!-- Populando valores dos usuários da tabela -->
                    <td><?= $user->$attributeName; ?></td>
                <?php } ?>
                
                <td>
                    <a class="button-edit" href="edit.php?id=<?= $user->id; ?>">Editar</a>
                </td>
                <td>
                    <a class="button-delete" href="delete.php?id=<?= $user->id; ?>">Deletar</a>
                </td>
        
            </tr>
            <?php } ?>
        </tbody>

    </table>
</body>
</html>