<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Pimpinan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Master\bagian;

class PimpinanController extends Controller
{
    //
    public function index()
    {
        $pimpinans = Pimpinan::orderBy('created_at', 'desc')->paginate(10);
        $bagians    = Bagian::all();

        return view('backend.master.pimpinan.index', ['pimpinans' => $pimpinans], ['bagians' => $bagians]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Pimpinan::rules());

        if($validator->fails())
        {
            return redirect()->route('master.jabatan.index')->withErrors($validator)->withInput();
        }

        $pimpinan = new Pimpinan();

        $pimpinan->bagian_id      = $request->bagian_id;

        $pimpinan->nip            = $request->nip;
        
        $pimpinan->nama           = $request->nama;

        $pimpinan->jabatan        = $request->jabatan;


        $pimpinan->save();

        \Session::flash('success', trans('backend/master/pimpinan.pimpinan.store.messages.success'));

        return redirect()->route('master.pimpinan.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Pimpinan::rules());

        if($validator->fails())
        {
            return redirect()->route('master.pimpinan.index')->withErrors($validator)->withInput();
        }

        $pimpinan = Pimpinan::find($id);

        $pimpinan->nama      = $request->nama;
        
        $pimpinan->nip      = $request->nip;
        
        $pimpinan->jabatan      = $request->jabatan;

        $pimpinan->save();

        \Session::flash('success', trans('backend/master/pimpinan.pimpinan.update.messages.success'));

        return redirect()->route('master.pimpinan.index')->withInput();
    }

    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/pimpinan.pimpinan.destroy.messages.info'));

            return redirect()->route('master.pimpinan.index');
        }

        Pimpinan::destroy($id);
        \Session::flash('success', trans('backend/master/pimpinan.pimpinan.destroy.messages.success'));

        return redirect()->route('master.pimpinan.index');
    }

    public function search(Request $request)
    {
        $bagians    = Bagian::all();
        $pimpinans = Pimpinan::orderBy('pimpinan.created_at', 'desc')
            ->join('bagian', 'bagian.id', '=', 'pimpinan.bagian_id')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.pimpinan.index', ['pimpinans' => $pimpinans] , ['bagians' => $bagians]);
    }    

}
