<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) return redirect()->route('login');
        $section = 1;
        return view('pages.admin.dashboard', compact('section'));
    }
}
