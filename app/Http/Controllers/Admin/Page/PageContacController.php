<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageContacController extends Controller
{
    public function index()
    {
        $section = 1;
        return view('pages.admin.pages.contact', compact('section'));
    }
    public function create()
    {
        $section = 2;
        return view('pages.admin.pages.contact', compact('section'));
    }
    public function edit($id)
    {
        $section = 2;
        return view('pages.admin.pages.contact', compact('section'));
    }
}
