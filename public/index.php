<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controller\AuthController;
use App\Controller\ProductController;
use App\Controller\PageController;
use App\Controller\ContactController;
use Dotenv\Dotenv;
use PDO;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$pdo = new PDO(
    "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
);

$cartController = new \App\Controller\CartController();
$adminMiddleware = new \App\Middleware\AdminMiddleware($pdo);
$productAdmin = new \App\Controller\Admin\ProductAdminController($pdo);

$productController = new ProductController($pdo);
$pageController    = new PageController();
$contactController = new ContactController();

$router = new Router();

$router->get('/auth/register', [AuthController::class, 'showRegister']);
$router->post('/auth/register', [AuthController::class, 'register']);
$router->get('/auth/login', [AuthController::class, 'showLogin']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
$router->get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

$router->get('/admin/products', function() use ($adminMiddleware, $productAdmin) {
    $adminMiddleware->handle();
    $productAdmin->index();
});
$router->get('/admin/products/create', function() use ($adminMiddleware, $productAdmin) {
    $adminMiddleware->handle();
    $productAdmin->create();
});
$router->post('/admin/products/store', function() use ($adminMiddleware, $productAdmin) {
    $adminMiddleware->handle();
    $productAdmin->store($_POST);
});
$router->get('/admin/products/edit/{id}', function($vars) use ($adminMiddleware, $productAdmin) {
    $adminMiddleware->handle();
    $productAdmin->edit($vars);
});
$router->post('/admin/products/update', function() use ($adminMiddleware, $productAdmin) {
    $adminMiddleware->handle();
    $productAdmin->update($_POST);
});
$router->post('/admin/products/destroy', function() use ($adminMiddleware, $productAdmin) {
    $adminMiddleware->handle();
    $productAdmin->destroy($_POST);
});

$router->get('/',               fn() => $pageController->home());
$router->get('/about',          fn() => $pageController->about());
$router->get('/contact',        fn() => $pageController->contact());
$router->post('/contact/send',  fn() => $contactController->send($_POST));
$router->get('/policies',       fn() => $pageController->policies());

$router->get('/catalog', fn() => $productController->index());
$router->get('/search', fn($vars) => $productController->search(array_merge($_GET, $vars)));
$router->get('/product/{slug}', fn($params) => $productController->show($params));
$router->get('/cart', fn() => $cartController->index());
$router->post('/cart/add', fn() => $cartController->add($_POST));
$router->post('/cart/remove', fn() => $cartController->remove($_POST));

$method = $_SERVER['REQUEST_METHOD'];
$path = strtok($_SERVER['REQUEST_URI'], '?');

$router->dispatch($method, $path);
