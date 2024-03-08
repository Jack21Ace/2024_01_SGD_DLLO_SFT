<?php session_start(); ?>

<h1>Registro de usuarios</h1>
<hr>
<form action="registro_usuario.php" method="post">
    Nombre: <input type="text" name="name"><br><br>
    Apellido: <input type="text" name="surname"><br><br>
    Documento <input type="text" name="dni"><br><br>
    Usuario <input type="text" name="email"><br><br>
    Password <input type="password" name="password"><br><br>
    <hr>
    <input type="submit" value="Registrar">
</form>