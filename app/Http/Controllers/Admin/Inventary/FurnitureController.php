<?php

namespace App\Http\Controllers\Admin\Inventary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    //
    public function colors()
    {
        $section = 1;
        return view('pages.admin.inventary.furniture', compact('section'));
    }
    public function categories()
    {
        $section = 4;
        return view('pages.admin.inventary.furniture', compact('section'));
    }
    public function types()
    {
        $section = 2;
        return view('pages.admin.inventary.furniture', compact('section'));
    }
    public function products()
    {
        $section = 3;
        return view('pages.admin.inventary.furniture', compact('section'));
    }
    public function images()
    {
        $section = 5;
        return view('pages.admin.inventary.furniture', compact('section'));
    }
    public function repairs()
    {
        $section = 6;
        return view('pages.admin.inventary.furniture', compact('section'));
    }
}
