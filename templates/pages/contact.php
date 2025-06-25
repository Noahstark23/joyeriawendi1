<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Contacto</title>
</head>
<body class="container py-5">
  <h1 class="mb-4">Contáctanos</h1>
  <?php if (isset($_GET['sent'])): ?>
    <div class="alert alert-success">Tu mensaje ha sido enviado correctamente.</div>
  <?php endif; ?>
  <form method="post" action="/contact/send">
    <div class="mb-3">
      <label for="name" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="subject" class="form-label">Asunto</label>
      <input type="text" class="form-control" id="subject" name="subject" required>
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Mensaje</label>
      <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</body>
</html>
