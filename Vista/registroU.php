<?php
include("../controlador/conexion.php");
$BASE_URL = "http://localhost/Proyecto_Interfaces/";

// Verificación simple de sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Vista/login.php");
    exit();
}

$mensaje = "";
$tipo_mensaje = "";

if (isset($_POST['registrar'])) {

    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $id_perfil = $_POST['id_perfil'];

    $sql = "INSERT INTO datos (identificacion, nombre, apellido, email, usuario, clave, id_perfil)
            VALUES ('$identificacion', '$nombre', '$apellido', '$email', '$usuario', '$clave', '$id_perfil')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Registro guardado correctamente.";
        $tipo_mensaje = "alert-success";
    } else {
        $mensaje = "Error: " . $conn->error;
        $tipo_mensaje = "alert-error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= $BASE_URL ?>Styles.css">
    <title>Registro</title>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>Registro de Usuarios</h2>
    <div>
        <a href="login.php">Iniciar sesión</a>
    </div>
</div>

<!-- CONTENEDOR CENTRAL -->
<div class="container">

    <?php if ($mensaje != "") { ?>
        <div class="alert <?= $tipo_mensaje ?>">
            <?= $mensaje ?>
        </div>
    <?php } ?>

    <div class="card">
        <h2>Crear nueva cuenta</h2>

        <form method="POST">

            <label>Identificación:</label>
            <input type="text" name="identificacion" required>

            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Apellido:</label>
            <input type="text" name="apellido" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Usuario:</label>
            <input type="text" name="usuario" required>

            <label>Clave:</label>
            <input type="password" name="clave" required>

            <label>Perfil:</label>
            <select name="id_perfil" required>
                <option value="Usuario">Usuario</option>
            </select>

            <button class="btn" type="submit" name="registrar">Registrar</button>
        </form>

        <hr>

        <a href="login.php" class="btn" style="background: var(--color-secundario);">
            Ir a iniciar sesión
        </a>
    </div>

</div>

</body>
</html>
