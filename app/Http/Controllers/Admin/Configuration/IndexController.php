<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
        $section = 1;
        return view('pages.admin.configuration.index', compact('section'));
    }

    public function colonias()
    {
        $section = 2;
        return view('pages.admin.configuration.index', compact('section'));
    }

    public function metodosPago()
    {
        $section = 3;
        return view('pages.admin.configuration.index', compact('section'));
    }

    public function usuarios()
    {
        $section = 4;
        return view('pages.admin.configuration.index', compact('section'));
    }
}
