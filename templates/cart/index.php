<?php
use App\Controller\ProductController;
$productController = new ProductController($pdo);
$cart = $_SESSION['cart'] ?? [];
?>
<?php include __DIR__ . '/../partials/header.php'; ?>
<div class="container mt-5">
  <h1>Tu Carrito</h1>
  <?php if (empty($cart)): ?>
    <p>No tienes productos en el carrito.</p>
  <?php else: ?>
    <table class="table">
      <thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th><th></th></tr></thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($cart as $id => $qty):
          $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
          $stmt->execute([$id]);
          $product = $stmt->fetch();
          $subtotal = $product['price'] * $qty;
          $total += $subtotal;
        ?>
          <tr>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= $qty ?></td>
            <td>$<?= number_format($product['price'],2) ?></td>
            <td>$<?= number_format($subtotal,2) ?></td>
            <td>
              <form method="post" action="/cart/remove">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button class="btn btn-sm btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr><th colspan="3">Total:</th><th>$<?= number_format($total,2) ?></th><th></th></tr>
      </tfoot>
    </table>
    <a href="/checkout" class="btn btn-primary">Proceder al Pago</a>
  <?php endif; ?>
</div>
<?php include __DIR__ . '/../partials/footer.php'; ?>
