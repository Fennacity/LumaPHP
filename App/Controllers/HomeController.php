<?php

namespace App\Controllers;

use Luma\Templating\Template;
use Luma\Utilities\Utilities;

class HomeController implements ControllerInterface
{
    public function index() : string
    {
        return Template::render('/home/index.html.twig', [
            'project_name' => Utilities::underscoreToSpace($_ENV['PROJECT_NAME']),
            'title' => 'Welcome to the Home Page',
            'message' => 'This is the home page of our application.'
        ]);
    }
}