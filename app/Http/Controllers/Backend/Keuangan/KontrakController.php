<?php

namespace App\Http\Controllers\Backend\Keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KontrakController extends Controller
{
    public function index()
    {

    	return view('backend.keuangan.kontrak.index');
    }
}
