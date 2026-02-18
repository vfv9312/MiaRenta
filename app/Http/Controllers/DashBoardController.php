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
    public function nosotros()
    {
        $section = 5;
        return view('pages.dashboard', compact('section'));
    }
    public function politica()
    {
        $section = 6;
        return view('pages.dashboard', compact('section'));
    }
    public function reclamacion()
    {
        $section = 7;
        return view('pages.dashboard', compact('section'));
    }
    public function factura()
    {
        $section = 8;
        return view('pages.dashboard', compact('section'));
    }
    public function noencontrado()
    {
        $section = 0;
        return view('pages.dashboard', compact('section'));
    }
}
