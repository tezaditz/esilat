<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Pengadaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengadaanController extends Controller
{
    //
	public function index()
	{

		$pengadaans = Pengadaan::orderBy('created_at', 'desc')->paginate(10);
		$rkakls = Rkakl::all();

	    return view('backend.master.pengadaan.index', ['rkakls' => $rkakls, 'pengadaans' => $pengadaans]);
	}
}
