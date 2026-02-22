<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerHomeControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = 1;
        return view('pages.admin.pages.home.banner', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $section = 2;
        return view('pages.admin.pages.home.banner', compact('section'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = 3;
        return view('pages.admin.pages.home.banner', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = 4;
        return view('pages.admin.pages.home.banner', compact('section'));
    }
}
