<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Eselon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EselonController extends Controller
{
    //
    public function index()
    {
        $eselons = Eselon::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.eselon.index', ['eselons' => $eselons]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Eselon::rules());

        if($validator->fails())
        {
            return redirect()->route('master.eselon.index')->withErrors($validator)->withInput();
        }

        $eselon = new Eselon();

        $eselon->title      = $request->title;

        $eselon->save();

        \Session::flash('success', trans('backend/master/eselon.eselon.store.messages.success'));

        return redirect()->route('master.eselon.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Eselon::rules());

        if($validator->fails())
        {
            return redirect()->route('master.eselon.index')->withErrors($validator)->withInput();
        }

        $eselon = Eselon::find($id);

        $eselon->title      = $request->title;

        $eselon->save();

        \Session::flash('success', trans('backend/master/eselon.eselon.update.messages.success'));

        return redirect()->route('master.eselon.index')->withInput();
    }

    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/eselon.eselon.destroy.messages.info'));

            return redirect()->route('master.eselon.index');
        }

        Eselon::destroy($id);
        \Session::flash('success', trans('backend/master/eselon.eselon.destroy.messages.success'));

        return redirect()->route('master.eselon.index');
    }

    public function search(Request $request)
    {
        $eselons = Eselon::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.eselon.index', ['eselons' => $eselons]);
    }  

}
