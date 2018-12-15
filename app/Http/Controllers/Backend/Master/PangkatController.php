<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Pangkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PangkatController extends Controller
{
    //

    public function index()
    {
        $pangkats = Pangkat::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.pangkat.index', ['pangkats' => $pangkats]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Pangkat::rules());

        if($validator->fails())
        {
            return redirect()->route('master.pangkat.index')->withErrors($validator)->withInput();
        }

        $pangkat = new Pangkat();

        $pangkat->pangkat      = $request->pangkat;

        $pangkat->golongan     = $request->golongan;

        $pangkat->save();

        \Session::flash('success', trans('backend/master/pangkat.pangkat.store.messages.success'));

        return redirect()->route('master.pangkat.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Pangkat::rules());

        if($validator->fails())
        {
            return redirect()->route('master.pangkat.index')->withErrors($validator)->withInput();
        }

        $pangkat = Pangkat::find($id);

        $pangkat->pangkat      = $request->pangkat;

        $pangkat->golongan     = $request->golongan;

        $pangkat->save();

        \Session::flash('success', trans('backend/master/pangkat.pangkat.update.messages.success'));

        return redirect()->route('master.pangkat.index')->withInput();
    }

    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/pangkat.pangkat.destroy.messages.info'));

            return redirect()->route('master.pangkat.index');
        }

        Pangkat::destroy($id);
        \Session::flash('success', trans('backend/master/pangkat.pangkat.destroy.messages.success'));

        return redirect()->route('master.pangkat.index');
    }

    public function search(Request $request)
    {
        $pangkats = Pangkat::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.pangkat.index', ['pangkats' => $pangkats]);
    }    

}
