<?php
namespace App\Controller;

class PageController
{
    public function home()
    {
        include __DIR__ . '/../../templates/pages/home.php';
    }

    public function about()
    {
        include __DIR__ . '/../../templates/pages/about.php';
    }

    public function contact()
    {
        include __DIR__ . '/../../templates/pages/contact.php';
    }

    public function policies()
    {
        include __DIR__ . '/../../templates/pages/policies.php';
    }
}
