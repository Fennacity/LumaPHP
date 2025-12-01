<?php

namespace App\Controllers;

use Luma\Templating\Template;

class HomeController implements ControllerInterface
{
    public function index() : string
    {
        return Template::render('/home/index.html.twig', [
            'project_name' => substr_replace($_ENV['PROJECT_NAME'], ' ', 5, 1),
            'title' => 'Welcome to the Home Page',
            'message' => 'This is the home page of our application.'
        ]);
    }
}