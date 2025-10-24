<?php
include("modelo/database.php");

// ==== LOGIN ====
session_start();
$mensaje = "";

if (isset($_POST['login'])) {
  $correo = $_POST['email'];
  $password = $_POST['contrasena'];

  $query = "SELECT * FROM usuario WHERE email='$correo'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['contrasena'])) {
      $_SESSION['usuario'] = $row['nombre'];
      $_SESSION['rol'] = $row['id_rol'];
      header("Location: vista/menu.php");
      exit();
    } else {
      $mensaje = "Contraseña incorrecta.";
    }
  } else {
    $mensaje = "Usuario no encontrado.";
  }
}

// ==== REGISTRO ====
if (isset($_POST['registrar'])) {
  $nombre = $_POST['nombre'];
  $correo = $_POST['email'];
  $telefono = $_POST['telefono'];
  $direccion = $_POST['direccion'];
  $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
  $rol = 2; // Cliente por defecto

  $query = "INSERT INTO usuario (nombre, email, telefono, direccion, contrasena, id_rol)
            VALUES ('$nombre', '$correo', '$telefono', '$direccion', '$contrasena', '$rol')";
  if (mysqli_query($conn, $query)) {
    $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
  } else {
    $mensaje = "Error al registrar: " . mysqli_error($conn);
  }
}
?>
  
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menu Digital - Iniciar Sesión / Registro</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
  <style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    #modalRegistro { display: none; }
  </style>
</head>
<body class="bg-[#fcfaf8] font-display">
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
      <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-[#1c130d]">Bienvenido a Menu Digital</h1>
        <p class="text-[#9c6c49]">Inicia sesión o regístrate para continuar</p>
      </div>

      <?php if ($mensaje): ?>
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded"><?= $mensaje ?></div>
      <?php endif; ?>

      <form method="POST" class="flex flex-col gap-4">
        <label>
          <p class="text-sm font-medium pb-1">Correo Electrónico</p>
          <input type="email" name="email" required
                 class="w-full border border-[#e8d9ce] rounded-lg h-12 p-3 focus:ring-2 focus:ring-[#f26c0d]"/>
        </label>

        <label>
          <p class="text-sm font-medium pb-1">Contraseña</p>
          <input type="contrasena" name="contrasena" required
                 class="w-full border border-[#e8d9ce] rounded-lg h-12 p-3 focus:ring-2 focus:ring-[#f26c0d]"/>
        </label>

        <button name="login" class="bg-[#f26c0d] text-white font-bold py-3 rounded-lg hover:bg-[#e15d05]">
          Iniciar Sesión
        </button>
      </form>

      <div class="text-center mt-4">
        <button id="btnAbrirModal" class="text-[#9c6c49] hover:text-[#f26c0d]">
          ¿No tienes cuenta? Regístrate
        </button>
      </div>
    </div>
  </div>

  <!-- Modal Registro -->
  <div id="modalRegistro" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg">
      <h2 class="text-xl font-bold mb-4 text-center">Crear cuenta</h2>
      <form method="POST" class="flex flex-col gap-3">
  <input type="text" name="nombre" placeholder="Nombre completo" required class="border p-3 rounded-lg">
  <input type="email" name="email" placeholder="Correo electrónico" required class="border p-3 rounded-lg">
  <input type="text" name="telefono" placeholder="Teléfono" required class="border p-3 rounded-lg">
  <input type="text" name="direccion" placeholder="Dirección" required class="border p-3 rounded-lg">
  <input type="password" name="contrasena" placeholder="Contraseña" required class="border p-3 rounded-lg">

  <button name="registrar" class="bg-[#f26c0d] text-white py-3 rounded-lg font-bold hover:bg-[#e15d05]">
    Registrar
  </button>
</form>

      <div class="text-center mt-3">
        <button id="btnCerrarModal" class="text-[#9c6c49] hover:text-[#f26c0d]">Cancelar</button>
      </div>
    </div>
  </div>

  <script>
    const modal = document.getElementById("modalRegistro");
    document.getElementById("btnAbrirModal").addEventListener("click", () => modal.style.display = "flex");
    document.getElementById("btnCerrarModal").addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", (e) => { if (e.target === modal) modal.style.display = "none"; });
  </script>
</body>
</html>
