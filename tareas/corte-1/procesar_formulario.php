<?php
// Recoger datos del formulario
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];

// Mostrar información en un prompt
echo "<script>
  window.alert('Nombre: $usuario\\nClave: $clave\\nFecha de Nacimiento: $fecha_nacimiento\\nGénero: $genero');
  window.location = 'formulario.html'; // Redirigir de vuelta al formulario
</script>";
?>