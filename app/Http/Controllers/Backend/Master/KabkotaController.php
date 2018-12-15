<?php

namespace App\Http\Controllers\Backend\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Master\KabKota;
use App\Models\Backend\Master\Provinsi;

class KabkotaController extends Controller
{
    //
    public function index()
    {
    	$kabkotas = KabKota::orderBy('created_at', 'desc')->paginate(50);
        $provinsis = Provinsi::orderBy('created_at', 'desc')->get();

        return view('backend.master.kabkota.index', ['provinsis' => $provinsis, 'kabkotas' => $kabkotas]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), KabKota::rules());

        if($validator->fails())
        {
            return redirect()->route('master.kabkota.index')->withErrors($validator)->withInput();
        }

        $kabkota = new KabKota();

        $kabkota->provinsi_id = $request->provinsi_id;
        $kabkota->nama 	   = $request->nama;

        $kabkota->save();

        \Session::flash('success', trans('backend/master/kabkota.kabkota.store.messages.success'));

        return redirect()->route('master.kabkota.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), KabKota::rules());

        if($validator->fails())
        {
            return redirect()->route('master.kabkota.index')->withErrors($validator)->withInput();
        }

        $kabkota = KabKota::find($id);

        $kabkota->provinsi_id = $request->provinsi_id;
        $kabkota->nama = $request->nama;

        $kabkota->save();

        \Session::flash('success', trans('backend/master/kabkota.kabkota.update.messages.success'));

        return redirect()->route('master.kabkota.index')->withInput();
    }

    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/kabkota.kabkota.destroy.messages.info'));

            return redirect()->route('master.kabkota.index');
        }

        KabKota::destroy($id);
        \Session::flash('success', trans('backend/master/kabkota.kabkota.destroy.messages.success'));

        return redirect()->route('master.kabkota.index');
    }

    public function search(Request $request)
    {
        $kabkotas = KabKota::orderBy('kabkota.provinsi_id', 'desc')
            ->join('provinsi', 'provinsi.id', '=', 'kabkota.provinsi_id')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(50);

        $provinsis = Provinsi::all();

        return view('backend.master.kabkota.index', ['kabkotas' => $kabkotas, 'provinsis' => $provinsis ]);
    }


}
