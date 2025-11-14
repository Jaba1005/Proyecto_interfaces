<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../Vista/login.php");
    exit();
}

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
        .user-menu-container {
            position: relative;
            display: inline-block;
            margin-right: 25px;
        }
        .user-btn {
            background: #000000ff;
            border: none;
            color: white;
            padding: 10px 15px;
            font-size: 15px;
            cursor: pointer;
            border-radius: 6px;
            font-weight: bold;
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
        }
    </style>
</head>

<body>

<div class="navbar">

    <div class="user-menu-container">
        <button class="user-btn">☰ <?= htmlspecialchars($_SESSION["usuario"]) ?></button>
        <div class="user-dropdown">
            <a href="<?= $BASE_URL ?>./Vista/index.php">Mi cuenta</a>
            <a href="<?= $BASE_URL ?>./Vista/logout.php">Cerrar sesión</a>
        </div>
    </div>

    <h2>Panel Principal</h2>

    <div>
         <a href="<?= $BASE_URL ?>./Modelo/menu.php">Menu</a>
        <a href="#" onclick="loadPage('./Modelo/frutas')">Frutas</a>
        <a href="#" onclick="loadPage('./Modelo/verduras')">Verduras</a>
        <a href="#" onclick="loadPage('./Modelo/temporada')">Temporada</a>
        <a href="#" onclick="loadPage('./Modelo/premium')">Premium</a>
        <a href="<?= $BASE_URL ?>./Vista/logout.php">Salir</a>
    </div>
</div>

<!-- CONTENIDO DINÁMICO -->
<div class="container" id="contenido-principal">
    <div class="card">
        <h2>Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?> 👋</h2>
        <p>Selecciona una opción del menú superior para continuar.</p>
    </div>
</div>

<script>
// --- MENÚ DEL USUARIO ---
document.querySelector(".user-btn").addEventListener("click", function() {
    const menu = document.querySelector(".user-dropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
});

document.addEventListener("click", function(e) {
    const menu = document.querySelector(".user-dropdown");
    const btn = document.querySelector(".user-btn");

    if (!menu.contains(e.target) && !btn.contains(e.target)) {
        menu.style.display = "none";
    }
});

// --- CARGA DINÁMICA DE PÁGINAS ---
function loadPage(page) {
    const baseURL = "<?= $BASE_URL ?>";
    const content = document.getElementById("contenido-principal");

    fetch(baseURL + page + ".php")
    .then(response => response.text())
    .then(html => {
        content.innerHTML = html;
        window.scrollTo(0, 0);
    })
    .catch(error => {
        content.innerHTML = "<p>Error al cargar el contenido.</p>";
        console.error(error);
    });
}
</script>

</body>
</html>
