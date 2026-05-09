<?php

namespace App\Http\Controllers\Admin\Billing;

use App\Http\Controllers\Controller;

class FacturasSolicitadasController extends Controller
{
    public function index()
    {
        return view('pages.admin.billing.facturas-solicitadas');
    }
}
