<?php
namespace App\Controller;

use App\Router;
use League\OAuth2\Client\Provider\Google;

class AuthController
{
    protected $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../config/services.php';
    }

    protected function render(string $template, array $data = [])
    {
        extract($data);
        include __DIR__ . '/../../templates/' . $template . '.php';
    }

    public function showRegister()
    {
        $this->render('auth/register');
    }

    public function register()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        if (!$email || !$password) {
            echo 'Email and password required';
            return;
        }
        // Example: password hashing and storing to DB omitted for brevity
        echo 'User registered';
    }

    public function showLogin()
    {
        $this->render('auth/login');
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        // Example: fetch user and verify password omitted
        echo 'Logged in';
    }

    protected function googleProvider(): Google
    {
        $config = $this->config['google'];
        return new Google([
            'clientId'     => $config['clientId'],
            'clientSecret' => $config['clientSecret'],
            'redirectUri'  => $config['redirectUri'],
        ]);
    }

    public function redirectToGoogle()
    {
        $provider = $this->googleProvider();
        $authUrl = $provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $provider->getState();
        header('Location: ' . $authUrl);
        exit;
    }

    public function handleGoogleCallback()
    {
        $provider = $this->googleProvider();
        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        }
        if (!isset($_GET['code'])) {
            exit('No code');
        }
        try {
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
            $googleUser = $provider->getResourceOwner($token);
            // Here you'd find or create user in DB
            echo 'Google user authenticated: ' . $googleUser->getEmail();
        } catch (\Exception $e) {
            exit('Authentication failed');
        }
    }
}
