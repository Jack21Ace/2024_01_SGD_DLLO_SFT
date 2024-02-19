<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <h2>Formulario de Registro</h2>

    <form action="procesar_formulario.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="clave">Clave:</label>
        <input type="password" id="clave" name="clave" required><br><br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>
        <label for="genero">Género:</label>
        <select id="genero" name="genero" required>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
            <option value="NB">No binario</option>
        </select><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
