<?php
namespace App\Controller;
use PDO;

class ProductController
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function index(): void
    {
        $stmt = $this->pdo->query('SELECT * FROM products');
        $products = $stmt->fetchAll();
        include __DIR__ . '/../../templates/products/index.php';
    }

    public function show(array $params): void
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE slug = ?');
        $stmt->execute([$params['slug']]);
        $product = $stmt->fetch();
        if (!$product) {
            http_response_code(404);
            echo 'Producto no encontrado';
            return;
        }
        include __DIR__ . '/../../templates/products/show.php';
    }
}
