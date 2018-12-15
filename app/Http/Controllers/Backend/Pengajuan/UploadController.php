<?php

namespace App\Http\Controllers\Backend\Pengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\Parameter;
use App\Models\Backend\MatriksUpload;
use App\Models\Backend\RkaklUpload;
use App\Models\Backend\Pengajuan\Transaksi;
use App\Models\Backend\Pengajuan\Realisasi;
use App\Models\Backend\Master\BagianEselon;
use App\Models\Backend\Master\Rkakl;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;

class UploadController extends Controller
{

    protected function index()
    {
    	$TahunAng 	= Parameter::where('name' , '=' , 'Tahun Anggaran')->get(['value']);
    	$UserData   = Auth::user()->bagian_id;        
        $BagianEselon = BagianEselon::where('bagian_id' , $UserData)->get();
        $eselonid   = $BagianEselon[0]['eselon_id'];

        $TempRkakl	= RkaklUpload::where('eselon_id' , $eselonid)
                                    ->where('bagian_id' , $UserData)->get();



    	return view('backend.upload.index' , ['TahunAng' => $TahunAng[0]['value'] , 'rkakls' => $TempRkakl]);
    }

    protected function upload(Request $req)
    {
        ini_set('max_execution_time', 600);
        $UserData   = Auth::user()->bagian_id;
        $BagianEselon = BagianEselon::where('bagian_id' , $UserData)->get();
        $eselonid   = $BagianEselon[0]['eselon_id'];

        DB::table('rkakl_upload')
        ->where('eselon_id' ,$eselonid)
        ->where('bagian_id' , $UserData)
        ->delete();

        DB::table('matriks_upload')
        ->where('eselon_id' ,$eselonid)
        ->where('bagian_id' , $UserData)->delete();


    	$file = Input::file('import_file');
        $file_path = $file->getRealPath();

        $data = Excel::selectSheets('RKAKL')->load($file_path)->get();
        $kode9 = "";$kode4 = "";$kode8 = "";$kode6 = "";$kode7 = "";$kode11 = "";$kode0 = "";$x = 1;$y = 0;
        foreach ($data as $key => $value) {

            $insert['id']       = $value->no;
            $insert['kode']     = $value->kode;
            $insert['uraian']   = $value->uraian;
            $insert['vol']      = $value->vol;
            $insert['sat']      = $value->sat;
            $insert['hargasat'] = $value->hargasat;
            $insert['jumlah']   = $value->jumlah;
            $insert['kdblokir'] = $value->kdblokir;
            $insert['sdana']    = $value->sdana;
            $insert['eselon_id']    = $eselonid;
            $insert['bagian_id']    = $UserData;
            $insert['level']    = strlen($value->kode);


            if(strlen($value->kode) == 0)
            {
                $cek    = trim(substr($value->uraian, 0 , 4));
                $cek2   = trim(substr($cek , 0 , 2));
                $insert['header']    = strlen($value->kode);
            }

            $nomak = "";
            $nomaksys = "";
            switch (strlen($value->kode)) {
                case 9:
                    $kode9 = trim($value->kode);
                    $nomak = $kode9;
                    $nomaksys = $nomak;
                    break;
                case 4:
                    $kode4 = trim($value->kode);
                    $nomak = $kode9 . "." . $kode4;
                    $nomaksys = $nomak;
                    break;
                case 8:
                    $kode8 = trim($value->kode);
                    $nomak = $kode9 .  "." . $kode8;
                    $nomaksys = $nomak;
                    break;
                case 6:
                    $kode6 = trim($value->kode);
                    $nomak = $kode9 .  "." . $kode8 .".". $kode6;
                    $nomaksys = $nomak;
                    break;
                case 7:
                    $kode7 = trim($value->kode);
                    $nomak = $kode9 .  "." . $kode8 .".". $kode6 .".". $kode7;
                    $nomaksys = $nomak;
                    break;
                case 11:
                    
                    $kode11 = trim($value->kode);
                    $y = 0;
                    if($kode7 == "")
                    {
                        $nomak = $kode9 .  "." . $kode8 .".". $kode6 ."." . $kode11;
                    }
                    else
                    {
                        $nomak = $kode9 .  "." . $kode8 .".". $kode6 .".". $kode7 . "." . $kode11;    
                    }
                    $nomaksys = $nomak;
                    break;
                
                default:
                    $kode0 = $y;

                    if($kode7 == "")
                    {
                        $nomak = $kode9 .  "." . $kode8 .".". $kode6 . "." . $kode11 ;
                        $nomaksys = $kode9 .  "." . $kode8 .".". $kode6 . "." . $kode11 . "." . $kode0;
                    }
                    else
                    {
                        $nomak = $kode9 .  "." . $kode8 .".". $kode6 .".". $kode7 . "." . $kode11;    
                        $nomaksys = $kode9 .  "." . $kode8 .".". $kode6 .".". $kode7 . "." . $kode11 . "." . $kode0;  
                    }
                    
                    break;
            }    

            $insert['no_mak']    = $nomak;
            $insert['no_mak_sys']    = $nomaksys;

            $x = $x + 1;
            $y = $y + 1;


            DB::table('rkakl_upload')->insert($insert);
        }
        $kode9 = "";$kode4 = "";$kode8 = "";$kode6 = "";$kode7 = "";$kode11 = "";$kode0 = "";$x = 1;$y = 0;
        $data = Excel::selectSheets('MATRIKS')->load($file_path)->get();
        foreach ($data as $key => $value) {

            $insert2['level']                    = $value->level;
            $insert2['kode']                     = $value->kode;
            $insert2['uraian']                   = $value->uraian;
            $insert2['uraian_kegiatan']          = $value->uraian_kegiatan;
            $insert2['tgl_pengajuan']               = $value->tanggal_pengajuan;
            $insert2['tgl_awal']                = $value->tanggal_awal_kegiatan;
            $insert2['tgl_akhir']               = $value->tanggal_akhir_kegiatan;
            $insert2['jumlah_pengajuan']            = $value->jumlah_rupiah_pengajuan;
            $insert2['jumlah_peserta']           = $value->jumlah_peserta;
            $insert2['no_kontrak']               = $value->no_kontrak;
            $insert2['tgl_kontrak']             = $value->tanggal_kontrak;
            $insert2['jumlah_rupiah_kontrak']    = $value->jumlah_rupiah_kontrak;
            $insert2['tgl_awal_kontrak']         = $value->tgl_awal_kontrak;
            $insert2['tgl_akhir_kontrak']        = $value->tgl_akhir_kontrak;
            $insert2['id_supplier']              = $value->no_supplier;
            $insert2['no_spm']                   = $value->no_spm;
            $insert2['tgl_spm']                  = $value->tgl_spm;
            $insert2['jumlah_rupiah_spm']        = $value->jumlah_rupiah_spm;
            $insert2['no_sp2d']                  = $value->no_sp2d;
            $insert2['tgl_sp2d']                 = $value->tgl_sp2d;
            $insert2['jumlah_rupiah_sp2d']       = $value->jumlah_rupiah_sp2d;

            $insert2['eselon_id']    = $eselonid;
            $insert2['bagian_id']    = $UserData;



            $nomak = "";
            $nomaksys = "";
            switch (strlen($value->kode)) {
                case 9:
                    $kode9 = trim($value->kode);
                    $nomak = $kode9;
                    $nomaksys = $nomak;
                    break;
                case 4:
                    $kode4 = trim($value->kode);
                    $nomak = $kode9 . "." . $kode4;
                    $nomaksys = $nomak;
                    break;
                case 8:
                    $kode8 = trim($value->kode);
                    $nomak = $kode9 . "." . $kode8;
                    $nomaksys = $nomak;
                    break;
                case 6:
                    $kode6 = trim($value->kode);
                    $nomak = $kode9 . "."  . $kode8 .".". $kode6;
                    $nomaksys = $nomak;
                    break;
                case 7:
                    $kode7 = trim($value->kode);
                    $nomak = $kode9 . "." . $kode8 .".". $kode6 .".". $kode7;
                    $nomaksys = $nomak;
                    break;
                case 11:
                    
                    $kode11 = trim($value->kode);
                    $y = 0;
                    if($kode7 == "")
                    {
                        $nomak = $kode9 . "." . $kode8 .".". $kode6 ."." . $kode11;
                    }
                    else
                    {
                        $nomak = $kode9 . "." . $kode8 .".". $kode6 .".". $kode7 . "." . $kode11;    
                    }
                    $nomaksys = $nomak;
                    break;
                
                default:
                    $kode0 = $y;

                    if($kode7 == "")
                    {
                        $nomak = $kode9 . "." .  $kode8 .".". $kode6 . "." . $kode11 ;
                        $nomaksys = $kode9 . "." .  $kode8 .".". $kode6 . "." . $kode11 . "." . $kode0;
                    }
                    else
                    {
                        $nomak = $kode9 . "." .  $kode8 .".". $kode6 .".". $kode7 . "." . $kode11;    
                        $nomaksys = $kode9 . "." .  $kode8 .".". $kode6 .".". $kode7 . "." . $kode11 . "." . $kode0;  
                    }
                    
                    break;
            }    

            
            $insert2['no_mak']    = $nomak;
            $insert2['no_mak_sys']    = $nomaksys;

            $x = $x + 1;
            $y = $y + 1;
            DB::table('matriks_upload')->insert($insert2);
        }

        return back();

        
    }

    protected function generate()
    {

        ini_set('max_execution_time', 600);
        $UserData   = Auth::user()->bagian_id;        
        $BagianEselon = BagianEselon::where('bagian_id' , $UserData)->get();
        $eselonid   = $BagianEselon[0]['eselon_id'];
        



        $DataMatriks    = MatriksUpload::where('eselon_id' , $eselonid)
                                        ->where('bagian_id' , $UserData)
                                        ->get();

        DB::table('transaksi')->where('eselon_id' , $eselonid)
                            ->where('bagian_id' , $UserData)
                            ->delete();


        foreach ($DataMatriks as $key => $value) {
            $insert = [];
            if(empty($value->level) )
            {

                $insert['id_t']         = $value->id;
                $insert['no_mak_sys']   = $value->no_mak_sys;

                if(empty($value->jumlah_rupiah_sp2d) && empty($value->jumlah_rupiah_spm))
                {
                    $insert['jumlah']       = $value->jumlah_pengajuan;
                    $insert['status']       = 'RL01'; 
                }

                if(empty($value->jumlah_rupiah_sp2d) && !empty($value->jumlah_rupiah_spm))
                {
                    $insert['jumlah']       = $value->jumlah_rupiah_spm;
                    $insert['status']       = 'RL02'; 
                }

                if(!empty($value->jumlah_rupiah_sp2d))
                {
                    $insert['jumlah']       = $value->jumlah_rupiah_sp2d;
                    $insert['status']       = 'RL03'; 
                }

                $insert['vol']          = 1;
                $insert['kode_9']       = substr($value->no_mak_sys, 0 , 9);
                $insert['kode_4']       = substr($value->no_mak_sys, 10 , 4);
                $insert['kode_8']       = substr($value->no_mak_sys, 10 , 8);
                $insert['kode_6']       = substr($value->no_mak_sys, 19 , 3);

                
                if(strlen($value->no_mak_sys) == 31 )
                {
                    $insert['kode_7']       = 0;
                    $insert['kode_11']      = substr($value->no_mak_sys, 23 , 6);   
                }
                else
                {
                    $insert['kode_7']       = substr($value->no_mak_sys, 23 , 1);
                    $insert['kode_11']      = substr($value->no_mak_sys, 23 , 6);     
                }
                
                
                $insert['kode_0']       = 1;
                $insert['eselon_id']    = $eselonid;
                $insert['bagian_id']    = $UserData;
                $insert['keterangan']   = 1;

                if(!empty($value->tgl_pengajuan))
                {
                    $insert['tanggal']      = $value->tgl_pengajuan;
                }
                else
                {   
                    
                    $insert['tanggal']      = $value->tgl_awal;
                }

                DB::table('transaksi')->insert($insert); 
            }
           
        }

        // Refresh Realisasi
        $Cek = realisasi::where('eselon_id' , $eselonid)->get();
        if (Count($Cek) == 0) {
            $bulan = [ 'Jan' , 'Feb' , 'Mar' , 'Apr' , 'Mei' , 'Jun' , 'Jul' , 'Ags' , 'Sep' , 'Okt' , 'Nov' , 'Des'];
            $x = 1;
            $Parameter= Parameter::where('name' , 'Tahun Anggaran')->get();
            foreach ($bulan as $key => $value) {
                $insert = new realisasi();
                $insert->bulan = $value;
                $insert->kode_bulan = $x;
                $insert->nilai_pengajuan = 0;
                $insert->nilai_dilaksanakan = 0;
                $insert->nilai_selesai = 0;
                $insert->eselon_id = $eselonid;
                $insert->tahun_anggaran = $Parameter[0]['value'];
                $insert->save();
                $x = $x + 1;
            }
        }


        $this->posting_to_rkakl();
        $this->update_rkakl();
        $this->update_realisasi();
        return back();
    }

    public function posting_to_rkakl()
    {
        $UserData   = Auth::user()->bagian_id;        
        $BagianEselon = BagianEselon::where('bagian_id' , $UserData)->get();
        $eselonid   = $BagianEselon[0]['eselon_id'];

        DB::table('rkakl')
                ->where('eselon_id' , $eselonid)
                ->delete();

        $Data = RkaklUpload::where('eselon_id' , $eselonid)
                            ->where('bagian_id' , $UserData)
                            ->get();

        $Parameter= Parameter::where('name' , 'Tahun Anggaran')->get();
        $x = 1 ;
        $header = 0;
        foreach ($Data as $key => $value) {
                $insert['eselon_id'] = $value->eselon_id;
                $insert['bagian_id'] = $value->bagian_id;
                $insert['tahun'] = $Parameter[0]['value'];
                $insert['no_rkakl'] = $x;
                $insert['kode'] = $value->kode;
                $insert['level'] = $value->level;

            if(strlen($value->kode) == 0)
            {
                $cek    = trim(substr($value->uraian, 0 , 4));
                $cek2   = trim(substr($cek , 0 , 2));
                $header = strlen($cek2);
            }

            if($header != 1 && $header != 2)
            {
                $header = 0;
            }

                $insert['header'] = $header;
                $insert['no_mak'] = $value->no_mak;
                $insert['no_mak_sys'] = $value->no_mak_sys;
                $insert['uraian'] = $value->uraian;
                $insert['vol'] = $value->vol;
                $insert['sat'] = $value->sat;
                $insert['hargasat'] = $value->hargasat;
                $insert['jumlah'] = $value->jumlah;
                $insert['sdana'] = $value->sdana;


                DB::table('rkakl')->insert($insert); 
                $x =$x + 1;
        }       
    }

    public function update_rkakl()
    {
        $Data11 = DB::select('select CONCAT(kode_9 ,"." , kode_8,".", kode_6,"." , kode_11 ) AS no_mak , SUM(jumlah) AS total , status FROM transaksi GROUP BY kode_9 , kode_4 , kode_8 , kode_6 , kode_11
                ');
        foreach ($Data11 as $key => $value) {
            if($value->status == 'RL01')
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi' => $value->total]);
            }
            elseif ($value->status == 'RL02') {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_2' => $value->total]);
            }
            else
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_3' => $value->total]);
            }
        }

        $Data11 = DB::select('select CONCAT(kode_9 ,"." , kode_8,".", kode_6 ) AS no_mak , SUM(jumlah) AS total , status FROM transaksi GROUP BY kode_9 , kode_4 , kode_8 , kode_6 ');
        foreach ($Data11 as $key => $value) {
            if($value->status == 'RL01')
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi' => $value->total]);
            }
            elseif ($value->status == 'RL02') {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_2' => $value->total]);
            }
            else
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_3' => $value->total]);
            }
        }

        $Data11 = DB::select('select CONCAT(kode_9 ,"." , kode_8 ) AS no_mak , SUM(jumlah) AS total , status FROM transaksi GROUP BY kode_9 , kode_4 , kode_8');
        foreach ($Data11 as $key => $value) {
            if($value->status == 'RL01')
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi' => $value->total]);
            }
            elseif ($value->status == 'RL02') {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_2' => $value->total]);
            }
            else
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_3' => $value->total]);
            }
        }

        $Data11 = DB::select('select CONCAT(kode_9 ,"." , kode_4 ) AS no_mak , SUM(jumlah) AS total , status FROM transaksi GROUP BY kode_9 , kode_4 , kode_4');
        foreach ($Data11 as $key => $value) {
            if($value->status == 'RL01')
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi' => $value->total]);
            }
            elseif ($value->status == 'RL02') {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_2' => $value->total]);
            }
            else
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_3' => $value->total]);
            }
        }

        $Data11 = DB::select('select CONCAT(kode_9) AS no_mak , SUM(jumlah) AS total , status FROM transaksi GROUP BY kode_9');
        foreach ($Data11 as $key => $value) {
            if($value->status == 'RL01')
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi' => $value->total]);
            }
            elseif ($value->status == 'RL02') {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_2' => $value->total]);
            }
            else
            {
                DB::table('rkakl')
                ->where('no_mak_sys' , $value->no_mak)
                ->update(['realisasi_3' => $value->total]);
            }
        }
    }

    public function update_realisasi()
    {
        $UserData   = Auth::user()->bagian_id;        
        $BagianEselon = BagianEselon::where('bagian_id' , $UserData)->get();
        $eselonid   = $BagianEselon[0]['eselon_id'];

        $UpdateRealisasi = DB::table('realisasi')
        ->where('eselon_id' , $eselonid)
        ->update(['nilai_pengajuan' => 0 , 'nilai_dilaksanakan' => 0 , 'nilai_selesai' => 0]);

        $UpdateRealisasi = DB::table('rpdsummary')
        ->where('eselon_id' , $eselonid)
        ->update(['realisasi' => 0 ]);
        
        $Data = DB::select('select YEAR(tanggal) as tahun , MONTH(tanggal) as bulan , SUM(jumlah) AS total , status FROM transaksi GROUP BY YEAR(tanggal) , MONTH(tanggal) , status');
        
        foreach ($Data as $key => $value) {
            $nilai_pengajuan = 0;$nilai_realisasi = 0;$nilai_dilaksanakan = 0;


            if($value->status == 'RL01')
            {
               
               DB::table('realisasi')
                    ->where('kode_bulan' , $value->bulan)
                    ->where('eselon_id' , $eselonid)
                    ->update(['nilai_pengajuan' => $value->total]);
            }
            elseif ($value->status == 'RL02') {
                DB::table('realisasi')
                    ->where('kode_bulan' , $value->bulan)
                    ->where('eselon_id' , $eselonid)
                    ->update(['nilai_dilaksanakan' => $value->total]);
            }
            else
            {
                DB::table('realisasi')
                    ->where('kode_bulan' , $value->bulan)
                    ->where('eselon_id' , $eselonid)
                    ->update(['nilai_selesai' => $value->total]);
            }
        } 

        $getDataRkakl = rkakl::where('level' , 9)
                                            ->where('eselon_id' , $eselonid)
                                            ->get();
        
        
        $PAGU = $getDataRkakl[0]['jumlah'];
        $dataRealisasi = Realisasi::where('eselon_id' , $eselonid)->get();
        $Parameter= Parameter::where('name' , 'Tahun Anggaran')->get();

        $percent = 0;
        foreach ($dataRealisasi as $key => $value) {
            $realisasi = $value->nilai_pengajuan  + $value->nilai_dilaksanakan + $value->nilai_selesai;

            $realisasi_percent = ($realisasi / $PAGU) * 100;
            $percent = $percent + $realisasi_percent;
            
            DB::table('rpdsummary')  
                    ->where('eselon_id' , $eselonid)
                    ->where('bulan' , $value->bulan)
                    ->where('tahun_ang' , $Parameter[0]['value'] )
                    ->update(['realisasi' => $percent]);
        }


            
    }
}
