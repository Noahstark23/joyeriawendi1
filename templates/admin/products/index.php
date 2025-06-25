<?php include __DIR__ . '/../../partials/header.php'; ?>
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
<?php include __DIR__ . '/../../partials/footer.php'; ?>
