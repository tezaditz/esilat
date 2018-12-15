<?php

namespace App\Http\Controllers\Backend\Sas;

use App\Models\Backend\Sas\sas_sp2d;
use App\Models\Backend\Master\BagianEselon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class Sp2dController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Data = sas_sp2d::all();
        return view('backend.sp2d.index' , ['Data' => $Data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sp2d  $sp2d
     * @return \Illuminate\Http\Response
     */
    public function show(Sp2d $sp2d)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sp2d  $sp2d
     * @return \Illuminate\Http\Response
     */
    public function edit(Sp2d $sp2d)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sp2d  $sp2d
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sp2d $sp2d)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sp2d  $sp2d
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sp2d $sp2d)
    {
        //
    }

    public function upload_sp2d(Request $request)
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit',-1);

        if(Input::hasFile('import_file'))
        {
            
            $file = Input::file('import_file');
            $file_path = $file->getRealPath();
            $data = Excel::selectSheets('Worksheet')->load($file_path)->get();
            return $data;
        }
    }
}
