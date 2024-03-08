<?php 
    //     # P 4 - La base de datos no puede estar expuesta al servidor.
    //     # p 5 - Deshabilitar o cambiar el nombre del usuario root y crear un usuario non-root.
    //     # p 6 - Se deben crear diferentes usuarios y perfiles para la bases usuario.
    //     # p 7 - Los accesos o datos sencibles, no pueden ir quemados en el codigo
    //     # p 8 - Para almacenar accesos o datos sencibles de la aplicación se debe usar un secret storage }
    //     #       Ejemplo K8s o Simple storage
    //     # p 9 - Las variables que estan en memoria se deben limpiar apara evitar que caigan en un memory domp

    if(isset($_POST["nombre"]) && isset($_POST["documento"]) && isset($_POST["usuario"]) && isset($_POST["password"]))
{
    $nombre = $_POST["nombre"];
    $documento = $_POST["documento"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    echo "Datos enviados desde el servidor: $nombre - $documento - $usuario - $password";

    $dbuser = "root";
    $dbpassword = "";

    try {
        // Establecer la conexión PDO
        $conn = new PDO("mysql:host=localhost;port=8080;dbname=aereolinea", $dbuser, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL preparada
        $query = "INSERT INTO `usuarios` (`id`, `nombre`, `documento`, `usuario`, `password`) VALUES (NULL, :nombre, :documento, :usuario, :password)";
        $q = $conn->prepare($query);
        $q->bindParam(':nombre', $nombre);
        $q->bindParam(':documento', $documento);
        $q->bindParam(':usuario', $usuario);
        $q->bindParam(':password', $password);
        $result = $q->execute();
        $dbuser = "";
        $dbpassword = "";

        if ($result) {
            echo "<br>Datos insertados correctamente en la base de datos.";
        } else {
            echo "<br>Error al insertar datos en la base de datos.";
        }
    } catch(PDOException $e) {
        echo "<br>Error de conexión: " . $e->getMessage();
    }
}
?>
<h1>Registro de pasajeros</h1>
<hr>
<form action="" method="post">
    Nombre: <input type="text" name="nombre"><br><br>
    Documento <input type="text" name="documento"><br><br>
    Usuario <input type="text" name="usuario"><br><br>
    Password <input type="password" name="password"><br><br>
    <hr>
    <input type="submit" value="Registrame">
</form>