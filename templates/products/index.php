<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Productos</title>
</head>
<body class="container py-5">
  <form class="mb-4" method="get" action="/search">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Buscar productos..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
      <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
  </form>
  <h1 class="mb-4">Productos</h1>
  <?php if (!empty($_GET['q'])): ?>
    <h2>Resultados para "<?= htmlspecialchars($_GET['q']) ?>"</h2>
  <?php endif; ?>
  <div class="row">
    <?php foreach ($products as $p): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <?php if (!empty($p['image'])): ?>
            <img src="<?= htmlspecialchars($p['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
            <p class="card-text">$<?= number_format($p['price'], 2) ?></p>
            <a href="/product/<?= htmlspecialchars($p['slug']) ?>" class="btn btn-primary">Ver detalle</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
