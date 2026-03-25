<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $section = 1;
        return view('pages.admin.client.index', compact('section'));
    }

    public function create()
    {
        $section = 2;
        return view('pages.admin.client.index', compact('section'));
    }

    public function edit($id)
    {
        $section = 3;
        return view('pages.admin.client.index', compact('section', 'id'));
    }
}
