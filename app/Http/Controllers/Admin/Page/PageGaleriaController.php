<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageGaleriaController extends Controller
{
    public function index()
    {
        $section = 1;
        return view('pages.admin.pages.galeria', compact('section'));
    }

    public function create()
    {
        $section = 2;
        return view('pages.admin.pages.galeria', compact('section'));
    }

    public function edit()
    {
        $section = 3;
        return view('pages.admin.pages.galeria', compact('section'));
    }
}
