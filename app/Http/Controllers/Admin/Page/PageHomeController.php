<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageHomeController extends Controller
{
    public function index()
    {
        $section = 1;
        return view('pages.admin.pages.home', compact('section'));
    }

    public function show()
    {
        $section = 2;
        return view('pages.admin.pages.home', compact('section'));
    }

    public function catalog()
    {
        $section = 3;
        return view('pages.admin.pages.home', compact('section'));
    }

    public function galery()
    {
        $section = 4;
        return view('pages.admin.pages.home', compact('section'));
    }

    public function footer()
    {
        $section = 5;
        return view('pages.admin.pages.home', compact('section'));
    }
}
