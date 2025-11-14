<?php
// MENU.PHP MEJORADO
// Navegación con URL estática y estilos modernos

session_start();

// Verificación simple de sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

// URL base estática
$BASE_URL = "http://localhost/Proyecto_Interfaces/";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>Styles.css">

    <style>
        /* --- ESTILOS ADICIONALES PARA EL MENÚ DE USUARIO --- */

        .user-menu-container {
            position: relative;
            display: inline-block;
            margin-right: 25px;
        }

        .user-btn {
            background: #1e40af;
            border: none;
            color: white;
            padding: 10px 15px;
            font-size: 15px;
            cursor: pointer;
            border-radius: 6px;
            font-weight: bold;
        }

        .user-btn:hover {
            background: #1d4ed8;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            left: 0;
            top: 45px;
            background-color: white;
            min-width: 160px;
            border-radius: 6px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
            z-index: 20;
        }

        .user-dropdown a {
            color: #1e3a8a;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 15px;
            font-weight: 500;
        }

        .user-dropdown a:hover {
            background: #e5e7eb;
        }
    </style>

</head>
<body>

<div class="navbar">

    <!-- MENÚ DE USUARIO A LA IZQUIERDA -->
    <div class="user-menu-container">
        <button class="user-btn">☰ <?= htmlspecialchars($_SESSION["usuario"]) ?></button>
        <div class="user-dropdown">
            <a href="<?= $BASE_URL ?>index.php">Mi cuenta</a>
            <a href="<?= $BASE_URL ?>logout.php">Cerrar sesión</a>
        </div>
    </div>  

    <!-- TÍTULO -->
    <h2>Panel Principal</h2>

    <div>
        <a href="<?= $BASE_URL ?>frutas.php">Frutas</a>
        <a href="<?= $BASE_URL ?>verduras.php">Verduras</a>
        <a href="<?= $BASE_URL ?>temporada.php">Temporada</a>
        <a href="<?= $BASE_URL ?>premium.php">Premium</a>
        <a href="<?= $BASE_URL ?>logout.php">Salir</a>
    </div>
</div>

<!-- CONTENIDO -->
<div class="container">
    <div class="card">
        <h2>Bienvenido, <?= htmlspecialchars($_SESSION["usuario"]) ?> 👋</h2>
        <p>Selecciona una opción del menú superior para continuar.</p>
    </div>
</div>

<!-- JS PARA MOSTRAR EL MENÚ -->
<script>
document.querySelector(".user-btn").addEventListener("click", function() {
    const menu = document.querySelector(".user-dropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
});

// Cerrar si se hace clic afuera
document.addEventListener("click", function(e) {
    const menu = document.querySelector(".user-dropdown");
    const btn = document.querySelector(".user-btn");

    if (!menu.contains(e.target) && !btn.contains(e.target)) {
        menu.style.display = "none";
    }
});
</script>

</body>
</html>
