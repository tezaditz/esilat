<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Provinsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsis = Provinsi::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.provinsi.index', ['provinsis' => $provinsis]);
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
        $validator = \Validator::make($request->all(), Provinsi::rules());

        if($validator->fails())
        {
            return redirect()->route('master.provinsi.index')->withErrors($validator)->withInput();
        }

        $provinsi = new Provinsi();

        $provinsi->title = $request->title;

        $provinsi->save();

        \Session::flash('success', trans('backend/master/provinsi.provinsi.store.messages.success'));

        return redirect()->route('master.provinsi.index')->withInput();
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
        $validator = \Validator::make($request->all(), Provinsi::rules());

        if($validator->fails())
        {
            return redirect()->route('master.provinsi.index')->withErrors($validator)->withInput();
        }

        $provinsi = Provinsi::find($id);

        $provinsi->title = $request->title;

        $provinsi->save();

        \Session::flash('success', trans('backend/master/provinsi.provinsi.update.messages.success'));

        return redirect()->route('master.provinsi.index')->withInput();
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
            \Session::flash('info', trans('backend/master/provinsi.provinsi.destroy.messages.info'));

            return redirect()->route('master.provinsi.index');
        }

        Provinsi::destroy($id);
        \Session::flash('success', trans('backend/master/provinsi.provinsi.destroy.messages.success'));

        return redirect()->route('master.provinsi.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $provinsis = Provinsi::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.provinsi.index', ['provinsis' => $provinsis]);
    }
}
