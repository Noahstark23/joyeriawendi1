<?php
namespace App\Middleware;

use PDO;

class AdminMiddleware
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function handle(): void
    {
        session_start();
        if (empty($_SESSION['user_id'])) {
            header('Location: /auth/login');
            exit;
        }

        $stmt = $this->pdo->prepare('SELECT is_admin FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!$user || !$user['is_admin']) {
            http_response_code(403);
            exit('Acceso denegado');
        }
    }
}
