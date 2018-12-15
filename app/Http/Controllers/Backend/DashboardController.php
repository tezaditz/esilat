<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Pengajuan\Transaksi;
use App\Models\Backend\Rpd;
use App\Models\Backend\realisasi_pnbp;
use App\Models\Backend\Rpdsummary\Rpdsummary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pengajuan\Kegiatan;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Eselon;
use App\Models\Backend\Master\JenisBelanja;
use App\Models\Backend\Master\BagianEselon;
use App\Models\Backend\Parameter;
use App\Models\Backend\Dashboard\realisasipengadaan;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $parameter = parameter::where('name' , 'like' , 'upload pengajuan')->get();
        $Data = $parameter[0]['value'];

            return view('backend.dashboard.index' , compact(['upload' => $Data]));
        
    }

    public function hitungRealisasi()
    {
        $DataRkakl = Rkakl::where('level', '=', 4)->first();
        $pagu      = $DataRkakl->jumlah;

        $CPercent = 0;
        for ($i=1; $i < 12 ; $i++) {
            $transaksi = Transaksi::WhereMonth('tanggal', '=',  $i)
                ->where('status', '=', 'RL03')
                ->get();

            $totalpengajuan = 0;
            foreach ($transaksi as $key => $value) {
                $totalpengajuan = $totalpengajuan + $value->jumlah;
            }

            if($transaksi->count() < 1)
            {
                $CPercent = 0;
            }

            $percent   = ($totalpengajuan / $pagu) * 100;
            $nilai[$i] = $percent;

            $bulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des' ];

            Rpdsummary::where('bulan', '=', $bulan[$i])
                ->update([
                    'realisasi' => $CPercent + $nilai[$i]
                ]);

            $CPercent = $CPercent + $nilai[$i];
        }
    }

    public function get_pagu_anggaran()
    {
        $tahunAngg = parameter::where('id' , '=' , 1)->first();
        
        $rkakl = DB::select('select a.kode_satker as kode , a.nama_singkat as nama , b.jumlah as alokasi , (b.realisasi + b.realisasi_2 + b.realisasi_3 ) as realisasi from eselon a inner join rkakl b on a.id = b.eselon_id where b.level = 4 and tahun = :tahun ORDER BY kode ' , ['tahun' => $tahunAngg['value']] );

        return $rkakl;
    }

    public function get_jmlalokasi()
    {
        $tahunAngg = parameter::where('id' , '=' , 1)->first();
        
        $rkakl = DB::select('select a.kode_satker as kode , a.nama_satker as nama , SUM(b.jumlah) as jumalokasi , SUM((b.realisasi + b.realisasi_2 + b.realisasi_3 )) as jumreal from eselon a inner join rkakl b on a.id = b.eselon_id where b.level = 4 and tahun = :tahun' , ['tahun' => $tahunAngg['value']] );


        return $rkakl;
    }

    public function get_jenis_belanja()
    {
        $tahunAngg = parameter::where('id' , '=' , 1)->first();
        $rkakl = DB::select('select eselon.nama_singkat as name , left(trim(kode),2) as jenis_belanja , sum(jumlah) as alokasi , sum(realisasi + realisasi_2 + realisasi_3) as realisasi 
        from rkakl 
        inner join eselon on eselon.id = rkakl.eselon_id
        WHERE rkakl.level = 11 and tahun = '. $tahunAngg["value"] .'
        group by left(trim(rkakl.kode),2) , rkakl.eselon_id 
        order by eselon.id , LEFT(TRIM(kode),2)');


        $namasatker = DB::select('select eselon.nama_singkat FROM eselon INNER JOIN rkakl ON eselon.id = rkakl.eselon_id
            GROUP BY nama_singkat
            ORDER BY rkakl.eselon_id');


        $Jnsblj = JenisBelanja::all();
        

        $Data = array(
            'rkakl' => $rkakl ,
            'Jnsblj' => $Jnsblj,
            'nm' => $namasatker,
         );
        
        return $Data;
    }

    public function get_rpd_summary()
    {
        $thnang = parameter::where('id' , '=' , 1)->first();
        $bagianid = Auth::user()->bagian_id;
        $eselonid = BagianEselon::where('bagian_id' , '=' , $bagianid )->first();


        $data = DB::table('Rpdsummary')
                    ->select(DB::raw('bulan, SUM(nilai) AS nilai , SUM(nilai_perubahan) AS nilai_perubahan , SUM(realisasi) AS realisasi'))
                    ->OrderBy('id')
                    ->groupBy('bulan')
                    ->get();

        

        $data2 = [];

        foreach ($data as $key => $value) {
            $data2[] = [
                'bulan' => $value->bulan,
                'nilai' => ($value->nilai / 6),
                'nilai_perubahan' => $value->nilai_perubahan,
                'realisasi' => $value->realisasi
            ] ;
        }


        return $data2;


        
    }

    public function get_matrix()
    {
        $eselon_data = DB::select('select rkakl.level , SUM(rkakl.jumlah) alokasi , eselon.id , eselon.nama_satker as nama_satker , eselon.kode_satker as kode_satker FROM eselon_rkakl 
            INNER JOIN rkakl  ON eselon_rkakl.rkakl_id = rkakl.id
            INNER JOIN eselon ON eselon_rkakl.eselon_id = eselon.id
            WHERE rkakl.level = 4
            GROUP BY eselon_rkakl.eselon_id');

        return $eselon_data;
    }

    public function get_pie_realisasi()
    {
        $rkakl = DB::select('select SUM(jumlah) AS alokasi , SUM(realisasi + realisasi_2 + realisasi_3) AS realisasi , (SUM(jumlah) - SUM(realisasi_3)) AS sisa FROM rkakl WHERE LEVEL = 4;');


        return $rkakl;
    }

    public function realisasi_pnbp()
    {
        // cek data eselon
        $data_eselon = eselon::all();

        $a = realisasi_pnbp::where('id' , '!=' , 0)
                        ->update([
                            'alokasi_rm' => 0,
                            'alokasi_pnbp' => 0,
                            'rm' => 0,
                            'pnbp' => 0,
                                ]);

        foreach ($data_eselon as $key => $value) {
            
            $cek_data = realisasi_pnbp::where('eselon_id' , '=' , $value->id)->get();
            if($cek_data->count() == 0)
            {
                $add_data = new realisasi_pnbp();
                $add_data->eselon_id = $value->id;
                $add_data->kode_satker = $value->kode_satker;
                $add_data->nama_satker = $value->nama_singkat;
                $add_data->rm = 0;
                $add_data->pnbp = 0;
                $add_data->save();

            }

        }

        $dataRealisasi = DB::select('select eselon.id as eselonID , eselon.kode_satker as kode , eselon.nama_satker as nama , sdana , SUM(jumlah) AS alokasi ,
        SUM(realisasi + realisasi_2 + realisasi_3) AS realisasi FROM rkakl    
        JOIN eselon ON rkakl.eselon_id = eselon.id WHERE rkakl.sdana IS NOT NULL GROUP BY rkakl.sdana , eselon.id');

        foreach ($dataRealisasi as $key => $value) {

            if($value->sdana == 'A')
            {
                $update_data = realisasi_pnbp::where('eselon_id' , '=' , $value->eselonID)
                                                ->update([
                                                    'alokasi_rm' => $value->alokasi,
                                                    'rm' => $value->realisasi,
                                                            ]);
            }
            else
            {
                $update_data = realisasi_pnbp::where('eselon_id' , '=' , $value->eselonID)
                                                ->update([
                                                    'alokasi_pnbp' => $value->alokasi,
                                                    'pnbp' => $value->realisasi,
                                                            ]);
            }
            

        }

        $data = realisasi_pnbp::all();


        return $data;
    }

    public function jum_realisasi_pnbp()
    {
        // cek data eselon
        // $data_eselon = eselon::all();

        // $a = realisasi_pnbp::where('id' , '!=' , 0)
        //                 ->update([
        //                     'alokasi_rm' => 0,
        //                     'alokasi_pnbp' => 0,
        //                     'rm' => 0,
        //                     'pnbp' => 0,
        //                         ]);

        // foreach ($data_eselon as $key => $value) {
            
        //     $cek_data = realisasi_pnbp::where('eselon_id' , '=' , $value->id)->get();
        //     if($cek_data->count() == 0)
        //     {
        //         $add_data = new realisasi_pnbp();
        //         $add_data->eselon_id = $value->id;
        //         $add_data->kode_satker = $value->kode_satker;
        //         $add_data->nama_satker = $value->nama_singkat;
        //         $add_data->rm = 0;
        //         $add_data->pnbp = 0;
        //         $add_data->save();

        //     }

        // }

        $dataRealisasi = DB::select('select eselon.id as eselonID , eselon.kode_satker as kode , eselon.nama_satker as nama , sdana , SUM(jumlah) AS jumalokasi ,
        SUM(realisasi + realisasi_2 + realisasi_3) AS jumrealisasi FROM rkakl    
        JOIN eselon ON rkakl.eselon_id = eselon.id WHERE rkakl.sdana IS NOT NULL GROUP BY rkakl.sdana , eselon.id');

        foreach ($dataRealisasi as $key => $value) {

            if($value->sdana == 'A')
            {
                $update_data = realisasi_pnbp::where('eselon_id' , '=' , $value->eselonID)
                                                ->update([
                                                    'alokasi_rm' => $value->alokasi,
                                                    'rm' => $value->realisasi,
                                                            ]);
            }
            else
            {
                $update_data = realisasi_pnbp::where('eselon_id' , '=' , $value->eselonID)
                                                ->update([
                                                    'alokasi_pnbp' => $value->alokasi,
                                                    'pnbp' => $value->realisasi,
                                                            ]);
            }
            

        }

        $data = realisasi_pnbp::all();


        return $data;
    }

    public function realisasi_tupoksi()
    {
        $data = DB::select("select b.`nama_singkat` , SUM(a.jumlah) AS alokasi , SUM(realisasi + realisasi_2 + realisasi_3) AS realisasi FROM rkakl a JOIN eselon b ON a.`eselon_id` = b.`id`  WHERE a.`level` = 0 AND a.`header` = 0 AND flag_pengadaan = 0 GROUP BY a.`eselon_id`;");

        return $data;
    }

    public function realisasi_pengadaan()
    {
        $thnang = parameter::where('id' ,'=' , 1)->first();


        $eselon = Eselon::all();

        foreach ($eselon as $key => $value) {
            $data1 = realisasipengadaan::where('eselon_id' , '=' , $value->id)
                                        ->where('tahun_ang' , '=' , $thnang['value'])
                                        ->get();
            $nilai_alokasi = 0;
            $nilai_kontrak = 0;
            $nilai_realisasi = 0;

            $dataPengadaan = DB::select("select b.`nama_singkat` , SUM(a.jumlah) AS alokasi , SUM(realisasi + realisasi_2) AS realisasi_awal FROM rkakl a JOIN eselon b ON a.`eselon_id` = b.`id`  WHERE a.`level` = 0 AND a.`header` = 0 and eselon_id = " . $value->id . " AND flag_pengadaan = 1 GROUP BY a.`eselon_id`");


            if(Count($dataPengadaan) != 0)
            {
                foreach ($dataPengadaan as $key2 => $value2) {
                    $nilai_alokasi = $value2->alokasi;  
                }
                              
            };

            if($data1->Count() == 0)
            {
                $insert_data = new realisasipengadaan();
                $insert_data->eselon_id = $value->id;
                $insert_data->kode_satker = $value->id;
                $insert_data->nama_satker = $value->nama_singkat;
                $insert_data->alokasi = $nilai_alokasi;
                $insert_data->nilai_kontrak = $nilai_kontrak;
                $insert_data->pencairan_kontrak = $nilai_realisasi;
                $insert_data->tahun_ang = $thnang['value'];
                $insert_data->save();


            };

        };

        $data = realisasipengadaan::all();

        return $data;
    }

    public function get_rpd_summary_eselon_dua($eselonid)
    {
        $thnang = parameter::where('id' , '=' , 1)->first();
        // $bagianid = Auth::user()->bagian_id;
        // $eselonid = BagianEselon::where('bagian_id' , '=' , $bagianid )->first();


        $data = Rpdsummary::where('eselon_id', '=' , $eselonid)->get();

        return $data;
    }

    public function get_pie_realisasi_eselon_dua($eselonid)
    {
        $rkakl = DB::select("select SUM(jumlah) AS alokasi , SUM(realisasi + realisasi_2 + realisasi_3) AS realisasi , (SUM(jumlah) - SUM(realisasi_3)) AS sisa FROM rkakl WHERE LEVEL = 4 and eselon_id = " . $eselonid . " ;");


        return $rkakl;
    }

    public function get_jenis_belanja_eselon_dua($eselonid)
    {
        $tahunAngg = parameter::where('id' , '=' , 1)->first();
        $rkakl = DB::select('select eselon.nama_singkat as name , left(trim(kode),2) as jenis_belanja , sum(jumlah) as alokasi , sum(realisasi + realisasi_2 + realisasi_3) as realisasi 
        from rkakl 
        inner join eselon on eselon.id = rkakl.eselon_id
        WHERE rkakl.level = 11 and tahun = '. $tahunAngg["value"] .' and eselon_id = ' . $eselonid . '
        group by left(trim(rkakl.kode),2) , rkakl.eselon_id 
        order by eselon.id , LEFT(TRIM(kode),2)');


        $namasatker = DB::select('select eselon.nama_singkat FROM eselon INNER JOIN rkakl ON eselon.id = rkakl.eselon_id
            where eselon.id = ' . $eselonid . '
            GROUP BY nama_singkat
            ORDER BY rkakl.eselon_id');


        $Jnsblj = JenisBelanja::all();
        

        $Data = array(
            'rkakl' => $rkakl ,
            'Jnsblj' => $Jnsblj,
            'nm' => $namasatker,
         );
        
        return $Data;
    }

    public function realisasi_tupoksi_eselon_dua($eselonid)
    {
        $data = DB::select("select b.`nama_singkat` , SUM(a.jumlah) AS alokasi , SUM(realisasi + realisasi_2 + realisasi_3) AS realisasi FROM rkakl a JOIN eselon b ON a.`eselon_id` = b.`id`  WHERE a.`level` = 0 AND a.`header` = 0 AND a.flag_pengadaan = 0 and b.id = ". $eselonid ." GROUP BY a.`eselon_id`;");

        return $data;
    }

    public function realisasi_pnbp_eselon_dua($eselonid)
    {
        // cek data eselon
        $data_eselon = eselon::where('id' , '=' , $eselonid)->get();

        $a = realisasi_pnbp::where('id' , '!=' , 0)
                        ->update([
                            'alokasi_rm' => 0,
                            'alokasi_pnbp' => 0,
                            'rm' => 0,
                            'pnbp' => 0,
                                ]);

        foreach ($data_eselon as $key => $value) {
            
            $cek_data = realisasi_pnbp::where('eselon_id' , '=' , $value->id)->get();
            if($cek_data->count() == 0)
            {
                $add_data = new realisasi_pnbp();
                $add_data->eselon_id = $value->id;
                $add_data->kode_satker = $value->kode_satker;
                $add_data->nama_satker = $value->nama_singkat;
                $add_data->rm = 0;
                $add_data->pnbp = 0;
                $add_data->save();

            }

        }

        $dataRealisasi = DB::select('select eselon.id as eselonID , eselon.kode_satker as kode , eselon.nama_satker as nama , sdana , SUM(jumlah) AS alokasi ,
        SUM(realisasi + realisasi_2 + realisasi_3) AS realisasi FROM rkakl    
        JOIN eselon ON rkakl.eselon_id = eselon.id WHERE rkakl.eselon_id = '. $eselonid .' and rkakl.sdana IS NOT NULL GROUP BY rkakl.sdana , eselon.id');

        foreach ($dataRealisasi as $key => $value) {

            if($value->sdana == 'A')
            {
                $update_data = realisasi_pnbp::where('eselon_id' , '=' , $value->eselonID)
                                                ->update([
                                                    'alokasi_rm' => $value->alokasi,
                                                    'rm' => $value->realisasi,
                                                            ]);
            }
            else
            {
                $update_data = realisasi_pnbp::where('eselon_id' , '=' , $value->eselonID)
                                                ->update([
                                                    'alokasi_pnbp' => $value->alokasi,
                                                    'pnbp' => $value->realisasi,
                                                            ]);
            }
            

        }

        $data = realisasi_pnbp::where('eselon_id' , '=', $eselonid)->get();


        return $data;
    }

    public function get_spm_sp2d($eselonid)
    {
        
        if($eselonid != 0)
        {
            $rkakl = DB::select("select b.`nama_singkat` as nama_singkat , a.jumlah as Alokasi , a.realisasi as Pengajuan , a.realisasi_2 as SPM , a.realisasi_3 as SP2D FROM rkakl a JOIN eselon b ON a.`eselon_id` = b.`id` WHERE LEVEL = 9 AND eselon_id = ". $eselonid ." ORDER BY eselon_id ");
        }
        else
        { 
            $rkakl = DB::select("select b.`nama_singkat` as nama_singkat , a.jumlah as Alokasi , a.realisasi as Pengajuan , a.realisasi_2 as SPM , a.realisasi_3 as SP2D FROM rkakl a JOIN eselon b ON a.`eselon_id` = b.`id` WHERE LEVEL = 9 ORDER BY eselon_id ");
        }

        return $rkakl;
    }

    public function realisasi_pengadaan_eselon_dua($eselon_id)
    {
        $thnang = parameter::where('id' ,'=' , 1)->first();


        $eselon = Eselon::where('id', '=', $eselon_id)->first();

        $data1 = realisasipengadaan::where('eselon_id' , '=' , $eselon_id)
                                        ->where('tahun_ang' , '=' , $thnang['value'])
                                        ->get();

        $dataPengadaan = DB::select("select b.`nama_singkat` , SUM(a.jumlah) AS alokasi , SUM(realisasi + realisasi_2) AS realisasi_awal FROM rkakl a JOIN eselon b ON a.`eselon_id` = b.`id`  WHERE a.`level` = 0 AND a.`header` = 0 and eselon_id = " . $eselon_id . " AND flag_pengadaan = 1 GROUP BY a.`eselon_id`");

        

        if ($data1->count() != 0) {
                foreach ($dataPengadaan as $key2 => $value2) {
                    realisasipengadaan::where('eselon_id' , '=' , $eselon_id)
                                ->where('tahun_ang' , '=' , $thnang['value'])
                                ->update([
                                            'alokasi' => $value2->alokasi,
                                            'nilai_kontrak' => 0,
                                            'pencairan_kontrak' => 0
                                         ]); 
                }
           
        }   
        else
        {

        }


        
        

        $data = realisasipengadaan::where('eselon_id', '=', $eselon_id)->get();

        return $data;
    }

}