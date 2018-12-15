<?php

namespace App\Http\Controllers\Backend\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Pengajuan\Kegiatan;
use App\Models\Backend\Pengajuan\PilihAkun;
use App\Models\Backend\Parameter;

class PilihAkunController extends Controller
{
    /**
     * @param $kegiatan_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listAkun($kegiatan_id)
    {
        $tahun_ang = parameter::where('id' , '=' , 1)->first();
        $no_mak = Kegiatan::where('id', $kegiatan_id)->first();
        $pilihakuns = Rkakl::where('no_mak', 'like', '%'.$no_mak->no_mak.'%')
            ->where('tahun' , $tahun_ang['value'])
            ->whereIn('level', [7, 11, 0])
            ->get();

        $check = PilihAkun::where('kegiatan_id' , '=' , $kegiatan_id)->get();
        if (count($check) > 0) {
            PilihAkun::where('kegiatan_id', $kegiatan_id)->delete();
        }

        foreach ($pilihakuns as $key => $value) {
                if ($value->level == 7 || $value->level == 11 || $value->level == 0 || $value->header == 1) {
                $insert = new PilihAkun();

                $insert->rkakl_id    = $value->id;
                $insert->kegiatan_id = $kegiatan_id;
                $insert->level       = $value->level;
                $insert->header      = $value->header;
                $insert->kode        = $value->kode;
                $insert->no_mak      = $value->no_mak;
                $insert->no_mak_sys  = $value->no_mak_sys;
                $insert->uraian      = $value->uraian;
                $insert->vol         = $value->vol;
                $insert->sat         = $value->sat;
                $insert->hargasat    = $value->hargasat;
                $insert->jumlah      = $value->jumlah;
                $insert->vol1        = 0;
                $insert->vol2        = 0;
                $insert->sisa_pagu   = $value->jumlah - ($value->vol_pengajuan - $value->vol_2 - $value->vol_3);
                $insert->sisa_vol    = 0;

                $insert->save();
            }
        }

        $pilihakuns = PilihAkun::where('kegiatan_id', $kegiatan_id)->get();

        return view('backend.pengajuan.kegiatan.detailakun.pilihakun.index', ['pilihakuns' => $pilihakuns, 'kegiatan_id' => $kegiatan_id]);
    }
}