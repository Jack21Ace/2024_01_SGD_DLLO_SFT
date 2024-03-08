<?php
session_start();

if(isset($_POST["name"]) && isset($_POST["dni"]) && isset($_POST["email"]) && isset($_POST["password"]))
{
    $_SESSION['user_data'] = [
        'name' => $_POST["name"],
        'surname' => $_POST["surname"],
        'dni' => $_POST["dni"],
        'email' => $_POST["email"],
        'password' => $_POST["password"]
    ];

    header("Location: registro_institucion.php");
    exit;
}
?>