<?php

namespace App\Controllers;

use Framework\Templating\Template;

class HomeController extends Controller
{
    public function index()
    {
        return Template::render('home/index.html.twig', [
            'title' => 'Welcome to the Home Page',
            'message' => 'This is the home page of our application.'
        ]);
    }
}