<?php

namespace App\Controllers;

use Luma\Templating\Template;
use Luma\Utilities\Utilities;

class AboutController extends Controller
{
    public function index() : string
    {
        return Template::render('/about/index.html.twig', [
            'project_name' => Utilities::underscoreToSpace($_ENV['PROJECT_NAME'] ?? 'LumaPHP_Application'),
            'page_title' => Utilities::getCurrentControllerName(__FILE__),
        ]);
    }
}