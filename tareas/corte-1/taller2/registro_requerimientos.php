<?php
session_start();

if(!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit;
}

// Verificar si se han enviado datos a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Iterar sobre las variables POST y mostrarlas
    echo "<h2>Datos enviados por el método POST:</h2>";
    foreach ($_POST as $key => $value) {
        echo "$key: $value <br>";
    }
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