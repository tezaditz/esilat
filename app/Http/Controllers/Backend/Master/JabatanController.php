<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    //
    public function index()
    {
        $jabatans = Jabatan::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.jabatan.index', ['jabatans' => $jabatans]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Jabatan::rules());

        if($validator->fails())
        {
            return redirect()->route('master.jabatan.index')->withErrors($validator)->withInput();
        }

        $jabatan = new Jabatan();

        $jabatan->name      = $request->name;

        $jabatan->save();

        \Session::flash('success', trans('backend/master/jabatan.jabatan.store.messages.success'));

        return redirect()->route('master.jabatan.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Jabatan::rules());

        if($validator->fails())
        {
            return redirect()->route('master.jabatan.index')->withErrors($validator)->withInput();
        }

        $jabatan = Jabatan::find($id);

        $jabatan->name      = $request->name;

        $jabatan->save();

        \Session::flash('success', trans('backend/master/jabatan.jabatan.update.messages.success'));

        return redirect()->route('master.jabatan.index')->withInput();
    }

    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/jabatan.jabatan.destroy.messages.info'));

            return redirect()->route('master.jabatan.index');
        }

        Jabatan::destroy($id);
        \Session::flash('success', trans('backend/master/jabatan.jabatan.destroy.messages.success'));

        return redirect()->route('master.jabatan.index');
    }

    public function search(Request $request)
    {
        $jabatans = Jabatan::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.jabatan.index', ['jabatans' => $jabatans]);
    }    

}
