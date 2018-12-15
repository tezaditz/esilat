<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    //

    public function index()
    {
        $statuss = Status::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.status.index', ['statuss' => $statuss]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Status::rules());

        if($validator->fails())
        {
            return redirect()->route('master.status.index')->withErrors($validator)->withInput();
        }

        $status = new Status();

        $status->kode_status      	 = $request->kode_status;

        $status->keterangan     	 = $request->keterangan;

        $status->posisi_dokumen      = $request->posisi_dokumen;

        $status->modul     			 = $request->modul;

        $status->kode_realisasi      = $request->kode_realisasi;

        $status->save();

        \Session::flash('success', trans('backend/master/status.status.store.messages.success'));

        return redirect()->route('master.status.index')->withInput();
    }


        public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Status::rules());

        if($validator->fails())
        {
            return redirect()->route('master.status.index')->withErrors($validator)->withInput();
        }

        $status = Status::find($id);

        $status->kode_status      	 = $request->kode_status;

        $status->keterangan     	 = $request->keterangan;

        $status->posisi_dokumen      = $request->posisi_dokumen;

        $status->modul     			 = $request->modul;

        $status->kode_realisasi      = $request->kode_realisasi;

        $status->save();

        \Session::flash('success', trans('backend/master/status.status.update.messages.success'));

        return redirect()->route('master.status.index')->withInput();
    }

    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/status.status.destroy.messages.info'));

            return redirect()->route('master.status.index');
        }

        Status::destroy($id);
        \Session::flash('success', trans('backend/master/status.status.destroy.messages.success'));

        return redirect()->route('master.status.index');
    }

    public function search(Request $request)
    {
        $statuss = Status::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.status.index', ['statuss' => $statuss]);
    }  

}
