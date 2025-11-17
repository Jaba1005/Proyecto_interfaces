<?php
session_start();

// ▼ Validación de sesión
// Si NO existe el usuario en sesión → redirigir a login
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Vista/login.php");
    exit();
}

// Si existe el ID → puede quedar aquí o cambiar destino
if (isset($_SESSION['id'])) {
    // Si quieres que entre igual, puedes comentar esta línea
    // header("Location: frutas.php");
    // exit();
}

$BASE_URL = "http://localhost/Proyecto_Interfaces/";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Frutas</title>
  <link rel="stylesheet" href="styles.css">

  <script>
    function toggleConsejo(id) {
      const consejo = document.getElementById(id);
      consejo.style.display = consejo.style.display === "block" ? "none" : "block";
    }
  </script>

  <style>
    /* Opcional: evitar que los consejos aparezcan abiertos al cargar */
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
    <h1>Frutas en Colombia
      
    </h1>
  </header>

  <main>
    <h2>
      
    Lista de Frutas</h2>
    <ul>
      <li onclick="toggleConsejo('consejo-mango')">🥭 Mango</li>
      <div id="consejo-mango" class="consejo">
        Consejo: El mango es excelente para jugos y ensaladas. Aporta vitamina A y C.
      </div>

      <li onclick="toggleConsejo('consejo-pina')">🍍 Piña</li>
      <div id="consejo-pina" class="consejo">
        Consejo: La piña ayuda a la digestión gracias a la bromelina.
      </div>

      <li onclick="toggleConsejo('consejo-melon')">🍈 Melón</li>
      <div id="consejo-melon" class="consejo">
        Consejo: El melón es refrescante y rico en agua, ideal para el calor.
      </div>

      <li onclick="toggleConsejo('consejo-uva')">🍇 Uva</li>
      <div id="consejo-uva" class="consejo">
        Consejo: Las uvas son antioxidantes y buenas para la circulación.
      </div>
    </ul>
  </main>

  <footer>
    <p>© 2025 Frutas y Verduras de Colombia</p>
  </footer>

</body>
</html>
