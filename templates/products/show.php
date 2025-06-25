<?php include __DIR__ . '/../partials/header.php'; ?>
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
<?php include __DIR__ . '/../partials/footer.php'; ?>
