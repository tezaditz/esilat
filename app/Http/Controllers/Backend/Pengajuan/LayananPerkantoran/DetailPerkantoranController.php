<?php

namespace App\Http\Controllers\Backend\Pengajuan\LayananPerkantoran;

use App\Models\Backend\Pengajuan\LayananPerkantoran\DetailPerkantoran;
use App\Models\Backend\Pengajuan\LayananPerkantoran\Perkantoran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Master\Rkakl;

class DetailPerkantoranController extends Controller
{
    public function detailPerkantoran($id)
    {
    	$perkantoran = Perkantoran::where('id', '=', $id)->first();
        $rkakls      = Rkakl::where('no_mak_sys' , 'LIKE' , '%' . $perkantoran->no_mak . '%')->get();

    	return view('backend.pengajuan.perkantoran.detailperkantoran.index', ['rkakls' => $rkakls, 'id' => $id]);
    }

    public function store(Request $request, $perkantoran_id)
    {
        if (is_null($request->total_pengajuan)) {
            \Session::flash('info', trans('backend/pengajuan.kegiatan.submodule.pilih_akun.store.messages.info'));
            return redirect()->route('pengajuan.layanan-perkantoran.detail-perkantoran', $perkantoran_id);
        }

        foreach ($request->rkakl_id as $key => $value) {
            $rkakl = Rkakl::where('id' , '=' , $value)->first();

            $no_mak  = explode(".", $rkakl->no_mak_sys);
            $kode_9  = $no_mak[0] . "." . $no_mak[1] . "." . $no_mak[2];
            $kode_4  = $no_mak[3];
            $kode_8  = $no_mak[3] . "." . $no_mak[4];
            $kode_6  = $no_mak[5];
            $kode_7  = $no_mak[6];
            $kode_11 = $no_mak[7];
            $kode_0  = $no_mak[8];

            $jml  = str_replace('.', '', $request->total[$key]);
            $sisa = $rkakl->jumlah - ($rkakl->realisasi + $rkakl->realisasi_2 + $rkakl->realisasi_3);

            if ($jml > 0 || $jml != "") {
                $insert = new DetailPerkantoran();

                $insert->perkantoran_id = $perkantoran_id;
                $insert->no_mak_sys     = $rkakl->no_mak_sys;
                $insert->uraian         = $rkakl->uraian;
                $insert->jumlah         = $jml;
                $insert->sisa_pagu      = $sisa;
                $insert->kode_9         = $kode_9;
                $insert->kode_4         = $kode_4;
                $insert->kode_8         = $kode_8;
                $insert->kode_6         = $kode_6;
                $insert->kode_7         = $kode_7;
                $insert->kode_11        = $kode_11;
                $insert->kode_0         = $kode_0;

                $insert->save();
            }
        }

        \Session::flash('success', trans('backend/perkantoran.perkantoran.submodule.draft_perkantoran.store.messages.success'));
        return redirect()->route('pengajuan.layanan-perkantoran.dokumen', $perkantoran_id);
    }
}