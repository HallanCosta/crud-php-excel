<?php
    require_once 'src/User.php';

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

    $user = new User();
    $user->DeleteById($id);

    header('Location: list.php');
    exit;