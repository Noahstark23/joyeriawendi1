<?php
namespace App\Controller;
class CartController
{
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];
        include __DIR__ . '/../../templates/cart/index.php';
    }
    public function add(array $data)
    {
        $id = $data['id'];
        $qty = max(1, (int)$data['quantity']);
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 0;
        }
        $_SESSION['cart'][$id] += $qty;
        header('Location: /cart');
    }
    public function remove(array $data)
    {
        $id = $data['id'];
        unset($_SESSION['cart'][$id]);
        header('Location: /cart');
    }
}
