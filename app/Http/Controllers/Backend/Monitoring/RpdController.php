<?php

namespace App\Http\Controllers\Backend\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Rpd;
use App\Models\Backend\Rpk;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Bagian_rkakl;
use App\Models\Backend\Master\BagianEselon;
use App\Models\Backend\Master\Eselon;
use Auth;
use DB;
use PDF;
use PDF2;
use Carbon\Carbon;
use App\Models\Backend\Parameter;
use App\Models\Backend\Rpdsummary\Rpdsummary;
use Excel;
use DataTables;
Use App\Models\User;
use App\DataTables\monitoring\rpd\RpdDataTables;


class RpdController extends Controller
{
    public function index()
    {
        $tahun_Ang = parameter::where('id' , '=' , 1)->first();
    	$bagianid = Auth::User()->bagian_id;

        // $rpd = Rpd::where('bagian_id' , '=' , Auth::user()->bagian_id)
        //             ->where('thn_ang' , '=' , $tahun_Ang['value'])
        //             ->get();

        $rpd = Rpd::where('bagian_id' , '=' , $bagianid)->get();

        
        $total = $rpd->count();
    	return view('backend.monitoring.rpd.index' , ['rpd' => $rpd , 'total' => $total]);
    }

    public function data_rkakl()
    {
        $tahun_Ang = parameter::where('id' , '=' , 1)->first();
	   $bagianid = Auth::User()->bagian_id;
	   $eselonid = BagianEselon::where('bagian_id' , '=' , $bagianid)->first();

    	$rkakl = rkakl::where('level' , '=' , 7)
    					->where('flag_rpd' , '=' , 0)
                        ->where('tahun', '=' , $tahun_Ang['value'])
			->where('eselon_id' , '=' , $eselonid['eselon_id'])
                        ->paginate(200);



    	return view('backend.monitoring.rpd.data-rkakl' , ['rkakl' => $rkakl]);
    }

    public function simpan_rkakl(Request $request)
    {
    	$bagianid = Auth::user()->bagian_id;
    	$kegiatan = collect($request->input('checkbox'));
    	foreach ($kegiatan as $key => $value) {
    		$rkakl = rkakl::where('id' , '=' , $value)->get();
    		$nomaks = $rkakl[0]['no_mak'];
    		$rkakl2 = rkakl::where('id' , '>=' , $value)
                            ->where('no_mak' , 'LIKE' , '%' . $nomaks . '%')
    						->where(function($query) {
    								$query->where('level' , '=' , 7)
											->OrWhere('level' , '=' , 11)
                                            ->OrWhere('level' , '=' , 0);
    						})->get();
    		
    		foreach ($rkakl2 as $key2 => $value2) {
    			
    			$insert_data = new rpd;
    			$insert_data->rkakl_id = $value2->id;
                $insert_data->eselon_id = $value2->eselon_id;
    			$insert_data->level = $value2->level;
    			$insert_data->kode = $value2->kode;
    			$insert_data->no_mak = $value2->no_mak;
    			$insert_data->pagu = $value2->jumlah;
    			$insert_data->uraian = $value2->uraian;
    			$insert_data->bagian_id = $bagianid;
                $insert_data->thn_ang = $value2->tahun;
    			$insert_data->save();

                $update_rkakl = rkakl::where('id' , '=' , $value2->id)
                                        ->update(['bagian_id' => Auth::User()->bagian_id]);


            }

            $dataRpd = rpd::where('level' , '=' , 7)->get();

    		$update_rkakl = rkakl::where('id' , '=' , $value)
    						->update(['flag_rpd' => 1]);

            $update_rkakl = rkakl::where('id' , '<' , $value)
                            ->where('level' , '=' , 6)
                            ->update(['bagian_id' => $bagianid]);
    	}

    	return redirect()->route('monitoring.rpkrpd.index');
    }

    public function simpan_rpk(Request  $request)
    {

        $tglFrom = collect($request->input('tglFrom'));
        $tglTo = collect($request->input('tglTo'));        
        $id = collect($request->input('id'));

        foreach ($tglFrom as $key => $value) {
        $tanggalFrom = new Carbon($value); 
        $tanggalTo = new Carbon($tglTo[$key]); 

        $dayTo = $tanggalTo->day;
        $monthTo = $tanggalTo->month;
        $yearTo = $tanggalTo->year;

        $dayFrom = $tanggalFrom->day;
        $monthFrom = $tanggalFrom->month;
        $yearFrom = $tanggalFrom->year;


        $chk_rpk = rpk::where('monthFrom_update' , '=' , $monthFrom)
                    ->where('dayFrom_update' , '=' , $dayFrom)
                    ->where('rpd_id', '=' , $key)
                    ->count();
        if($chk_rpk == 0)
        {

            $dataRpd = rpd::where('id' , '=' , $key)->get();
            $insert_rpk = new rpk;
            $insert_rpk->rpd_id = $key;
            $insert_rpk->level = $dataRpd[0]['level'];
            $insert_rpk->kode = $dataRpd[0]['kode'];
            $insert_rpk->no_mak = $dataRpd[0]['no_mak'];
            $insert_rpk->uraian = $dataRpd[0]['uraian'];
            $insert_rpk->tglFrom = $tanggalFrom;
            $insert_rpk->dayFrom = $dayFrom;
            $insert_rpk->monthFrom = $monthFrom;
            $insert_rpk->yearFrom = $yearFrom;
            $insert_rpk->tglTo = $tanggalTo;
            $insert_rpk->dayTo = $dayTo;
            $insert_rpk->monthTo = $monthTo;
            $insert_rpk->yearTo = $yearTo;
            $insert_rpk->tglFrom_update = $tanggalFrom;
            $insert_rpk->dayFrom_update = $dayFrom;
            $insert_rpk->monthFrom_update = $monthFrom;
            $insert_rpk->yearFrom_update = $yearFrom;
            $insert_rpk->tglTo_update = $tanggalTo;
            $insert_rpk->dayTo_update = $dayTo;
            $insert_rpk->monthTo_update = $monthTo;
            $insert_rpk->yearTo_update;
            $insert_rpk->save();
        }
        }
        return redirect()->route('monitoring.rpkrpd.input_rpkrpd' , $id[0] );
    }

    public function simpan_rpd(Request $request)
    {
        $id = collect($request->input('id'));
        $alokasi = collect($request->input('alokasi'));
        $tupoksi = collect($request->input('tupoksi'));
        $jan = collect($request->input('jan'));
        $feb = collect($request->input('feb'));
        $mar = collect($request->input('mar'));
        $apr = collect($request->input('apr'));
        $mei = collect($request->input('mei'));
        $jun = collect($request->input('jun'));
        $jul = collect($request->input('jul'));
        $ags = collect($request->input('ags'));
        $sep = collect($request->input('sep'));
        $okt = collect($request->input('okt'));
        $nov = collect($request->input('nov'));
        $des = collect($request->input('des'));       

        foreach ($id as $key => $value) {
            
            rpd::where('id' , '=' , $key)
                            ->update([
                                'jan' => str_replace('.', '', $jan[$key]),
                                'feb' => str_replace('.', '', $feb[$key]),
                                'mar' => str_replace('.', '', $mar[$key]),
                                'apr' => str_replace('.', '', $apr[$key]),
                                'mei' => str_replace('.', '', $mei[$key]),
                                'jun' => str_replace('.', '', $jun[$key]),
                                'jul' => str_replace('.', '', $jul[$key]),
                                'ags' => str_replace('.', '', $ags[$key]),
                                'sep' => str_replace('.', '', $sep[$key]),
                                'okt' => str_replace('.', '', $okt[$key]),
                                'nov' => str_replace('.', '', $nov[$key]),
                                'des' => str_replace('.', '', $des[$key]),
                                'jan_update' => str_replace('.', '', $jan[$key]),
                                'feb_update' => str_replace('.', '', $feb[$key]),
                                'mar_update' => str_replace('.', '', $mar[$key]),
                                'apr_update' => str_replace('.', '', $apr[$key]),
                                'mei_update' => str_replace('.', '', $mei[$key]),
                                'jun_update' => str_replace('.', '', $jun[$key]),
                                'jul_update' => str_replace('.', '', $jul[$key]),
                                'ags_update' => str_replace('.', '', $ags[$key]),
                                'sep_update' => str_replace('.', '', $sep[$key]),
                                'okt_update' => str_replace('.', '', $okt[$key]),
                                'nov_update' => str_replace('.', '', $nov[$key]),
                                'des_update' => str_replace('.', '', $des[$key]),
                                'flag_pengadaan' => $tupoksi[$key],
                            ]);

                if($tupoksi[$key] == 1)
                {
                    $getSum = DB::select('Select Sum(jan) as nilai_jan , Sum(feb) as nilai_feb ,
                                                 Sum(mar) as nilai_mar , Sum(apr) as nilai_apr ,
                                                 Sum(mei) as nilai_mei , Sum(jun) as nilai_jun ,
                                                 Sum(jul) as nilai_jul , Sum(ags) as nilai_ags ,
                                                 Sum(sep) as nilai_sep , Sum(okt) as nilai_okt ,
                                                 Sum(nov) as nilai_nov , Sum(des) as nilai_des from rpd where level = 0 group by no_mak');

                    $getrpd = rpd::where('id' , '=' , $key)->get();
                    rkakl::where('id' , '=' , $getrpd[0]['rkakl_id'])
                                ->update(['flag_pengadaan' => 1]);
                }
        
            $data = rpd::where('id' , '=' , $key)->first();
            $nomak = $data['no_mak'];


            
            

        };

            $idrpd = rpd::where('id' , '<' , $id)
                    ->where('level' , '=' , 7)
                    ->where('no_mak' , 'LIKE' , '%' . substr($nomak, 0 , strlen($nomak) - 7) . '%' )
                    ->first();
         
        $this->hitung();

        return redirect()->route('monitoring.rpkrpd.input_rpkrpd' , ['id' => $idrpd['id']]);
    }

    public function hapus_rpk($id)
    {
        

        $data = rpk::where('id' , '=' , $id)->first();
        if($data->count() >= 0)
        {
            $idrpd = $data['rpd_id'];
        }



        $hapus = rpk::where('id' , '=' , $id)->delete();

        
        // \Session::flash('success', trans('backend/master/hotel.hotel.destroy.messages.success'));

        
        return redirect()->route('monitoring.rpkrpd.input_rpkrpd' , ['id' => $idrpd]);
    }

    public function kunci_rpd($id)
    {
        $data = rpd::where('id' , '=' , $id)->first();
        $nomak = $data['no_mak'];
        $update = rpd::where('no_mak' , 'LIKE' , '%' . $nomak . '%')
                        ->update(['locked' => 1]);

        return redirect()->route('monitoring.rpkrpd.index');
    }

    public function edit_rpk(Request $request ,$id)
    {

        $tglFrom = collect($request->input('tglFrom'));
        $tglTo = collect($request->input('tglTo'));        
        
     

        foreach ($tglFrom as $key => $value) {

             $tanggalFrom = new Carbon($value); 
             $tanggalTo = new Carbon($tglTo[$key]); 

             $dayTo = $tanggalTo->day;
             $monthTo = $tanggalTo->month;
             $yearTo = $tanggalTo->year;

             $dayFrom = $tanggalFrom->day;
             $monthFrom = $tanggalFrom->month;
             $yearFrom = $tanggalFrom->year;

             $data = rpk::where('id' , '=', $id)
                            ->update([
                                'tglFrom_update'    =>  $tanggalFrom,
                                'dayFrom_update'    =>  $dayFrom,
                                'monthFrom_update'  =>  $monthFrom,
                                'yearFrom_update'   =>  $yearFrom,
                                'tglTo_update'    =>  $tanggalTo,
                                'dayTo_update'    =>  $dayTo,
                                'monthTo_update'  =>  $monthTo,
                                'yearTo_update'   =>  $yearTo,
                            ]);

            
        }


        $data = rpk::where('id' , '=' , $id)->first();
        $id = $data['rpd_id'];
        return redirect()->route('monitoring.rpkrpd.input_rpkrpd' , ['id' => $id]);
    }

    public function input_data($id)
    {
        
        $rpd = rpd::where('id' , '=' , $id)->first();

        $data = rpd::where('no_mak' , 'LIKE' , '%' . $rpd['no_mak'] . '%')->get();

        return view('backend.monitoring.rpd.input_data' , ['rpd' => $data] );
    }

    public function edit_rpd(Request $request)
    {

        $id = collect($request->input('id'));
        $alokasi = collect($request->input('alokasi'));
        $tupoksi = collect($request->input('tupoksi'));
        $jan = collect($request->input('jan_edit'));
        $feb = collect($request->input('feb_edit'));
        $mar = collect($request->input('mar_edit'));
        $apr = collect($request->input('apr_edit'));
        $mei = collect($request->input('mei_edit'));
        $jun = collect($request->input('jun_edit'));
        $jul = collect($request->input('jul_edit'));
        $ags = collect($request->input('ags_edit'));
        $sep = collect($request->input('sep_edit'));
        $okt = collect($request->input('okt_edit'));
        $nov = collect($request->input('nov_edit'));
        $des = collect($request->input('des_edit')); 
        $idrpd = 0;


        
        foreach ($id as $key => $value) {
            

            rpd::where('id' , '=' , $key)
                            ->update([
                                'jan_update' => str_replace('.', '', $jan[$key]),
                                'feb_update' => str_replace('.', '', $feb[$key]),
                                'mar_update' => str_replace('.', '', $mar[$key]),
                                'apr_update' => str_replace('.', '', $apr[$key]),
                                'mei_update' => str_replace('.', '', $mei[$key]),
                                'jun_update' => str_replace('.', '', $jun[$key]),
                                'jul_update' => str_replace('.', '', $jul[$key]),
                                'ags_update' => str_replace('.', '', $ags[$key]),
                                'sep_update' => str_replace('.', '', $sep[$key]),
                                'okt_update' => str_replace('.', '', $okt[$key]),
                                'nov_update' => str_replace('.', '', $nov[$key]),
                                'des_update' => str_replace('.', '', $des[$key]),
                                'flag_pengadaan' => $tupoksi[$key],
                            ]);
            
            if($tupoksi[$key] == 1)
            {
                $getrpd = rpd::where('id' , '=' , $key)->get();
                rkakl::where('id' , '=' , $getrpd[0]['rkakl_id'])
                            ->update(['flag_pengadaan' => 1]);
            }
            else
            {
                $getrpd = rpd::where('id' , '=' , $key)->get();
                rkakl::where('id' , '=' , $getrpd[0]['rkakl_id'])
                            ->update(['flag_pengadaan' => 0]);
            }

            $data = rpd::where('id' , '=' , $key)->first();
            $nomak = $data['no_mak'];


            
            $idrpd = rpd::where('id' , '<' , $id)
                    ->where('level' , '=' , 7)
                    ->where('no_mak' , 'LIKE' , '%' . substr($nomak, 0 , strlen($nomak) - 7) . '%' )
                    ->first();

                    
        };

        $this->hitung();
        

        return redirect()->route('monitoring.rpkrpd.input_rpkrpd' , ['id' => $idrpd['id']]);
    }

    public function hitung()
    {
        $thn_ang = Parameter::where('id' , '=' , 1)->first();
        $eselon = eselon::all();

        foreach ($eselon as $key => $value) {
            $rkakl = rkakl::where('eselon_id' , '=' , $value->id)
                            ->where('level' , '=' , 9)
                            ->first();
            $pagu = $rkakl['jumlah'];


            $DataRPD = DB::select("select  SUM(jan_update) AS jan , SUM(feb_update) AS feb 
                                    , SUM(mar_update) AS mar , SUM(apr_update) AS apr 
                                    , SUM(mei_update) AS mei , SUM(jun_update) AS jun 
                                    , SUM(jul_update) AS jul , SUM(ags_update) AS ags 
                                    , SUM(sep_update) AS sep , SUM(okt_update) AS okt 
                                    , SUM(nov_update) AS nov , SUM(des_update) AS des 
                                  FROM rpd a JOIN bagian_eselon b ON a.`bagian_id` = b.`bagian_id` WHERE b.`eselon_id` = ". $value->id ." AND a.`level` = 0 AND a.`uraian` NOT LIKE '%>%';");

            foreach ($DataRPD as $key2 => $value2) {
                $nilai_Jan =  ((double)$value2->jan / (double)$pagu ) * 100 ;
                $nilai_Feb =  (((double)$value2->feb / (double)$pagu ) * 100 ) + $nilai_Jan ; 
                $nilai_Mar =  (((double)$value2->mar / (double)$pagu ) * 100 ) + $nilai_Feb ;  
                $nilai_Apr =  (((double)$value2->apr / (double)$pagu ) * 100 ) + $nilai_Mar ;
                $nilai_Mei =  (((double)$value2->mei / (double)$pagu ) * 100 ) + $nilai_Apr ;
                $nilai_Jun =  (((double)$value2->jun / (double)$pagu ) * 100 ) + $nilai_Mei ;
                $nilai_Jul =  (((double)$value2->jul / (double)$pagu ) * 100 ) + $nilai_Jun ;
                $nilai_Ags =  (((double)$value2->ags / (double)$pagu ) * 100 ) + $nilai_Jul ;
                $nilai_Sep =  (((double)$value2->sep / (double)$pagu ) * 100 ) + $nilai_Ags ;
                $nilai_Okt =  (((double)$value2->okt / (double)$pagu ) * 100 ) + $nilai_Sep ;
                $nilai_Nov =  (((double)$value2->nov / (double)$pagu ) * 100 ) + $nilai_Okt ;
                $nilai_Des =  (((double)$value2->des / (double)$pagu ) * 100 ) + $nilai_Nov ;
            }
            
            $DataRpdSummary = Rpdsummary::where('eselon_id' , '=' , $value->id)->get();
            $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
            if($DataRpdSummary->Count() == 0)
            {
                foreach ($bulan as $key3 => $value3) {
                
                    $insert_rpdsum = new Rpdsummary;
                    $insert_rpdsum->tahun_Ang = $thn_ang['value'];
                    $insert_rpdsum->bulan = $value3;
                    $insert_rpdsum->nilai = 0;
                    $insert_rpdsum->nilai_perubahan = 0;
                    $insert_rpdsum->eselon_id = $value->id;
                    $insert_rpdsum->realisasi = 0;
                    $insert_rpdsum->save();

                }

            }           
            
            foreach ($bulan as $key3 => $value3) {
               switch ($value3) {
                   case 'Jan':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Jan ]);
                       break;
                  case 'Feb':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Feb ]);
                       break;
                  case 'Mar':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Mar ]);
                       break;
                  case 'Apr':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Apr ]);
                       break;
                  case 'Mei':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Mei ]);
                       break;
                  case 'Jun':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Jun ]);
                       break;
                   case 'Jul':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Jul ]);
                       break;
                  case 'Ags':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Ags ]);
                       break;
                  case 'Sep':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Sep ]);
                       break;
                  case 'Okt':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Okt ]);
                       break;
                  case 'Nov':
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Nov ]);
                       break;
                   default:
                       Rpdsummary::where('bulan' , '=' , $value3)
                                ->where('eselon_id' , '=' , $value->id)
                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->update([ 'nilai' => $nilai_Des ]);
                       break;
               }
            }
        }


    }

    public function generate()
    {
        $thn_ang = Parameter::where('id' , '=' , 1)->first();
        $dataEselon = Eselon::all();

        foreach ($dataEselon as $key => $value) {
            $dataRpd = Rpdsummary::where('eselon_id' , '=' , $value->id)->get();
            if($dataRpd->Count() == 0)
            {
                $bulan = ['jan' , 'feb' , 'mar' , 'apr' , 'mei' , 'jun' , 'jul' , 'ags' , 'sep' , 'okt' , 'nov' , 'des'];

                for ($i=0; $i <= Count($bulan) - 1 ; $i++) { 
                    
                    $insert_rpdsum = new Rpdsummary();
                    $insert_rpdsum->tahun_Ang = $thn_ang['value'];
                    $insert_rpdsum->bulan = $bulan[$i];
                    $insert_rpdsum->nilai = 0;
                    $insert_rpdsum->eselon_id = $value->id;
                    $insert_rpdsum->save();

                }
            }
            else
            {
                
            }
        }        
    }

    public function report()
    {
        $bagian_id  =   Auth::User()->bagian_id;
        $eselon_id  =   BagianEselon::where('bagian_id' , '=' , $bagian_id)->first();
        $eselon     =   Eselon::where('id' , '=' , $eselon_id->eselon_id)->first();
        $rpd = Rpd::where('level' , '!=' , 0)
        			->where('eselon_id' , '=' , $eselon_id->eselon_id)
                    ->OrderBy('no_mak' , 'ASC')->get();

        $data = [];
        foreach ($rpd as $key => $value) {
             $data[$key] = array(
            'kode'      => $value->kode,
            'uraian'    => $value->uraian,
            'jumlah'    => $value->pagu,
            'jan'       => $value->jan_update,
            'feb'       => $value->feb_update,
            'mar'       => $value->mar_update,
            'apr'       => $value->apr_update,
            'mei'       => $value->mei_update,
            'jun'       => $value->jun_update,
            'jul'       => $value->jul_update,
            'ags'       => $value->ags_update,
            'sep'       => $value->sep_update,
            'okt'       => $value->okt_update,
            'nov'       => $value->nov_update,
            'des'       => $value->des_update,
            'total'     => $value->jan_update + $value->feb_update + $value->mar_update + $value->apr_update + $value->mei_update + $value->jun_update + $value->jul_update + $value->ags_update + $value->sep_update + $value->okt_update + $value->nov_update + $value->des_update

            );
        };

        
       

        // $pdf = PDF::loadView('backend.monitoring.rpd.laporan.report_rpd', ['satker' => $eselon , 'rpd' => $data ])->setPaper('legal' , 'landscape');

        // return $pdf->download('notadinas_'.Carbon::now()->format('d-m-Y').'.pdf');

        return view('backend.monitoring.rpd.laporan.report_rpd' , ['satker' => $eselon , 'rpd' => $data ]);
    }

    public function get_report()
    {
        $rpd = Rpd::where('level' , '!=' , 0)
                    ->OrderBy('no_mak' , 'ASC')->get();
        return $rpd;
    }


}
