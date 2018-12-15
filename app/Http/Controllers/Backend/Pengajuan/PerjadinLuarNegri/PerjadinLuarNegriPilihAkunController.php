<?php

namespace App\Http\Controllers\Backend\Pengajuan\PerjadinLuarNegri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Status;
use App\Models\Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegri;
use App\Models\Backend\Pengajuan\Perjadin\PerjadinAkun;

class PerjadinLuarNegriPilihAkunController extends Controller
{
    //
    /**
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listAkun($perjadin_id)
    {
    	$dataperjadin = PerjadinLuarNegri::where('id', '=', $perjadin_id)->first();
        $rkakls = Rkakl::where('no_mak_sys', 'LIKE', '%' . $dataperjadin->no_mak . '%')
            ->where('level' , 11)
            ->where(function ($q) {
                $q->Where('no_mak_sys', 'LIKE', '%524211%')
                    ->Orwhere('no_mak_sys', 'LIKE', '%524219%');
            })
            ->get();



            

        if (count($rkakls) == 0) {
            \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.store.messages.info'));

            return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-akun', $perjadin_id);
        }

       	return view('backend.pengajuan.perjadinluarnegri.detailakun.pilihakun.index', ['rkakls' => $rkakls, 'perjadin_id' => $perjadin_id]);
    }

    public function store($perjadin_id, Request $request)
    {
        if (is_null($request->checkbox)) {
            \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.store.messages.info'));

            return redirect()->route('pengajuan.perjadin-luar-negeri.detail-akun.list-akun', $perjadin_id);
        }

        $check = PerjadinAkun::where('perjadin_id' , '=' , $perjadin_id)
                             ->where('keterangan', '=', 'perjadin-luar-negeri')
                             ->get();

        if (count($check) > 0) {
            PerjadinAkun::where('perjadin_id', $perjadin_id)
                        ->where('keterangan', '=', 'perjadin-luar-negeri')
                        ->delete();
        }

        $total = 0;
        $status_id = Status::where('kode_status', 'PR00')->first();

        foreach ($request->checkbox as $key => $value) {
            $rkakl = Rkakl::where('id', $request->rkakl_id[$key])->first();

            $perjadinakun = new PerjadinAkun;

            $perjadinakun->perjadin_id      = $perjadin_id;
            $perjadinakun->no_mak_sys       = $rkakl->no_mak_sys;
            $perjadinakun->uraian           = $rkakl->uraian;
            $perjadinakun->vol              = 1;
            $perjadinakun->jumlah           = str_replace('.', '', $request->nilai_pengajuan[$key]);
            $perjadinakun->status_id        = $status_id->id;
            $perjadinakun->sisa_pagu        = $rkakl->jumlah - ($rkakl->realisasi + $rkakl->realisasi_2 + $rkakl->realisasi_3);
            $perjadinakun->jumlah_pengajuan = str_replace('.', '', $request->jumlah_pengajuan[$key]);
            $perjadinakun->jumlah_pelaksana = str_replace('.', '', $request->satvol[$key]);
            $perjadinakun->keterangan       = 'perjadin-luar-negeri';

            $kode_9  = "";
            $kode_4  = "";
            $kode_8  = "";
            $kode_6  = "";
            $kode_7  = "";
            $kode_11 = "";
            $kode_0  = "";

            $no_mak  = explode(".", $rkakl->no_mak_sys);
            $kode_9  = $no_mak[0] . "." . $no_mak[1] . "." . $no_mak[2];
            $kode_4  = $no_mak[3];
            $kode_8  = $no_mak[3] . "." . $no_mak[4];
            $kode_6  = $no_mak[5];
            $kode_7  = $no_mak[6];
            $kode_11 = $no_mak[7];
            // $kode_0  = $no_mak[8];

            $perjadinakun->kode_9  = $kode_9;
            $perjadinakun->kode_4  = $kode_4;
            $perjadinakun->kode_8  = $kode_8;
            $perjadinakun->kode_6  = $kode_6;
            $perjadinakun->kode_7  = $kode_7;
            $perjadinakun->kode_11 = $kode_11;
            // $perjadinakun->kode_0  = $kode_0;

            $perjadinakun->save();

            $total += str_replace(".", "", $request->jumlah_pengajuan[$key]);
        }

        PerjadinLuarNegri::where('id', '=', $perjadin_id)
            ->update(['total_pengajuan' => $total]);

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.detail-akun', $perjadin_id);
    }

}
