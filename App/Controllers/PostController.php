<?php

namespace App\Controllers;

use Framework\Templating\Template;

class PostController implements ControllerInterface
{
    public function index() : string
    {
        return Template::render('/post/index.html.twig', [
            'title' => 'Welcome to the Post Page',
            'message' => 'This is the post page of our application.'
        ]);
    }

    public function show(int $id) : string
    {
        return Template::render('/post/show.html.twig', [
            'title' => 'Post Details',
            'message' => "Details for post with ID: $id"
        ]);
    }
}