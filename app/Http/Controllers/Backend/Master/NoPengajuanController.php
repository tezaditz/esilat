<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Bagian;
use App\Models\Backend\Master\NoPengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no_pengajuans = NoPengajuan::orderBy('created_at', 'desc')->paginate(10);
        $bagians       = Bagian::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.nopengajuan.index', ['no_pengajuans' => $no_pengajuans, 'bagians' => $bagians]);
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
        $validator = \Validator::make($request->all(), NoPengajuan::rules());

        if($validator->fails())
        {
            return redirect()->route('master.no-pengajuan.index')->withErrors($validator)->withInput();
        }

        $no_pengajuan = new NoPengajuan();

        $no_pengajuan->bagian_id      = $request->bagian_id;
        $no_pengajuan->nomor          = $request->nomor;
        $no_pengajuan->jenis          = $request->jenis;
        $no_pengajuan->kode_transaksi = $request->kode_transaksi;

        $no_pengajuan->save();

        \Session::flash('success', trans('backend/master/nopengajuan.no_pengajuan.store.messages.success'));

        return redirect()->route('master.no-pengajuan.index')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $no_pengajuans = NoPengajuan::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.nopengajuan.index', ['no_pengajuans' => $no_pengajuans]);
    }
}
