<?php
// templates/partials/header.php
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Joyería Wendy</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="/">Joyería Wendy</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="/">Catálogo</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">Sobre Nosotros</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contacto</a></li>
        </ul>
        <ul class="navbar-nav">
          <?php if (!empty($_SESSION['user_id'])): ?>
            <li class="nav-item"><a class="nav-link" href="/cart">Carrito</a></li>
            <li class="nav-item"><a class="nav-link" href="/auth/logout">Salir</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="/auth/login">Ingresar</a></li>
            <li class="nav-item"><a class="nav-link" href="/auth/register">Registrarse</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container mt-4">
