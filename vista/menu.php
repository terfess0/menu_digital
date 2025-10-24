<?php
include("modelo/consultas.php");
?>
<!DOCTYPE html>
<html lang="es" class="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú del Restaurante</title>
  <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            primary: "#f26c0d",
            "background-light": "#f8f7f5",
            "background-dark": "#221710",
          },
          fontFamily: { display: ["Epilogue"] },
        },
      },
    };
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div class="flex flex-col min-h-screen">

  <!-- HEADER -->
  <header class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-8 py-4">
    <div class="flex items-center gap-3 text-gray-900 dark:text-white">
      <div class="text-primary text-2xl">🍽️</div>
      <h2 class="text-xl font-bold">Gourmet Place</h2>
    </div>
    <button class="relative flex items-center bg-primary/20 dark:bg-primary/30 text-primary rounded-lg px-4 py-2">
      <span class="material-symbols-outlined">shopping_cart</span>
      <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-white text-xs font-bold">3</span>
    </button>
  </header>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="flex-1 px-6 md:px-20 lg:px-40 py-8">
    <?php
    $menus = mysqli_query($conn, "SELECT * FROM menu WHERE disponible = 1 ORDER BY id_menu ASC");

    if (!$menus || mysqli_num_rows($menus) == 0) {
      echo "<p class='text-center text-red-500 font-bold mt-10'>⚠️ No hay menús disponibles.</p>";
    } else {
      while ($menu = mysqli_fetch_assoc($menus)):
        $platos = mysqli_query($conn, "SELECT * FROM plato WHERE id_menu = ".$menu['id_menu']." AND disponible = 1");
    ?>
      <section class="pt-10">
        <h3 class="text-2xl font-bold mb-2 text-gray-900 dark:text-white">
          <?= htmlspecialchars($menu['nombre']) ?>
        </h3>
        <p class="text-gray-500 dark:text-gray-400 mb-6"><?= htmlspecialchars($menu['descripcion']) ?></p>

        <div class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-6">
          <?php if ($platos && mysqli_num_rows($platos) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($platos)): ?>
              <div class="flex flex-col gap-3 rounded-lg overflow-hidden bg-white dark:bg-gray-800 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="p-4 flex flex-col flex-1">
                  <p class="text-gray-900 dark:text-white text-lg font-medium"><?= htmlspecialchars($row["nombre"]) ?></p>
                  <p class="text-gray-600 dark:text-gray-300 text-sm mt-1"><?= htmlspecialchars($row["descripcion"]) ?></p>
                  <p class="text-primary text-base font-bold mt-2">$<?= number_format($row["precio"], 2) ?></p>
                  <div class="flex gap-2 mt-4">
                    <button class="flex-1 h-12 rounded-lg bg-primary/20 dark:bg-primary/30 text-primary font-bold">Ver Detalles</button>
                    <button class="flex-1 h-12 rounded-lg bg-primary text-white font-bold">Añadir</button>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p class="text-gray-500 dark:text-gray-400">No hay platos disponibles en este menú.</p>
          <?php endif; ?>
        </div>
      </section>
    <?php
      endwhile;
    }
    ?>
  </main>

</div>
</body>
</html>
