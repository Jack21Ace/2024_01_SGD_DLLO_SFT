<?php session_start();

// Verificar si se han enviado datos a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Iterar sobre las variables POST y mostrarlas
    echo "<h2>Datos enviados por el método POST:</h2>";
    foreach ($_POST as $key => $value) {
        echo "$key: $value <br>";
    }
}
?>

<h1>Registro de usuarios</h1>
<hr>
<form action="registro_usuario.php" method="post">
    Nombre: <input type="text" name="name"><br><br>
    Apellido: <input type="text" name="surname"><br><br>
    Documento <input type="text" name="dni"><br><br>
    Usuario <input type="text" name="email"><br><br>
    Password <input type="password" name="password_hash"><br><br>
    <hr>
    <input type="submit" value="Registrar">
</form>