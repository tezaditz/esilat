<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\MetodeBayar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetodeBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodebayars = MetodeBayar::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.metodebayar.index', ['metodebayars' => $metodebayars]);
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
        $validator = \Validator::make($request->all(), MetodeBayar::rules());

        if($validator->fails())
        {
            return redirect()->route('master.metodebayar.index')->withErrors($validator)->withInput();
        }

        $metodebayar = new MetodeBayar();

        $metodebayar->kode         = $request->kode;
        $metodebayar->metode_bayar = $request->metode_bayar;

        $metodebayar->save();

        \Session::flash('success', trans('backend/master/metodebayar.metode_bayar.store.messages.success'));

        return redirect()->route('master.metodebayar.index')->withInput();
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
        $validator = \Validator::make($request->all(), MetodeBayar::rules());

        if($validator->fails())
        {
            return redirect()->route('master.metodebayar.index')->withErrors($validator)->withInput();
        }

        $metodebayar = MetodeBayar::find($id);

        $metodebayar->kode         = $request->kode;
        $metodebayar->metode_bayar = $request->metode_bayar;

        $metodebayar->save();

        \Session::flash('success', trans('backend/master/metodebayar.metode_bayar.update.messages.success'));

        return redirect()->route('master.metodebayar.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/metodebayar.metode_bayar.destroy.messages.info'));

            return redirect()->route('master.metodebayar.index');
        }

        MetodeBayar::destroy($id);
        \Session::flash('success', trans('backend/master/metodebayar.metode_bayar.destroy.messages.success'));

        return redirect()->route('master.metodebayar.index');
    }

    public function search(Request $request)
    {
        $metodebayars = MetodeBayar::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.metodebayar.index', ['metodebayars' => $metodebayars]);
    }
}
