<?php
    if(isset($_POST["name"]) && isset($_POST["dni"]) && isset($_POST["email"]) && isset($_POST["password"]))
    {
        $name = $_POST["name"];
        $dni = $_POST["dni"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        echo "Datos enviados desde el servidor: $name - $dni - $email - $password";
    
        $dbuser = "root";
        $dbpassword = "";
    
        try {
            // Establecer la conexión PDO
            $conn = new PDO("mysql:host=localhost;port=8080;dbname=c-bios", $dbuser, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Consulta SQL preparada
            $query = "INSERT INTO `users` (`id`, `name`, `dni`, `email`, `password`) VALUES (NULL, :name, :dni, :email, :password)";
            $q = $conn->prepare($query);
            $q->bindParam(':name', $name);
            $q->bindParam(':dni', $dni);
            $q->bindParam(':email', $email);
            $q->bindParam(':password', $password);
            $result = $q->execute();
    
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

<h1>Registro de usuarios</h1>
<hr>
<form action="" method="post">
    Nombre: <input type="text" name="name"><br><br>
    Apellido: <input type="text" name="surname"><br><br>
    Documento <input type="text" name="dni"><br><br>
    Usuario <input type="text" name="email"><br><br>
    Password <input type="password" name="password"><br><br>
    <hr>
    <input type="submit" value="Registrar">
</form>
<h1 id="registro-institucion" style="display: none;">Registro de Instituciones</h1>
<hr>
<form id="form-institucion" action="" method="post" style="display: none;">
    Nombre: <input type="text" name="name"><br><br>
    NIT: <input type="text" name="nit"><br><br>
    Rep: <input type="text" name="rep"><br><br>
    Razon Social <input type="password" name="tradename"><br><br>
    <hr>
    <input type="submit" value="Registrar Institución">
</form>
<hr>
<h1 id="registro-proyecto" style="display: none;">Registro de Proyectos</h1>
<hr>
<form id="form-proyecto" action="" method="post" style="display: none;">
    Nombre: <input type="text" name="name"><br><br>
    Codigo: <input type="text" name="code"><br><br>
    Estado: <input type="text" name="status"><br><br>
    <hr>
    <input type="submit" value="Registrar Proyecto">
</form>

<script>
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('registro-institucion').style.display = 'block';
    });

    document.getElementById('form-institucion').addEventListener('submit', function() {
        document.getElementById('registro-proyecto').style.display = 'block';
    });
</script>