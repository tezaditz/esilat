<?php

namespace App\Http\Controllers\Backend\Monitoring;

use App\Models\Backend\Master\Rkakl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RealisasiAnggaranController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rkakls = Rkakl::where('tahun', '=', date('Y'))->get();
        return view('backend.monitoring.realisasianggaran.index', ['rkakls' => $rkakls]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $rkakls = Rkakl::where('tahun', '=', date('Y'))
            ->where($request->options, 'like', '%' . $request->search . '%')
            ->get();

        return view('backend.monitoring.realisasianggaran.index', ['rkakls' => $rkakls]);
    }
}
