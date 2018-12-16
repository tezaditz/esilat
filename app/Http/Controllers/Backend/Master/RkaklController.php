<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\eselon_rkakl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Backend\Parameter;
use App\Models\Backend\Master\user_eselon;
use Auth;
use DB;
use App\Models\Backend\Rpd;

class RkaklController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tahunAng = parameter::where('id' , '=' , 1)->first();
        $iduser = DB::select('select bagian_eselon.`eselon_id` as eselon_id FROM bagian_eselon JOIN users ON bagian_eselon.`bagian_id` = users.`bagian_id` where users.id = ?' , [Auth::user()->id]);
        
        foreach ($iduser as $key => $value) {
            $ideselon = $value->eselon_id;
        }

        
        
         $rkakls = Rkakl::where('tahun', '=', $tahunAng['value'])
                            ->where('eselon_id' , '=' , $ideselon)->get();
        
        return view('backend.master.rkakl.index', ['rkakls' => $rkakls , 'tahunAng' => $tahunAng['value']]);
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function import()
    {
        

        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();

            if (!empty($data) && $data->count()) {
                $y  = '';
                $no = 0;

                $a = "";$b = "";$c = "";$d = "";$e = "";$f="";


                $tahunAng = parameter::where('id' , '=' , 1)->first();
                $iduser = Auth::user()->id;
                $userEselon = user_eselon::where('user_id' , '=' , $iduser)->first();
                foreach ($data as $key => $value) {
                    $no = $no + 1;

                    switch (strlen($value->kode)) {
                        case 9:
                            $a      = trim($value->kode);
                            $no_mak = $a;
                            break;
                        case 4:
                            $b      = trim($value->kode);
                            $no_mak = $a . "." . $b;
                            break;
                        case 8:
                            $c      = trim($value->kode);
                            $no_mak = $a . "." . $c;
                            break;
                        case 6:
                            $d      = trim($value->kode);
                            $no_mak = $a . "."  . $c . "." . $d;
                            break;
                        case 7:
                            $e      = trim($value->kode);
                            $no_mak = $a . "." . $c . "." . $d . "." . $e;
                            break;
                        case 11:
                            $f      = trim($value->kode);
                            if($e == "")
                            {
                                $no_mak = $a . "." . $c . "." . $d . "." . $f;
                            }
                            else
                            {
                                $no_mak = $a . "." . $c . "." . $d . "." . $e . "." . $f;    
                            }
                            
                            break;
                        default:
                            if($e == "")
                            {
                                $no_mak = $a . "." . $c . "." . $d . "." . $f;    
                            }
                            else
                            {
                                $no_mak = $a . "." . $c . "." . $d . "." . $e . "." . $f;    
                            }
                            
                        break;
                    }

                    if (strlen($value->kode) != 0) {
                        $no_mak_sys = $no_mak;
                    } else {
                        if ($y != $no_mak) {
                            $y          = $no_mak;
                            $z          = 1;
                            $no_mak_sys = $no_mak . '.' . $z;
                        } else {
                            $z          = $z + 1;
                            $no_mak_sys = $no_mak . '.' . $z;
                        }
                    }

                    if (strlen($value->kode) != 0 ) {
                        
                     $getbagianid = rpd::where('no_mak' , $no_mak)
                                ->get(['bagian_id']);

                    $bagianID = 0;
                    if(Count($getbagianid))
                    {
                        $bagianID =  $getbagianid[0]['bagian_id'];    
                    }                    




                    $insert[] = [
                        'no_rkakl'   => $no,
                        'kode'       => $value->kode,
                        'level'      => strlen($value->kode),
                        'no_mak'     => $no_mak,
                        'no_mak_sys' => $no_mak_sys,
                        'uraian'     => $value->uraian,
                        'vol'        => $value->vol,
                        'sat'        => $value->sat,
                        'hargasat'   => $value->hargasat,
                        'jumlah'     => $value->jumlah,
                        'sdana'      => $value->sdana,
                        'tahun'      => $tahunAng['value'],
                        'eselon_id'  => $userEselon['eselon_id'],
                        'bagian_id'  => $bagianID,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                   
                }
                }

                        
                
                if (!empty($insert)) {

                    $tahunAng = parameter::where('id' , '=' , 1)->first();
                    $iduser = Auth::user()->id;
                    $userEselon = user_eselon::where('user_id' , '=' , $iduser)->first();


                    // $data = DB::delete('delete FROM rkakl JOIN eselon_rkakl ON rkakl.`id` = eselon_rkakl.`rkakl_id` WHERE eselon_rkakl.`eselon_id` = :eselonid AND rkakl.`tahun` = :tahun' , ['eselonid' => $userEselon , 'tahun' => $tahunAng['value'] ]);

                    rkakl::where('tahun' , '=' , $tahunAng['value'])
                            ->where('eselon_id' , '=' , $userEselon)->delete();
                        
                        
                            
                    Rkakl::insert($insert);
                    
                    Rkakl::where('uraian', 'like', '%>>%')
                        ->update(['header' => 2]);
                    Rkakl::where('uraian', 'like', '%>%')
                        ->whereNull('header')
                        ->update(['header' => 1]);


                    \Session::flash('success', trans('backend/rkakl.rkakl.store.messages.success'));

                    return redirect()->route('master.rkakl.index')->withInput();
                }
            }
        }
        \Session::flash('info', trans('backend/rkakl.rkakl.store.messages.info'));

        return redirect()->route('master.rkakl.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $rkakls = Rkakl::where('tahun', '=', date('Y'))
            ->where($request->options, 'like', '%' . $request->search . '%')
            ->get();

        return view('backend.master.rkakl.index', ['rkakls' => $rkakls]);
    }
}