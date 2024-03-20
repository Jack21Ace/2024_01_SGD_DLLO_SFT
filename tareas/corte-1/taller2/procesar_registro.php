<?php
session_start();

if(!isset($_SESSION['user_data'])) {
    header("Location: index.php");
    exit;
}

// Conectarse a la base de datos
$dbuser = "jack";
$dbpass = "asd.1234";
$dbname = "c-bios";
$conn = new PDO("pgsql:host=localhost;port=5432;dbname=$dbname", $dbuser, $dbpass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Comenzar transacción
    $conn->beginTransaction();

    // Consulta de inserción para el usuario
    $query_usuario = "INSERT INTO users (name, surname, dni, email, password_hash) 
                      VALUES (:name, :surname, :dni, :email, :password_hash)";
    $q_usuario = $conn->prepare($query_usuario);
    $q_usuario->bindParam(':name', $_SESSION['user_data']['name']);
    $q_usuario->bindParam(':surname', $_SESSION['user_data']['surname']);
    $q_usuario->bindParam(':dni', $_SESSION['user_data']['dni']);
    $q_usuario->bindParam(':email', $_SESSION['user_data']['email']);
    $q_usuario->bindParam(':password_hash', $_SESSION['user_data']['password_hash']);
    $q_usuario->execute();
    // Obtener el ID del usuario recién insertado
    $usuario_id = $conn->lastInsertId();

    // Consulta de inserción para la institución
    $query_institucion = "INSERT INTO institutions (name, nit, rep, tradename)
                            VALUES (:name, :nit, :rep, :tradename)";
    $q_institucion = $conn->prepare($query_institucion);
    $q_institucion->bindParam(':name', $_POST['name']);
    $q_institucion->bindParam(':nit', $_POST['nit']);
    $q_institucion->bindParam(':rep', $_POST['rep']);
    $q_institucion->bindParam(':tradename', $_POST['tradename']);
    $q_institucion->execute();

    // Obtener el ID de la institución recién insertada
    $institucion_id = $conn->lastInsertId();

    // Consulta de inserción para el proyecto
    $query_proyecto = "INSERT INTO projects (name, code_id, status) 
                       VALUES (:name, :code_id, :status)";
    $q_proyecto = $conn->prepare($query_proyecto);
    $q_proyecto->bindParam(':name', $_POST['name']);
    $q_proyecto->bindParam(':code_id', $_POST['code_id']);
    $q_proyecto->bindParam(':status', $_POST['status']);
    $q_proyecto->execute();

    // Obtener el ID del proyecto recién insertado
    $proyecto_id = $conn->lastInsertId();

    // Consulta de inserción para los requisitos
    $query_requerimientos = "INSERT INTO requirements (storagecapacity, cpu, gpu, ram, typevm) 
        VALUES (:storagecapacity, :cpu, :gpu, :ram, :typevm)";
    $q_requerimientos = $conn->prepare($query_requerimientos);
    $q_requerimientos->bindParam(':storagecapacity', $_POST['storagecapacity']);
    $q_requerimientos->bindParam(':cpu', $_POST['cpu']);
    $q_requerimientos->bindParam(':gpu', $_POST['gpu']);
    $q_requerimientos->bindParam(':typevm', $_POST['typevm']);
    $q_requerimientos->execute();

    // Obtener el ID del proyecto recién insertado
    $requerimientos_id = $conn->lastInsertId();

    // Actualizar el usuario con los IDs de la institución y el proyecto
    $query_update_proyecto = "UPDATE projects
                              SET requirements_fk = :requerimientos_id
                              WHERE id = :proyecto_id";

    // Actualizar el usuario con los IDs de la institución y el proyecto
    $query_update_usuario = "UPDATE users 
                             SET institution_fk = :institucion_id, project_fk = :proyecto_id 
                             WHERE id = :usuario_id";
    $q_update_usuario = $conn->prepare($query_update_usuario);
    $q_update_usuario->bindParam(':institucion_id', $institucion_id);
    $q_update_usuario->bindParam(':proyecto_id', $proyecto_id);
    $q_update_usuario->bindParam(':usuario_id', $usuario_id);
    $q_update_usuario->execute();

    // Confirmar transacción
    $conn->commit();
    // $dbuser = null;
    // $dbpass = null;
    // $dbname = null;

    echo "¡Registro exitoso!";
} catch (PDOException $e) {
    // Revertir la transacción en caso de error
    $conn->rollBack();
    echo "Error en el registro: " . $e->getMessage();
}
?>
