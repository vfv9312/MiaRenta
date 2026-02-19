<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageFacturaController extends Controller
{
    public function index()
    {
        $section = 1;
        return view('pages.admin.pages.factura', compact('section'));
    }
    public function create()
    {
        $section = 2;
        return view('pages.admin.pages.factura', compact('section'));
    }
    public function edit($id)
    {
        $section = 3;
        return view('pages.admin.pages.factura', compact('section'));
    }
}
