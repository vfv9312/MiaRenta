<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    //
    public function home()
    {
        $section = 1;
        return view('pages.dashboard', compact('section'));
    }

    public function ubicanos()
    {
        $section = 2;
        return view('pages.dashboard', compact('section'));
    }
    public function lista()
    {
        $section = 3;
        return view('pages.dashboard', compact('section'));
    }
    public function orden()
    {
        $section = 4;
        return view('pages.dashboard', compact('section'));
    }
}
