<?php 
    session_start();
    
    require_once 'src/ExcelProvider.php';
    require_once 'src/User.php';

    $excelProvider = new ExcelProvider($_SESSION['table_name']);
    $attributesNames = $excelProvider->getAttributesNames();
    $totalAttributes = $excelProvider->getTotalAttributes();

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $user = new User();
    $userSelected = $user->SelectById($id);

    if (isset($_POST['edit'])) {
        $postsArray = [];
        
        for ($i = 0; $i < ($totalAttributes - 1); $i++) { // Pega todos inputs e passa par aum array
            $postsArray[] = $_POST[$attributesNames[$i]];
        }

        $user->UpdateById($id, $postsArray);

        header('Location: list.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>Editar Usuário</title>
</head>
<body>

    <form method="POST">

        <h1>Atualizar Usuário</h1>

        <div class="container">
            <div class="content">
                <?php foreach($attributesNames as $attributeName) { ?>
                    <div class="input-box">
                        <label for="<?= $attributeName ?>"><?= $attributeName ?></label>
                        <input type="text" value="<?= $userSelected->$attributeName; ?>" name="<?= $attributeName; ?>" id="<?= $attributeName; ?>">
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="buttons">
            <button class="button-edit" type="submit">Atualizar</button>
            <input type="text" value="<?= $id; ?>" name="id" hidden>
            <input type="text" value="true" name="edit" hidden>
            <a class="button-back" href="list.php">Voltar</a>
        </div>
    </form>
    
</body>
</html>