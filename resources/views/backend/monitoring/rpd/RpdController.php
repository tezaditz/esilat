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
use Carbon\Carbon;
use App\Models\Backend\Parameter;
use App\Models\Backend\Rpdsummary\Rpdsummary;

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
         

        return redirect()->route('monitoring.rpkrpd.input_rpkrpd' , ['id' => $idrpd['id']]);
    }

    public function hapus_rpk($id)
    {
        if (is_null($id)) {
            // \Session::flash('info', trans('backend/master/hotel.hotel.destroy.messages.info'));

            return redirect()->route('monitoring.rpkrpd.index');
        }

        rpk::destroy($id);
        // \Session::flash('success', trans('backend/master/hotel.hotel.destroy.messages.success'));

        return redirect()->route('monitoring.rpkrpd.index');
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

        
        

        return redirect()->route('monitoring.rpkrpd.input_rpkrpd' , ['id' => $idrpd['id']]);
    }

    public function hitung()
    {
        $thn_ang = Parameter::where('id' , '=' , 1)->first();
        $bagianid = Auth::user()->bagian_id;
        $eselonid = BagianEselon::where('bagian_id' , '=' , $bagianid)->first();

        $pagu = rkakl::where('level' , '=' , 9)
                    ->where('eselon_id' , '=' , $eselonid['eselon_id'])
                    ->where('tahun' , '=' , $thn_ang['value'])
                    ->first();

        $dataRPD = DB::table('rpd')
                        ->select(DB::raw('SUM(jan) as jan , SUM(feb) as feb , SUM(mar) as mar
                                          ,SUM(apr) as apr , SUM(mei) as mei , SUM(jun) as jun
                                          ,SUM(jul) as jul , SUM(ags) as ags , SUM(sep) as sep
                                          ,SUM(okt) as okt , SUM(nov) as nov , SUM(des) as des'))
                        ->get();

        $percent = [];
        foreach ($dataRPD as $key => $value) {
            $percent[0]     = doubleval($value->jan) / doubleval($pagu['jumlah']) * 0.1;
            $percent[1]     = (doubleval($value->feb) / doubleval($pagu['jumlah']) * 0.1)   + $percent[0];
            $percent[2]     = (doubleval($value->mar) / doubleval($pagu['jumlah']) * 0.1)   + $percent[1];
            $percent[3]     = (doubleval($value->apr) / doubleval($pagu['jumlah']) * 0.1)   + $percent[2];
            $percent[4]     = (doubleval($value->mei) / doubleval($pagu['jumlah']) * 0.1)   + $percent[3];
            $percent[5]     = (doubleval($value->jun) / doubleval($pagu['jumlah']) * 0.1)   + $percent[4];
            $percent[6]     = (doubleval($value->jul) / doubleval($pagu['jumlah']) * 0.1)   + $percent[5];
            $percent[7]     = (doubleval($value->ags) / doubleval($pagu['jumlah']) * 0.1)   + $percent[6];
            $percent[8]     = (doubleval($value->sep) / doubleval($pagu['jumlah']) * 0.1)   + $percent[7];
            $percent[9]     = (doubleval($value->okt) / doubleval($pagu['jumlah']) * 0.1)   + $percent[8];
            $percent[10]    = (doubleval($value->nov) / doubleval($pagu['jumlah']) * 0.1)   + $percent[9];
            $percent[11]    = (doubleval($value->des) / doubleval($pagu['jumlah']) * 0.1)   + $percent[10];



            $rpdsum = Rpdsummary::where('tahun_Ang' , '=' , $thn_ang['value'])
                                ->where('eselon_id' , '=', $eselonid['eselon_id'])
                                ->get();

            if($rpdsum->count() == 0)
            {
                $bulan = ['jan' , 'feb' , 'mar' , 'apr' , 'mei' , 'jun' , 'jul' , 'ags' , 'sep' , 'okt' , 'nov' , 'des'];

                for ($i=0; $i <= Count($bulan) - 1 ; $i++) { 
                    
                    $insert_rpdsum = new Rpdsummary();
                    $insert_rpdsum->tahun_Ang = $thn_ang['value'];
                    $insert_rpdsum->bulan = $bulan[$i];
                    $insert_rpdsum->nilai = number_format($percent[$i]);
                    $insert_rpdsum->eselon_id = $eselonid['eselon_id'];
                    $insert_rpdsum->save();

                }
            }
            else
            {
                $update_rpdSummary = Rpdsummary::where('eselon_id' , '=' , $eselonid['eselon_id'])
                                                ->where('tahun_Ang' , '=' , $thn_ang['value'])
                                                ->where('bulan' , '=' , $bulan[$i])
                                                ->update([
                                                    'nilai' => number_format($percent[$i] ,2)
                                                ]);
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

}
