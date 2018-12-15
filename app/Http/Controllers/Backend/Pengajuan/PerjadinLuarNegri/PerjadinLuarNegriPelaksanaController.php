<?php

namespace App\Http\Controllers\Backend\Pengajuan\PerjadinLuarNegri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\PertanggungJawaban\DataPerjadin;
use App\Models\Backend\PertanggungJawaban\JenisBiayaPerjadin;
use App\Models\Backend\Master\Pegawai;
use App\Models\Backend\Master\Eselon;
use App\Models\Backend\Master\Negara;
use App\Models\Backend\Parameter;
use App\Models\User;
use App\Models\Backend\Master\BagianEselon;
use App\Models\Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegri;
use App\Models\Backend\Master\PlnClass;
use App\Models\Backend\Master\PlnUh;
use Carbon\Carbon;

class PerjadinLuarNegriPelaksanaController extends Controller
{
    //
    /**
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPelaksana($perjadin_id)
    {
        $dataperjadins = DataPerjadin::where('perjadin_id', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->Paginate(10);
        $dataperjadin = DataPerjadin::where('perjadin_id', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->first();
        $jenisbiaya    = JenisBiayaPerjadin::orderBy('created_at', 'ASC')->get();
        
        $nama_pegawai  = array();
        foreach ($dataperjadins as $key => $value) {
            $nama_pegawai[]   = $value->nama_pelaksana;
        }
        $pegawai   = Pegawai::whereNotIn('nama', $nama_pegawai)->orderBy('nama','asc')->get();

        $master = PerjadinLuarNegri::where('id' , $perjadin_id)->get();
        $nama_satker = Eselon::all();
        $kelasbiaya = PlnClass::all();
        $namanegara = negara::where('id' , $master[0]['negara_id'])->get();
        $Parameter  = Parameter::where('name' , 'percen_uh')->get();
        $a = explode(";", $Parameter[0]['value']);
        $tglawal = new Carbon($master[0]['tgl_awal']);
        $tglakhir = new Carbon($master[0]['tgl_akhir']);
        $lama = $tglawal->diffInDays($tglakhir) + 1;

        

        return view('backend.pengajuan.perjadinluarnegri.pelaksanaperjadin.index', ['dataperjadins' => $dataperjadins, 'perjadin_id' => $perjadin_id, 'jenisbiaya' => $jenisbiaya, 'pegawai' => $pegawai, 'dataperjadin' => $dataperjadin , 'nilai_kurs'=>$master[0]['nilai_kurs'] , 'eselon'=>$nama_satker , 'kelas'=>$kelasbiaya , 'negara'=>$namanegara[0]['nama_negara'], 'negaraid'=>$master[0]['negara_id'] , 'parameter'=>$a , 'lama'=>$lama]);
    }

    public function store($perjadin_id, Request $request)
    {
        $nama_pelaksana = Pegawai::where('id' , $request->nama_pelaksana)->first();
        $dataperjadin = new DataPerjadin();

        $dataperjadin->perjadin_id    = $perjadin_id;
        $dataperjadin->nip            = $request->nip;
        $dataperjadin->lama           = $request->hari[4];
        $dataperjadin->nama_pelaksana = $nama_pelaksana->nama;
        $dataperjadin->uang_harian    = str_replace('.', '', $request->jumlah[4]);
        $dataperjadin->pesawat        = str_replace('.', '', $request->jumlah[1]);
        $dataperjadin->taksi_provinsi = str_replace('.', '', $request->jumlah[2]);
        $dataperjadin->taksi_kab_kota = str_replace('.', '', $request->jumlah[3]);
        $dataperjadin->penginapan     = str_replace('.', '', $request->jumlah[5]);
        $dataperjadin->registration   = str_replace('.', '', $request->jumlah[6]);
        $dataperjadin->keterangan	  = 'perjadin-luar-negeri';

        $dataperjadin->save();

    	\Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.store.messages.success'));

    	return redirect()->route('pengajuan.perjadin-luar-negeri.detail-pelaksana', $perjadin_id)->withInput();
    }

    public function destroy($id)
    {
        $detailakun = DataPerjadin::where('id', $id)->first();

        if (is_null($id)) {
            \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.destroy.messages.info'));

            return redirect()->route('pengajuan.perjadin-luar-negeri.detail-pelaksana', $detailakun->perjadin_id);
        }

        DataPerjadin::destroy($id);
        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.destroy.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.detail-pelaksana', $detailakun->perjadin_id);
    }

    public function search(Request $request, $perjadin_id)
    {
        $dataperjadins = DataPerjadin::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->where('perjadin_id', '=', $perjadin_id)
            ->paginate(10);
        $total = DataPerjadin::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get()->count();

        $jenisbiaya = JenisBiayaPerjadin::orderBy('created_at', 'ASC')->get();

        $pegawai       = Pegawai::orderBy('nama' , 'ASC')->get();

        return view('backend.pengajuan.perjadinluarnegri.pelaksanaperjadin.index', ['dataperjadins' => $dataperjadins, 'total' => $total, 'perjadin_id' => $perjadin_id, 'jenisbiaya' => $jenisbiaya, 'pegawai' => $pegawai]);
    }

    public function memuatNip($id)
    {
        $uraian = Pegawai::where('id', '=', $id)->get();

        $data = [
            'uraian_data' => $uraian,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function memuatPegawai($eselonId)
    {
        $bagianeselon = BagianEselon::where('eselon_id' , $eselonId)->get();
        

        $bagian_id = [];
        foreach ($bagianeselon as $key => $value) {
            $bagian_id[$key] = $value->bagian_id;
        }

        $user= pegawai::whereIn('bagian_id' , $bagian_id)
                ->orderBy('nama' , 'ASC')->get();
        return $user;

        
    }

    public function memuatkelasbiaya($idkelas , $idnegara)
    {
        $data = PlnUh::where('negara_id' , $idnegara)
                        ->where('class_id' , $idkelas)
                        ->get();

        if(Count($data))
        {
            return $data[0]['nilai'];
        }
        else
        {
            $data = 0;
            return $data;
        }


    }


}
