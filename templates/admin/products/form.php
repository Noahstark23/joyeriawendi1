<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?= isset($product) ? 'Editar' : 'Nuevo' ?> Producto</title>
</head>
<body class="container py-5">
  <h1 class="mb-4"><?= isset($product) ? 'Editar' : 'Nuevo' ?> Producto</h1>
  <form method="post" action="<?= isset($product) ? '/admin/products/update' : '/admin/products/store' ?>">
    <?php if (isset($product)): ?>
      <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <?php endif; ?>
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="name" class="form-control" value="<?= isset($product) ? htmlspecialchars($product['name']) : '' ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input type="text" name="slug" class="form-control" value="<?= isset($product) ? htmlspecialchars($product['slug']) : '' ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="description" class="form-control" rows="4"><?= isset($product) ? htmlspecialchars($product['description']) : '' ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Precio</label>
      <input type="number" step="0.01" name="price" class="form-control" value="<?= isset($product) ? $product['price'] : '' ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Imagen</label>
      <input type="text" name="image" class="form-control" value="<?= isset($product) ? htmlspecialchars($product['image']) : '' ?>">
    </div>
    <button class="btn btn-primary" type="submit">Guardar</button>
    <a href="/admin/products" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
