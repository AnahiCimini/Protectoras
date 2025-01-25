<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<h1>Login</h1>

<div class="container" style="max-width: 400px; margin-top: 50px;">
<form method="POST" action="<?php echo BASE_URL; ?>router.php?action=login">
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" autocomplete="email" required>
      </div>
      
      <!-- Input Contraseña -->
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" autocomplete="password" required>
      </div>

      <!-- Botón Login -->
      <button type="submit" class="btn btn-standard btn-block login-btn">Login</button>

      <!-- Enlace Olvidó la contraseña -->
      <div class="mt-2 text-center">
        <a href="#">He olvidado mi contraseña</a>
      </div>
    </form>
  </div>
