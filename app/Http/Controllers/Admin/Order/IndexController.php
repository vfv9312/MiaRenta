<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $section = 1;
        return view('pages.admin.order.index', compact('section'));
    }

    public function ordenes(Request $request)
    {
        $section = 2;
        return view('pages.admin.order.index', compact('section'));
    }

    public function estadisticas(Request $request)
    {
        $section = 3;
        return view('pages.admin.order.index', compact('section'));
    }
}
