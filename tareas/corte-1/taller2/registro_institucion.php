<?php
session_start();

if(!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit;
}
?>

<h1>Registro de Instituciones</h1>
<hr>
<form action="registro_proyecto.php" method="post">
    Nombre: <input type="text" name="name"><br><br>
    RUT: <input type="text" name="rut"><br><br>
    Rep: <input type="text" name="rep"><br><br>
    Razon Social <input type="text" name="tradename"><br><br>
    <hr>
    <input type="submit" value="Registrar Institución">
</form>