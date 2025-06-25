<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Administrar Productos</title>
</head>
<body class="container py-5">
  <h1 class="mb-4">Productos</h1>
  <a href="/admin/products/create" class="btn btn-primary mb-3">Nuevo producto</a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['name']) ?></td>
          <td>$<?= number_format($p['price'], 2) ?></td>
          <td>
            <a href="/admin/products/edit/<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <form method="post" action="/admin/products/destroy" class="d-inline">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">
              <button class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
