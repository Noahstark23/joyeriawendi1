<?php
namespace App\Controller\Admin;

use PDO;

class ProductAdminController
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
        include __DIR__ . '/../../../templates/admin/products/index.php';
    }

    public function create(): void
    {
        $product = null;
        include __DIR__ . '/../../../templates/admin/products/form.php';
    }

    public function store(array $data): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO products (name, slug, description, price, image) VALUES (?,?,?,?,?)'
        );
        $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['price'],
            $data['image'] ?? null,
        ]);
        header('Location: /admin/products');
    }

    public function edit(array $params): void
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->execute([$params['id']]);
        $product = $stmt->fetch();
        include __DIR__ . '/../../../templates/admin/products/form.php';
    }

    public function update(array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE products SET name=?, slug=?, description=?, price=?, image=? WHERE id=?'
        );
        $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['price'],
            $data['image'] ?? null,
            $data['id'],
        ]);
        header('Location: /admin/products');
    }

    public function destroy(array $data): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$data['id']]);
        header('Location: /admin/products');
    }
}
