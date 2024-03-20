<?php
session_start();

if(!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit;
}
?>

<h1>Registro de Requerimientos</h1>
<hr>
<form action="procesar_registro.php" method="post">
    Capacidad Almacenamiento: <input type="text" name="storagecapacity"><br><br>
    CPU: <input type="text" name="cpu"><br><br>
    GPU: <input type="text" name="gpu"><br><br>
    RAM: <input type="text" name="ram"><br><br>
    Tipo VM: <input type="text" name="typevm"><br><br>
    
    <hr>
    <input type="submit" value="Registrar Requerimiento">
</form>