<?php

namespace App\Controllers;

use Luma\Templating\Template;

class TestController implements ControllerInterface
{
    public function index() : string
    {
        return Template::render('/test/index.html.twig', [
            'title' => 'Welcome to the Test Page',
            'message' => 'This is the test page of our application.'
        ]);
    }
}