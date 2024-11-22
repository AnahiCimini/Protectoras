<h1>Login</h1>

<div class="container" style="max-width: 400px; margin-top: 50px;">
<form method="POST" action="/Protectoras2/public_html/router.php?action=login">      <!-- Input Correo -->
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
      </div>
      
      <!-- Input Contraseña -->
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
      </div>

      <!-- Botón Login -->
      <button type="submit" class="btn btn-primary btn-block">Login</button>

      <!-- Enlace Olvidó la contraseña -->
      <div class="mt-2 text-center">
        <a href="#">He olvidado mi contraseña</a>
      </div>
    </form>
  </div>
