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

<h1>Registro de Proyectos</h1>
<hr>
<form action="registro_requerimientos.php" method="post">
    Nombre: <input type="text" name="name"><br><br>
    Codigo: <input type="text" name="code_id"><br><br>
    Estado: <input type="text" name="status"><br><br>
    <hr>
    <input type="submit" value="Registrar Proyecto">
</form>