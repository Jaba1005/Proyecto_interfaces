<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frutas y Verduras de Temporada</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .accordion {
      margin: 20px 0;
      border-radius: 8px;
      overflow: hidden;
    }

    .accordion-item {
      border: 1px solid #ddd;
      margin-bottom: 10px;
      border-radius: 8px;
    }

    .accordion-header {
      background-color: #c8e6c9;
      color: rgb(0, 0, 0);
      padding: 15px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s;
    }

    .accordion-header:hover {
      background-color: #c8e6c9;
    }

    .accordion-content {
      display: none;
      padding: 15px;
      background-color: #f9f9f9;
      animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }
  </style>
</head>
<body>
  <header>
    <h1>Frutas y Verduras de Temporada en Colombia</h1>
    <nav>
      <ul>
        <li><a href="menu.php">Inicio</a></li>
        <li><a href="frutas.php">Frutas</a></li>
        <li><a href="verduras.htmphpl">Verduras</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h2>🥭 Frutas por temporada</h2>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header">Enero – Marzo</div>
        <div class="accordion-content">
          <ul>
            <li>Mango 🥭</li>
            <li>Piña 🍍</li>
            <li>Melón 🍈</li>
            <li>Uva 🍇</li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">Abril – Junio</div>
        <div class="accordion-content">
          <ul>
            <li>Naranja 🍊</li>
            <li>Mandarina 🍊</li>
            <li>Limón 🍋</li>
            <li>Maracuyá 🥭</li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">Julio – Septiembre</div>
        <div class="accordion-content">
          <ul>
            <li>Lulo 🍋</li>
            <li>Mora 🍓</li>
            <li>Papaya 🍈</li>
            <li>Aguacate 🥑</li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">Octubre – Diciembre</div>
        <div class="accordion-content">
          <ul>
            <li>Guayaba 🍈</li>
            <li>Granadilla 🍊</li>
            <li>Curuba 🍐</li>
            <li>Borojo 🍎</li>
          </ul>
        </div>
      </div>
    </div>

    <h2>🥦 Verduras y hortalizas por temporada</h2>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header">Disponibles casi todo el año</div>
        <div class="accordion-content">
          <ul>
            <li>Papa 🥔</li>
            <li>Yuca 🌱</li>
            <li>Zanahoria 🥕</li>
            <li>Tomate 🍅</li>
            <li>Cebolla 🧅</li>
            <li>Habichuela 🌿</li>
            <li>Lechuga 🥬</li>
            <li>Espinaca 🌱</li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">Enero – Marzo</div>
        <div class="accordion-content">
          <ul>
            <li>Ahuyama 🎃</li>
            <li>Remolacha 🍠</li>
            <li>Repollo 🥬</li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">Abril – Junio</div>
        <div class="accordion-content">
          <ul>
            <li>Acelga 🌿</li>
            <li>Pepino 🥒</li>
            <li>Coliflor 🌸</li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">Julio – Septiembre</div>
        <div class="accordion-content">
          <ul>
            <li>Brócoli 🥦</li>
            <li>Arveja 🌱</li>
            <li>Calabacín 🍆</li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">Octubre – Diciembre</div>
        <div class="accordion-content">
          <ul>
            <li>Mazorca 🌽</li>
            <li>Fríjol 🌿</li>
            <li>Arracacha 🌱</li>
          </ul>
        </div>
      </div>
    </div>
  </main>

  <script>
    const headers = document.querySelectorAll(".accordion-header");
    headers.forEach(header => {
      header.addEventListener("click", () => {
        const content = header.nextElementSibling;
        content.style.display = content.style.display === "block" ? "none" : "block";
      });
    });
  </script>
</body>
</html>

<?php
session_start();

// Si el usuario ya está logueado, redirigir a menu.php
if (isset($_SESSION['id'])) {
    header("Location: temporada.php");
    exit();
}
$BASE_URL = "http://localhost/Proyecto_Interfaces/";
?>