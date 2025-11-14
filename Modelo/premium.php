<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planes - Frutas y Verduras de Colombia</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Planes disponibles 🌟</h1>
  </header>

  <main>
    <section>
      <h2>Elige tu plan 🍃</h2>
      <p>
        Tenemos dos opciones para ti: un plan <strong>Básico</strong> totalmente gratuito
        y un plan <strong>Premium</strong> con beneficios exclusivos para los más curiosos.
      </p>
    </section>

    <section class="planes">
      <div class="plan basico">
        <h3>🥑 Plan Básico (Gratis)</h3>
        <ul>
          <li>✔ Acceso a lista de frutas.</li>
          <li>✔ Acceso a lista de verduras.</li>
          <li>✔ Información por temporada.</li>
          <li>✔ Consejos generales de consumo.</li>
          <li>✔ Navegación simple e intuitiva.</li>
        </ul>
      </div>

      <div class="plan premium">
        <h3>🍍 Plan Premium (Exclusivo)</h3>
        <ul>
          <li>🌟 Consejos personalizados según tus preferencias.</li>
          <li>🌟 Recomendaciones de recetas con frutas y verduras de temporada.</li>
          <li>🌟 Listas de compras automáticas cada semana.</li>
          <li>🌟 Recordatorios de qué productos están frescos en el mercado.</li>
          <li>🌟 Información nutricional detallada.</li>
          <li>🌟 Comparador de precios y disponibilidad por región.</li>
          <li>🌟 Acceso anticipado a nuevas funciones.</li>
        </ul>
      </div>
    </section>

    <section class="cta">
      <h2>¿Quieres ser parte del modo Premium? 🚀</h2>
      <p>
        Muy pronto habilitaremos el registro para acceder al plan premium.
        Mientras tanto, disfruta del plan básico de manera gratuita.
      </p>
    </section>
  </main>

  <footer>
    <p>Frutas y Verduras de Colombia 🍃 | Todos los derechos reservados.</p>
  </footer>
</body>
</html>

<?php
session_start();

// Si el usuario ya está logueado, redirigir a menu.php
if (isset($_SESSION['id'])) {
    header("Location: premium.php");
    exit();
}

// Verificación simple de sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Vista/login.php");
    exit();
}

$BASE_URL = "http://localhost/Proyecto_Interfaces/";
?>