<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?= htmlspecialchars($product['name']) ?></title>
</head>
<body class="container py-5">
  <div class="row">
    <div class="col-md-6">
      <?php if (!empty($product['image'])): ?>
        <img src="<?= htmlspecialchars($product['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['name']) ?>">
      <?php endif; ?>
    </div>
    <div class="col-md-6">
      <h1><?= htmlspecialchars($product['name']) ?></h1>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      <h4 class="text-success">$<?= number_format($product['price'], 2) ?></h4>
      <form method="post" action="/cart/add" class="d-inline">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="number" name="quantity" value="1" min="1" class="form-control d-inline-block w-auto">
        <button class="btn btn-success">Agregar al carrito</button>
      </form>
    </div>
  </div>
</body>
</html>
