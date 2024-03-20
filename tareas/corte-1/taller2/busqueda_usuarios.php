<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de Usuarios</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Color de fondo para filas pares */
        }

        h1 {
            color: #333; /* Color del título */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff; /* Color de fondo de la página */
        }

        input[type="text"], input[type="submit"] {
            padding: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Búsqueda de Usuarios</h1>
    <form action="" method="GET">
        Usuario a buscar:
        <input type="text" name="nombreUsuario">
        <input type="submit" value="Buscar">
    </form>
    <?php 
    if(isset($_GET["nombreUsuario"])) {
        $nombreUsuario = $_GET["nombreUsuario"];
        echo "Búsqueda por: $nombreUsuario";

        // Conexión a la base de datos PostgreSQL
        $dbuser = "jack";
        $dbpass = "asd.1234";
        $dbname = "c-bios";
        $conn = new PDO("pgsql:host=localhost;port=5432;dbname=$dbname", $dbuser, $dbpass);

        // Consulta SQL para buscar usuarios por nombre
        $consultaSQL = $conn->prepare("
            SELECT name, surname, dni, email
            FROM users
            WHERE name LIKE :nombreUsuario OR surname LIKE :nombreUsuario
        ");
        $consultaSQL->bindValue(':nombreUsuario', '%' . $nombreUsuario . '%');
        $consultaSQL->execute();
    ?>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Email</th>
        </tr>
    <?php
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <tr>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["surname"] ?></td>
            <td><?php echo $row["dni"] ?></td>
            <td><?php echo $row["email"] ?></td>
        </tr>
    <?php
        }
    }
    ?>
    </table>
</body>
</html>
