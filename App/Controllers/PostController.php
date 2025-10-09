<?php

namespace App\Controllers;

use Luma\Templating\Template;
use Luma\API\API;

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
        return API::call("localhost", "GET", ["id" => $id]);
        // return Template::render('/post/show.html.twig', [
        //     'title' => 'Post Details',
        //     'message' => "Details for post with ID: $id"
        // ]);
    }
}