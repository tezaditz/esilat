<?php

namespace App\Http\Controllers\Backend\Pengajuan\Perjadin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\PertanggungJawaban\DataPerjadin;
use App\Models\Backend\PertanggungJawaban\JenisBiayaPerjadin;
use App\Models\Backend\Master\Pegawai;
use App\Models\Backend\Master\Tamu;

class DetailPerjadinController extends Controller
{
    /**
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPelaksana($perjadin_id)
    {
    	$dataperjadins = DataPerjadin::where('perjadin_id', $perjadin_id)
                                     ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                     ->Paginate(10);
        $data_perjadin = DataPerjadin::where('perjadin_id', $perjadin_id)
                                     ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                     ->first();

        $jenisbiaya    = JenisBiayaPerjadin::orderBy('created_at', 'ASC')->get();

        $jenisbiaya_tamu    = JenisBiayaPerjadin::orderBy('created_at', 'ASC')->get();

        $nama_pegawai  = array();
        $nama_tamu  = array();
        foreach ($dataperjadins as $key => $value) {
            $nama_pegawai[]   = $value->nama_pelaksana;
            $nama_tamu[]   = $value->nama_pelaksana;
        }
        $pegawai   = Pegawai::whereNotIn('nama', $nama_pegawai)->orderBy('nama','asc')->get();
        $tamu   = Tamu::whereNotIn('nama', $nama_pegawai)->orderBy('nama','asc')->get();
        
    	return view('backend.pengajuan.perjadin.detailperjadin.index', ['dataperjadins' => $dataperjadins, 'perjadin_id' => $perjadin_id, 'jenisbiaya' => $jenisbiaya  , 'pegawai' =>$pegawai ,'tamu' =>$tamu , 'data_perjadin' => $data_perjadin]);
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
        $dataperjadin->keterangan     = 'perjadin-dalam-negeri';

        $dataperjadin->save();

    	\Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.store.messages.success'));

    	return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-pelaksana', $perjadin_id)->withInput();
    }

     public function store_tamu($perjadin_id, Request $request)
    {
        $nama_pelaksana = Tamu::where('id' , $request->nama_pelaksana_tamu)->first();

        $dataperjadin = new DataPerjadin();

        $dataperjadin->perjadin_id    = $perjadin_id;
        $dataperjadin->nip            = $request->nip_tamu;
        $dataperjadin->lama           = $request->hari_tamu[4];
        // return $dataperjadin->lama;
        $dataperjadin->nama_pelaksana = $nama_pelaksana->nama;
        $dataperjadin->uang_harian    = str_replace('.', '', $request->jumlah_tamu[4]);
        $dataperjadin->pesawat        = str_replace('.', '', $request->jumlah_tamu[1]);
        $dataperjadin->taksi_provinsi = str_replace('.', '', $request->jumlah_tamu[2]);
        $dataperjadin->taksi_kab_kota = str_replace('.', '', $request->jumlah_tamu[3]);
        $dataperjadin->penginapan     = str_replace('.', '', $request->jumlah_tamu[5]);
        $dataperjadin->registration   = str_replace('.', '', $request->jumlah_tamu[6]);
        $dataperjadin->keterangan     = 'perjadin-dalam-negeri';


        $dataperjadin->save();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-pelaksana', $perjadin_id)->withInput();
    }

    // public function store_tamu($perjadin_id, Request $request)
    // {
    //     $nama_pelaksana = Tamu::where('id' , $request->nama_pelaksana)->first();
    //     $dataperjadin = new DataPerjadin();

    //     // return $nama_pelaksana_tamu;
        
    //     $dataperjadin->perjadin_id    = $perjadin_id;
    //     $dataperjadin->nip            = $request->nip;
    //     $dataperjadin->lama           = $request->hari[4];
    //     $dataperjadin->nama_pelaksana = $nama_pelaksana->nama;
    //     $dataperjadin->uang_harian    = str_replace('.', '', $request->jumlah[4]);
    //     $dataperjadin->pesawat        = str_replace('.', '', $request->jumlah[1]);
    //     $dataperjadin->taksi_provinsi = str_replace('.', '', $request->jumlah[2]);
    //     $dataperjadin->taksi_kab_kota = str_replace('.', '', $request->jumlah[3]);
    //     $dataperjadin->penginapan     = str_replace('.', '', $request->jumlah[5]);
    //     $dataperjadin->registration   = str_replace('.', '', $request->jumlah[6]);
    //     $dataperjadin->keterangan     = 'perjadin-dalam-negeri';

    //     $dataperjadin->save();

    //     \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.store.messages.success'));

    //     return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-pelaksana', $perjadin_id)->withInput();
    // }

    public function destroy($id)
    {
        $detailakun = DataPerjadin::where('id', $id)->first();

        if (is_null($id)) {
            \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.destroy.messages.info'));

            return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-pelaksana', $detailakun->perjadin_id);
        }

        DataPerjadin::destroy($id);
        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.destroy.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-pelaksana', $detailakun->perjadin_id);
    }

    public function search(Request $request, $perjadin_id)
    {
        $datas = DataPerjadin::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->where('perjadin_id', '=', $perjadin_id)
            ->paginate(10);
        $total = DataPerjadin::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get()->count();

        $jenisbiaya = JenisBiayaPerjadin::orderBy('created_at', 'ASC')->get();

        return view('backend.pengajuan.perjadin.detailperjadin.index', ['datas' => $datas, 'total' => $total, 'perjadin_id' => $perjadin_id, 'jenisbiaya' => $jenisbiaya]);
    }

    public function memuatNip($id)
    {
        $uraian = Pegawai::where('id', '=', $id)->get();

        $data = [
            'uraian_data' => $uraian,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function memuatNiptamu($id)
    {
        $uraian_tamu = Tamu::where('id', '=', $id)->get();

        $data = [
            'uraian_data_tamu' => $uraian_tamu,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

}
