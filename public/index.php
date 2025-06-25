<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controller\AuthController;
use App\Controller\ProductController;
use PDO;

session_start();

// Load environment variables if available
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

$dsn = $_ENV['DB_DSN'] ?? 'mysql:host=localhost;dbname=app;charset=utf8mb4';
$dbUser = $_ENV['DB_USER'] ?? 'root';
$dbPass = $_ENV['DB_PASS'] ?? '';
$pdo = new PDO($dsn, $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$productController = new ProductController($pdo);

$router = new Router();

$router->get('/auth/register', [AuthController::class, 'showRegister']);
$router->post('/auth/register', [AuthController::class, 'register']);
$router->get('/auth/login', [AuthController::class, 'showLogin']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
$router->get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

$router->get('/', fn() => $productController->index());
$router->get('/search', fn($vars) => $productController->search(array_merge($_GET, $vars)));
$router->get('/product/{slug}', fn($params) => $productController->show($params));

$method = $_SERVER['REQUEST_METHOD'];
$path = strtok($_SERVER['REQUEST_URI'], '?');

$router->dispatch($method, $path);
