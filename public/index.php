<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Router;
use App\Controller\AuthController;

session_start();

// Load environment variables if available
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

$router = new Router();

$router->get('/auth/register', [AuthController::class, 'showRegister']);
$router->post('/auth/register', [AuthController::class, 'register']);
$router->get('/auth/login', [AuthController::class, 'showLogin']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
$router->get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

$method = $_SERVER['REQUEST_METHOD'];
$path = strtok($_SERVER['REQUEST_URI'], '?');

$router->dispatch($method, $path);
