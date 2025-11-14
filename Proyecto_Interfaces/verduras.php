<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Verduras</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    function toggleConsejo(id) {
      const consejo = document.getElementById(id);
      consejo.style.display = consejo.style.display === "block" ? "none" : "block";
    }
  </script>
</head>
<body>
  <header>
    <h1>Verduras en Colombia</h1>
    <nav>
      <ul>
        <li><a href="menu.php">Inicio</a></li>
        <li><a href="frutas.php">Frutas</a></li>
        <li><a href="temporada.php">Temporada</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h2>Lista de Verduras</h2>
    <ul>
      <li onclick="toggleConsejo('consejo-papa')">🥔 Papa</li>
      <div id="consejo-papa" class="consejo">
        Consejo: La papa es rica en carbohidratos y es la base de muchas comidas típicas.
      </div>

      <li onclick="toggleConsejo('consejo-yuca')">🌱 Yuca</li>
      <div id="consejo-yuca" class="consejo">
        Consejo: La yuca se consume frita, cocida o en pandebonos. Aporta energía.
      </div>

      <li onclick="toggleConsejo('consejo-zanahoria')">🥕 Zanahoria</li>
      <div id="consejo-zanahoria" class="consejo">
        Consejo: La zanahoria es buena para la vista por su contenido en betacarotenos.
      </div>

      <li onclick="toggleConsejo('consejo-tomate')">🍅 Tomate</li>
      <div id="consejo-tomate" class="consejo">
        Consejo: El tomate es rico en licopeno, antioxidante natural.
      </div>
    </ul>
  </main>

  <footer>
    <p>© 2025 Frutas y Verduras de Colombia</p>
  </footer>
</body>
</html>

<?php
session_start();

// Si el usuario ya está logueado, redirigir a menu.php
if (isset($_SESSION['id'])) {
    header("Location: verduras.php");
    exit();
}
$BASE_URL = "http://localhost/Proyecto_Interfaces/";
?>