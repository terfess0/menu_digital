<?php
include("modelo/database.php");

// Consulta por categoría
function obtenerPlatos($conn, $categoria) {
  $sql = "SELECT * FROM platos WHERE categoria = '$categoria'";
  $resultado = mysqli_query($conn, $sql);
  return $resultado;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú del Restaurante</title>
  <link rel="stylesheet" href="styles/menu.css">
</head>
<body>
  <header class="encabezado">
    <div class="logo">
      <h2>🍽️ Gourmet Place</h2>
    </div>
    <button class="boton-carrito">
      🛒 <span class="contador">3</span>
    </button>
  </header>

  <nav class="menu-categorias">
    <a href="#entradas">Entradas</a>
    <a href="#platos">Platos Principales</a>
    <a href="#postres">Postres</a>
    <a href="#bebidas">Bebidas</a>
  </nav>

  <main class="contenido">

    <!-- Entradas -->
    <section id="entradas">
      <h3>Entradas</h3>
      <div class="grid">
        <?php
        $platos = obtenerPlatos($conn, 'entradas');
        if ($platos && mysqli_num_rows($platos) > 0):
          while ($row = mysqli_fetch_assoc($platos)):
        ?>
          <div class="tarjeta">
            <img src="<?= htmlspecialchars($row['imagen']) ?>" alt="<?= htmlspecialchars($row['nombre']) ?>">
            <div class="info">
              <h4><?= htmlspecialchars($row['nombre']) ?></h4>
              <p><?= htmlspecialchars($row['descripcion']) ?></p>
              <p class="precio">€<?= number_format($row['precio'], 2) ?></p>
              <div class="acciones">
                <button class="detalles">Ver Detalles</button>
                <button class="añadir">Añadir</button>
              </div>
            </div>
          </div>
        <?php
          endwhile;
        else:
          echo "<p class='sin-menu'>Sin platos disponibles.</p>";
        endif;
        ?>
      </div>
    </section>

    <!-- Platos principales -->
    <section id="platos">
      <h3>Platos Principales</h3>
      <div class="grid">
        <?php
        $platos = obtenerPlatos($conn, 'platos_principales');
        if ($platos && mysqli_num_rows($platos) > 0):
          while ($row = mysqli_fetch_assoc($platos)):
        ?>
          <div class="tarjeta">
            <img src="<?= htmlspecialchars($row['imagen']) ?>" alt="<?= htmlspecialchars($row['nombre']) ?>">
            <div class="info">
              <h4><?= htmlspecialchars($row['nombre']) ?></h4>
              <p><?= htmlspecialchars($row['descripcion']) ?></p>
              <p class="precio">€<?= number_format($row['precio'], 2) ?></p>
              <div class="acciones">
                <button class="detalles">Ver Detalles</button>
                <button class="añadir">Añadir</button>
              </div>
            </div>
          </div>
        <?php
          endwhile;
        else:
          echo "<p class='sin-menu'>Sin platos disponibles.</p>";
        endif;
        ?>
      </div>
    </section>

    <!-- Postres -->
    <section id="postres">
      <h3>Postres</h3>
      <div class="grid">
        <?php
        $platos = obtenerPlatos($conn, 'postres');
        if ($platos && mysqli_num_rows($platos) > 0):
          while ($row = mysqli_fetch_assoc($platos)):
        ?>
          <div class="tarjeta">
            <img src="<?= htmlspecialchars($row['imagen']) ?>" alt="<?= htmlspecialchars($row['nombre']) ?>">
            <div class="info">
              <h4><?= htmlspecialchars($row['nombre']) ?></h4>
              <p><?= htmlspecialchars($row['descripcion']) ?></p>
              <p class="precio">€<?= number_format($row['precio'], 2) ?></p>
              <div class="acciones">
                <button class="detalles">Ver Detalles</button>
                <button class="añadir">Añadir</button>
              </div>
            </div>
          </div>
        <?php
          endwhile;
        else:
          echo "<p class='sin-menu'>Sin postres disponibles.</p>";
        endif;
        ?>
      </div>
    </section>

  </main>
</body>
</html>
