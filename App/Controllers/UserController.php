<?php

namespace App\Controllers;

use Luma\Templating\Template;
use Luma\Utilities\Utilities;

class UserController extends Controller
{
    public function index(int $id) : string
    {
        return Template::render('/'. strtolower(Utilities::getCurrentControllerName(__FILE__)) .'/index.html.twig', [
            'project_name' => Utilities::underscoreToSpace($_ENV['PROJECT_NAME'] ?? 'LumaPHP_Application'),
            'page_title' => Utilities::getCurrentControllerName(__FILE__),
            'id' => $id,
        ]);
    }
}