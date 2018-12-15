<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Tamu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TamuController extends Controller
{
    public function index()
    {
        $tamu = Tamu::orderBy('created_at', 'desc')->paginate(10);
        

        return view('backend.master.tamu.index', ['tamus'=> $tamu ]);
    }

   public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Tamu::rules());

        if($validator->fails())
        {
            return redirect()->route('master.tamu.index')->withErrors($validator)->withInput();
        }

        $tamu = new Tamu();

        $tamu->nama         = $request->nama;

        $tamu->nip          = $request->nip;

        $tamu->instansi     = $request->instansi;

        $tamu->jabatan      = $request->jabatan;


        $tamu->save();

        \Session::flash('success', trans('backend/master/tamu.tamu.store.messages.success'));

        return redirect()->route('master.tamu.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Tamu::rules());

        if($validator->fails())
        {
            return redirect()->route('master.tamu.index')->withErrors($validator)->withInput();
        }

        $tamu = Tamu::find($id);

        $tamu->nama             = $request->nama;

        $tamu->nip              = $request->nip;

        $tamu->instansi         = $request->instansi;

        $tamu->jabatan          = $request->jabatan;

        $tamu->save();

        \Session::flash('success', trans('backend/master/tamu.tamu.update.messages.success'));

        return redirect()->route('master.tamu.index')->withInput();
    }
 
    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/tamu.tamu.destroy.messages.info'));

            return redirect()->route('master.tamu.index');
        }

        Tamu::destroy($id);
        \Session::flash('success', trans('backend/master/tamu.tamu.destroy.messages.success'));

        return redirect()->route('master.tamu.index');
    }

    public function search(Request $request)
    {
        $tamu = Tamu::orderBy('tamu.nama', 'desc')
        // ->join('pangkat', 'pangkat.id', '=', 'pegawai.pangkat_id')
        //     ->join('jabatan', 'jabatan.id', '=', 'pegawai.jabatan_id')
        //     ->join('bagian', 'bagian.id', '=', 'pegawai.bagian_id')
            ->where($request->options, 'like', '%' . $request->search . '%');

        return view('backend.master.tamu.index', ['tamu' => $tamu]);
    } 
}
