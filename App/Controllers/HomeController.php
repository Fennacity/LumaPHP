<?php

namespace App\Controllers;

use Luma\Templating\Template;

class HomeController implements ControllerInterface
{
    public function index() : string
    {
        return Template::render('/home/index.html.twig', [
            'title' => 'Welcome to the Home Page',
            'message' => 'This is the home page of our application.'
        ]);
    }
}