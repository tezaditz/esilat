<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Jabatan;
use App\Models\Backend\Master\Pangkat;
use App\Models\Backend\Master\Pegawai;
use App\Models\Backend\Master\Bagian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    //
    public function index()
    {
        $pegawais = Pegawai::orderBy('created_at', 'desc')->paginate(10);
        $pangkats    = Pangkat::all();
        $jabatans    = Jabatan::all();
        $bagians    = Bagian::all();

        return view('backend.master.pegawai.index', ['pegawais' => $pegawais, 'pangkats' => $pangkats, 'jabatans' => $jabatans, 'bagians' => $bagians  ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Pegawai::rules());

        if($validator->fails())
        {
            return redirect()->route('master.pegawai.index')->withErrors($validator)->withInput();
        }

        $pegawai = new Pegawai();

        $pegawai->nama           = $request->nama;

        $pegawai->tempat_lahir         = $request->tempat_lahir;

        $pegawai->tgl_lahir      = $request->tgl_lahir;

        $pegawai->nip       = $request->nip;

        $pegawai->pangkat_id     = $request->pangkat_id;

        $pegawai->jabatan_id     = $request->jabatan_id;

        $pegawai->bagian_id      = $request->bagian_id;

        $pegawai->alamat          = $request->alamat;

        $pegawai->save();

        \Session::flash('success', trans('backend/master/pegawai.pegawai.store.messages.success'));

        return redirect()->route('master.pegawai.index')->withInput();
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Pegawai::rules());

        if($validator->fails())
        {
            return redirect()->route('master.pegawai.index')->withErrors($validator)->withInput();
        }

        $pegawai = Pegawai::find($id);

        $pegawai->nama           = $request->nama;

        $pegawai->tempat_lahir         = $request->tempat_lahir;

        $pegawai->tgl_lahir      = $request->tgl_lahir;

        $pegawai->nip       = $request->nip;

        $pegawai->pangkat_id     = $request->pangkat_id;

        $pegawai->jabatan_id     = $request->jabatan_id;

        $pegawai->bagian_id      = $request->bagian_id;

        $pegawai->alamat          = $request->alamat;

        $pegawai->save();

        \Session::flash('success', trans('backend/master/pegawai.pegawai.update.messages.success'));

        return redirect()->route('master.pegawai.index')->withInput();
    }
 
     public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/pegawai.pegawai.destroy.messages.info'));

            return redirect()->route('master.pegawai.index');
        }

        Pegawai::destroy($id);
        \Session::flash('success', trans('backend/master/pegawai.pegawai.destroy.messages.success'));

        return redirect()->route('master.pegawai.index');
    }

    public function search(Request $request)
    {
        $pegawais = Pegawai::orderBy('pegawai.created_at', 'desc')
            ->join('pangkat', 'pangkat.id', '=', 'pegawai.pangkat_id')
            ->join('jabatan', 'jabatan.id', '=', 'pegawai.jabatan_id')
            ->join('bagian', 'bagian.id', '=', 'pegawai.bagian_id')
            ->where($request->options, 'like', '%' . $request->search . '%')
            ->paginate(10);
        $pangkats    = Pangkat::all();
        $jabatans    = Jabatan::all();
        $bagians    = Bagian::all();

        return view('backend.master.pegawai.index', ['pegawais' => $pegawais, 'pangkats' => $pangkats, 'jabatans' => $jabatans, 'bagians' => $bagians  ]);
    } 

}
