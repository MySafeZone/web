<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GrahamCampbell\Markdown\Facades\Markdown;

class MarkdownController extends Controller
{
    public function terms()
    {
        $title = "Terms of use";
        $markdown_content = file_get_contents(base_path('resources/markdowns/terms.md'));
        return view('markdown', compact(['markdown_content', 'title']));
    }

    public function privacy()
    {
        $title = "Privacy policy";
        $markdown_content = file_get_contents(base_path('resources/markdowns/privacy.md'));
        return view('markdown', compact(['markdown_content', 'title']));
    }
}