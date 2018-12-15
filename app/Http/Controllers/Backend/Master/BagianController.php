<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Bagian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BagianController extends Controller
{
    //
    public function index()
    {
        $bagians = Bagian::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.bagian.index', ['bagians' => $bagians]);
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Bagian::rules());

        if($validator->fails())
        {
            return redirect()->route('master.bagian.index')->withErrors($validator)->withInput();
        }

        $bagian = new Bagian();

        $bagian->nama_bagian      = $request->nama_bagian;

        $bagian->kode      = $request->kode;

        $bagian->save();

        \Session::flash('success', trans('backend/master/bagian.bagian.store.messages.success'));

        return redirect()->route('master.bagian.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Bagian::rules());

        if($validator->fails())
        {
            return redirect()->route('master.bagian.index')->withErrors($validator)->withInput();
        }

        $bagian = Bagian::find($id);

        $bagian->nama_bagian      = $request->nama_bagian;

        $bagian->kode      = $request->kode;

        $bagian->save();

        \Session::flash('success', trans('backend/master/bagian.bagian.update.messages.success'));

        return redirect()->route('master.bagian.index')->withInput();
    }


    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/bagian.bagian.destroy.messages.info'));

            return redirect()->route('master.bagian.index');
        }

        Bagian::destroy($id);
        \Session::flash('success', trans('backend/master/bagian.bagian.destroy.messages.success'));

        return redirect()->route('master.bagian.index');
    }

    public function search(Request $request)
    {
        $bagians = Bagian::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.bagian.index', ['bagians' => $bagians]);
    }  


}
