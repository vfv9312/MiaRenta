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

    public function create(Request $request)
    {
        $section = 2;
        return view('pages.admin.pages.us', compact('section'));
    }

    public function edit(Request $request, $id)
    {
        $section = 3;
        return view('pages.admin.pages.us', compact('section'));
    }
}
