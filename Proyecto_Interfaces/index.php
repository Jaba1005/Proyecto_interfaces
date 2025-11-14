<?php
session_start();

$BASE_URL = "http://localhost/Proyecto_Interfaces/";
include_once "conexion.php";

/* =========================
   HELPERS
========================= */
function perfilToText($p) {
    if ($p === 'admin' || $p === 'usuario') return $p;
    if ($p === '1' || $p == 1) return 'admin';
    return 'usuario';
}

function safe($v){
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

/* =========================
   SESIÓN
========================= */
$sesionPerfil = isset($_SESSION['id_perfil']) ? perfilToText($_SESSION['id_perfil']) : null;
$sesionIdentificacion = $_SESSION['identificacion'] ?? null;

/* ==========================================
   ELIMINAR — SOLO ADMIN
========================================== */
if (isset($_GET['eliminar']) && $sesionPerfil === 'admin') {

    $idEliminar = trim($_GET['eliminar']);

    $stmt = $conn->prepare("DELETE FROM datos WHERE identificacion=?");
    $stmt->bind_param("s", $idEliminar);
    $stmt->execute();
    $stmt->close();

    header("Location: {$BASE_URL}index.php");
    exit();
}

/* ==========================================
   GUARDAR — SOLO ADMIN
========================================== */
if (isset($_POST['guardar']) && $sesionPerfil === 'admin') {

    $identificacion = trim($_POST['identificacion']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);
    $id_perfil = perfilToText($_POST['id_perfil']);

    $stmt = $conn->prepare("
        INSERT INTO datos 
        (identificacion, nombre, apellido, email, usuario, clave, id_perfil)
        VALUES (?,?,?,?,?,?,?)
    ");
    $stmt->bind_param("sssssss",
        $identificacion, $nombre, $apellido, $email, $usuario, $clave, $id_perfil
    );
    $stmt->execute();
    $stmt->close();

    header("Location: {$BASE_URL}index.php");
    exit();
}

/* ==========================================
   ACTUALIZAR — ADMIN O EL PROPIO USUARIO
========================================== */
if (isset($_POST['actualizar'])) {

    $identificacion = trim($_POST['identificacion']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $usuario = trim($_POST['usuario']);
    $id_perfil = perfilToText($_POST['id_perfil']);

    // Usuario normal NO puede editar a otros
    if ($sesionPerfil !== 'admin' && $identificacion !== $sesionIdentificacion) {
        header("Location: {$BASE_URL}index.php");
        exit();
    }

    // Usuario normal NO puede cambiar su perfil
    if ($sesionPerfil !== 'admin') {
        $id_perfil = "usuario";
    }

    $stmt = $conn->prepare("
        UPDATE datos
        SET nombre=?, apellido=?, email=?, usuario=?, id_perfil=?
        WHERE identificacion=?
    ");
    $stmt->bind_param("ssssss",
        $nombre, $apellido, $email, $usuario, $id_perfil, $identificacion
    );
    $stmt->execute();
    $stmt->close();

    header("Location: {$BASE_URL}index.php");
    exit();
}

/* ==========================================
   CARGAR REGISTRO A EDITAR
========================================== */
$registroEditar = null;

if (isset($_GET['editar'])) {

    $idEditar = trim($_GET['editar']);

    if ($sesionPerfil !== 'admin' && $idEditar !== $sesionIdentificacion) {
        header("Location: {$BASE_URL}index.php");
        exit();
    }

    $stmt = $conn->prepare("
        SELECT identificacion, nombre, apellido, email, usuario, id_perfil
        FROM datos WHERE identificacion = ?
    ");
    $stmt->bind_param("s", $idEditar);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $registroEditar = $res->fetch_assoc();
        $registroEditar['id_perfil'] = perfilToText($registroEditar['id_perfil']);
    }

    $stmt->close();
}

/* ==========================================
   TABLA DE USUARIOS
========================================== */
$usuarios = [];

if ($sesionPerfil === 'admin') {

    $res = $conn->query("
        SELECT identificacion, nombre, apellido, email, usuario, id_perfil
        FROM datos ORDER BY nombre ASC
    ");

} else {

    // USUARIO NORMAL → ver solo sus datos
    if ($sesionIdentificacion) {
        $stmt = $conn->prepare("
            SELECT identificacion, nombre, apellido, email, usuario, id_perfil
            FROM datos WHERE identificacion = ?
        ");
        $stmt->bind_param("s", $sesionIdentificacion);
        $stmt->execute();
        $res = $stmt->get_result();
    }
}

if (!empty($res)) {
    while ($r = $res->fetch_assoc()) {
        $r['id_perfil'] = perfilToText($r['id_perfil']);
        $usuarios[] = $r;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Usuarios - CRUD</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>Styles.css">

    <style>
        .navbar h2 { color:white !important; }
        .table-wrap { overflow-x:auto; }
        table.styled th { background: var(--color-primario); color:white; }
    </style>
</head>

<body>

<div class="container" style="max-width:1200px; margin:30px auto;">

    <!-- NAV -->
    <div class="navbar" style="margin-bottom:18px;">
        <h2>Gestión de Usuarios</h2>
        <a class="btn" href="<?= $BASE_URL ?>menu.php">Volver al panel</a>
    </div>

    <!-- FORM EDITAR -->
    <?php if ($registroEditar): ?>
        <div class="card">
            <h3>Editar mi información</h3>

            <form method="POST">
                <input type="hidden" name="identificacion" value="<?= safe($registroEditar['identificacion']) ?>">

                <label>Nombre</label>
                <input type="text" name="nombre" required value="<?= safe($registroEditar['nombre']) ?>">

                <label>Apellido</label>
                <input type="text" name="apellido" required value="<?= safe($registroEditar['apellido']) ?>">

                <label>Email</label>
                <input type="email" name="email" required value="<?= safe($registroEditar['email']) ?>">

                <label>Usuario</label>
                <input type="text" name="usuario" required value="<?= safe($registroEditar['usuario']) ?>">

                <?php if ($sesionPerfil === 'admin'): ?>
                    <label>Perfil</label>
                    <select name="id_perfil">
                        <option value="usuario" <?= $registroEditar['id_perfil']=="usuario"?"selected":"" ?>>Usuario</option>
                        <option value="admin" <?= $registroEditar['id_perfil']=="admin"?"selected":"" ?>>Administrador</option>
                    </select>
                <?php endif; ?>

                <button class="btn" name="actualizar">Guardar cambios</button>
                <a class="btn" style="background:#6b7280;" href="<?= $BASE_URL ?>index.php">Cancelar</a>
            </form>
        </div>
    <?php endif; ?>

    <!-- FORM AGREGAR (SOLO ADMIN) -->
    <?php if ($sesionPerfil === 'admin' && !$registroEditar): ?>
        <div class="card">
            <h3>Agregar usuario</h3>
            <form method="POST">

                <label>Identificación</label>
                <input type="text" name="identificacion" required>

                <label>Nombre</label>
                <input type="text" name="nombre" required>

                <label>Apellido</label>
                <input type="text" name="apellido" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Usuario</label>
                <input type="text" name="usuario" required>

                <label>Clave</label>
                <input type="password" name="clave" required>

                <label>Perfil</label>
                <select name="id_perfil">
                    <option value="usuario">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>

                <button class="btn" name="guardar">Guardar</button>
            </form>
        </div>
    <?php endif; ?>

    <!-- TABLA -->
    <div class="card">
        <h3><?= $sesionPerfil === 'admin' ? "Usuarios registrados" : "Mis datos" ?></h3>

        <div class="table-wrap">
            <table class="styled">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Perfil</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($usuarios as $row): ?>
                        <tr>
                            <td><?= safe($row['identificacion']) ?></td>
                            <td><?= safe($row['nombre']) ?></td>
                            <td><?= safe($row['apellido']) ?></td>
                            <td><?= safe($row['email']) ?></td>
                            <td><?= safe($row['usuario']) ?></td>
                            <td><?= $row['id_perfil']=="admin" ? "Administrador" : "Usuario" ?></td>

                            <td>
                                <?php if ($sesionPerfil === 'admin'): ?>

                                    <a class="btn" href="<?= $BASE_URL ?>index.php?editar=<?= $row['identificacion'] ?>">Editar</a>

                                    <a class="btn" style="background:#ef4444;"
                                       onclick="return confirm('¿Eliminar este usuario?');"
                                       href="<?= $BASE_URL ?>index.php?eliminar=<?= $row['identificacion'] ?>">
                                       Eliminar
                                    </a>

                                <?php elseif ($row['identificacion'] === $sesionIdentificacion): ?>

                                    <!-- Usuario normal solo se edita a sí mismo -->
                                    <a class="btn" href="<?= $BASE_URL ?>index.php?editar=<?= $row['identificacion'] ?>">Editar</a>

                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

</body>
</html>
