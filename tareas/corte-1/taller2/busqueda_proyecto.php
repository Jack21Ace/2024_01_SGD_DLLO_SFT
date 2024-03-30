<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de Proyectos</title>
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
    <h1>Búsqueda de Proyectos</h1>
    <form action="" method="GET">
        Proyecto a buscar:
        <input type="text" name="nombreProyecto">
        <input type="submit" value="Buscar">
    </form>
    <?php 

    if(isset($_GET["nombreProyecto"])) {
        // filter_var en PHP es una función versátil utilizada para validar y sanitizar variables
        // FILTER_SANITIZE_STRING es un filtro de validación de entrada integrado en PHP. Se utiliza para eliminar o codificar caracteres especiales de una cadena de texto.
        $nombreProyecto = filter_var($_GET["nombreProyecto"], FILTER_SANITIZE_STRING);
        echo "Búsqueda por: $nombreProyecto";

        // Conexión a la base de datos PostgreSQL
        $dbuser = "jack";
        $dbpass = "asd.1234";
        $dbname = "c-bios";

        // PDO: Esta clase proporciona una interfaz segura para la conexión y ejecución de consultas en bases de datos.
        $conn = new PDO("pgsql:host=localhost;port=5432;dbname=$dbname", $dbuser, $dbpass);

        // Consulta SQL para buscar proyectos por nombre
        // prepare() para preparar la consulta SQL antes de ejecutarla. Esto permite separar la lógica de la consulta de los valores que se le pasan.
        $consultaSQL = $conn->prepare("SELECT name, code_id, status FROM projects WHERE name LIKE :nombreProyecto");
        // bindValue() para vincular los valores de las variables a los parámetros de la consulta. Esto evita que los valores se interpreten como código SQL.
        $consultaSQL->bindValue(':nombreProyecto', '%' . $nombreProyecto . '%');
        $consultaSQL->execute();
    ?>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Código</th>
            <th>Estado</th>
        </tr>
    <?php
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <tr>
<!-- htmlspecialchars(): Convierte caracteres especiales como '<', '>' y '&' en entidades HTML para evitar que se interpreten como código JavaScript. -->
            <td><?php echo htmlspecialchars($row["name"]) ?></td>
            <td><?php echo htmlspecialchars($row["code_id"]) ?></td>
            <td><?php echo htmlspecialchars($row["status"]) ?></td>
        </tr>
    <?php
        }
    }
    ?>
    </table>
</body>
</html>
