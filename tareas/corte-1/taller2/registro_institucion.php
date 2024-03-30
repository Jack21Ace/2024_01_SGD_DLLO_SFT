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

<h1>Registro de Instituciones</h1>
<hr>
<form action="registro_proyecto.php" method="post">
    Nombre: <input type="text" name="name"><br><br>
    Nit: <input type="text" name="nit"><br><br>
    Rep: <input type="text" name="rep"><br><br>
    Razon Social <input type="text" name="tradename"><br><br>
    <hr>
    <input type="submit" value="Registrar Institución">
</form>