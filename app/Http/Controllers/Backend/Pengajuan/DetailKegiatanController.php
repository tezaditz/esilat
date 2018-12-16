<?php

namespace App\Http\Controllers\Backend\Pengajuan;

use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Status;
use App\Models\Backend\Pengajuan\DetailAkun;
use App\Models\Backend\Pengajuan\DetailKegiatan;
// use App\Models\Backend\Pengajuan\PilihAkun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailKegiatanController extends Controller
{
    public function store($kegiatan_id, Request $request)
    {
        if (is_null($request->checkbox)) {
            \Session::flash('info', trans('backend/pengajuan.kegiatan.submodule.pilih_akun.store.messages.info'));

            return redirect()->route('pengajuan.kegiatan.detail-akun.list-akun', $kegiatan_id);
        }

        DetailAkun::where('kegiatan_id', $kegiatan_id)->delete();
        DetailKegiatan::where('kegiatan_id', $kegiatan_id)->delete();

        $status_id = Status::where('kode_status', 'DT01')->first();
        $cek       = '';
        $totalakun = 0;

        foreach ($request->checkbox as $key => $value) {
            if ($request->jumlah[$key]) {

                // return $request->jumlah[$key];

                $akun = Rkakl::where('id', $request->rkakl_id[$key])->first();

                $arr_explode = explode(".", $akun->no_mak);
                if(Count($arr_explode) == 7)
                {
                    $getakun     = $arr_explode[6];
                }
                elseif(Count($arr_explode) == 8)
                {
                    $getakun     = $arr_explode[7];
                }

                // return $getakun;
                $uraianakun = Rkakl::where('kode', 'like', '%' . $getakun . '%')->first();



                Rkakl::where('kode', 'like', '%' . $getakun . '%')
                    ->update([
                        'vol1' => $request->vol[$key],
                        'vol2' => $request->satvol[$key],
                    ]);

                    // return $cek . "|" . $getakun;
                if ($cek != $getakun) {

                    $detailakun = new DetailAkun();

                    $detailakun->akun        = $getakun;
                    $detailakun->uraian      = $uraianakun->uraian;
                    $detailakun->kegiatan_id = $kegiatan_id;

                    $detailakun->save();

                    $totalakun = str_replace('.', '', $request->jumlah[$key]);
                    $cek       = $getakun;
                } else {
                    $totalakun = $totalakun + str_replace('.', '', $request->jumlah[$key]);
                }

                $sisapagu = $akun->jumlah - ($akun->realisasi_2 + $akun->realisasi_3);
                // $sisapagu = $akun->jumlah - ($akun->realisasi);
                
                // return $totalakun;

                $no_mak  = explode(".", $akun->no_mak_sys);

                $detailkegiatan = new DetailKegiatan();

                $detailkegiatan->kegiatan_id  = $kegiatan_id;
                $detailkegiatan->rincian_akun = $akun->no_mak_sys;
                $detailkegiatan->rkakl_id     = $request->rkakl_id[$key];
                $detailkegiatan->level        = $akun->level;
                $detailkegiatan->header       = $akun->header;
                $detailkegiatan->akun         = $getakun;
                $detailkegiatan->uraian       = $akun->uraian;
                $detailkegiatan->vol1         = 1;
                $detailkegiatan->vol2         = 1;
                $detailkegiatan->satuan       = $request->sat[$key];
                $detailkegiatan->status_id    = $status_id->id;
                $detailkegiatan->sisa_pagu    = $sisapagu;
                $detailkegiatan->kode_9       = $no_mak[0] . "." . $no_mak[1] . "." . $no_mak[2];
                $detailkegiatan->kode_4       = $no_mak[3];
                $detailkegiatan->kode_8       = $no_mak[3] . "." . $no_mak[4];
                $detailkegiatan->kode_6       = $no_mak[5];
                if(Count($no_mak) == 9)
                {
                    $detailkegiatan->kode_7       = $no_mak[6];
                    $detailkegiatan->kode_11      = $no_mak[7];
                    $detailkegiatan->kode_0       = $no_mak[8];    
                }
                elseif(Count($no_mak) == 8)
                {
                    $detailkegiatan->kode_7       = 0;
                    $detailkegiatan->kode_11      = $no_mak[6];
                    $detailkegiatan->kode_0       = $no_mak[7];
                }

                // return $request->jumlah[$key];
                
                $detailkegiatan->hrgsat       = str_replace('.', '', $request->hargasat[$key]);
                $detailkegiatan->jml_rph      = str_replace('.', '', $request->jumlah[$key]);



                $detailkegiatan->save();

            }
        }
        
        DetailAkun::where('akun', 'like', '%' . $getakun . '%')
        ->update(['jumlah' => $totalakun]);

        // rkakl::where('id' , $rkakl[0]['id'])
        // ->update(['jumlah' => $sisapagu]);

        // PilihAkun::where();

        // rkakl::where('id' , $rkakl[0]['id'])
        // ->update(['realisasi' => $totalakun]);


        DetailKegiatan::where('kegiatan_id', $kegiatan_id)
            ->where('uraian' , 'LIKE' , '%honor%')
            ->update(['sptjbflag' => 1]);

        DetailKegiatan::where('kegiatan_id', $kegiatan_id)
            ->where('uraian' , 'LIKE' , '%fullboard%')
            ->where('uraian' , 'LIKE' , '%paket%')
            ->update(['sptjbflag' => 1]);

        DetailKegiatan::where('kegiatan_id', $kegiatan_id)
            ->where('uraian' , 'LIKE' , '%fullday%')
            ->where('uraian' , 'LIKE' , '%paket%')
            ->update(['sptjbflag' => 1]);

        // PilihAkun::where('kegiatan_id' , $kegiatan_id)
        //     ->update(['jumlah' => $sisapagu, 'sisa_pagu' => $sisapagu]);
            

        \Session::flash('success', trans('backend/pengajuan.kegiatan.submodule.pilih_akun.store.messages.success'));
        return redirect()->route('pengajuan.kegiatan.detail-akun', $kegiatan_id)->withInput();
    }
}