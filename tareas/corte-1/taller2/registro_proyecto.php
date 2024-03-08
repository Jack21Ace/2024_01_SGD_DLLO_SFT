<?php
session_start();

if(!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit;
}
?>

<h1>Registro de Proyectos</h1>
<hr>
<form action="registro_requerimientos.php" method="post">
    name: <input type="text" name="name"><br><br>
    Codigo: <input type="text" name="code"><br><br>
    Estado: <input type="text" name="status"><br><br>
    <hr>
    <input type="submit" value="Registrar Proyecto">
</form>