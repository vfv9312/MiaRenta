<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageUsController extends Controller
{

    public function index()
    {
        $section = 1;
        return view('pages.admin.pages.us', compact('section'));
    }
}
