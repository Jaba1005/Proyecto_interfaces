<?php
session_start();

// Validación de sesión: si NO existe el usuario → redirigir a login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Vista/login.php");
    exit();
}

// Si quieres redirigir si ya tiene ID, puedes activar esta línea:
// if (isset($_SESSION['id'])) {
//     header("Location: verduras.php");
//     exit();
// }

$BASE_URL = "http://localhost/Proyecto_Interfaces/";
?>
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

  <style>
    .consejo {
      display: none;
      margin-left: 20px;
      background: #f3f3f3;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ddd;
    }
    li {
      cursor: pointer;
      margin: 8px 0;
    }
  </style>
</head>

<body>
  <header>
    <h1>Verduras en Colombia</h1>
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
