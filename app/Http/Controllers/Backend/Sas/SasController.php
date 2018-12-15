<?php

namespace App\Http\Controllers\Backend\Sas;

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
use App\Models\Backend\Sas\sas;
use App\Models\Backend\Sas\SasJnsBel;

use App\Models\Backend\Dashboard\realisasipengadaan;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Charts;

class SasController extends Controller
{
    public function index()
    {
       $Parameter = Parameter::where('name' , 'Tahun Anggaran')->get();
       $user_data = Auth::user();
		$bagianEselon = BagianEselon::where('bagian_id' , $user_data['bagian_id'])->get();
       $Data_SAS	= Sas::where('eselon_id' ,$bagianEselon[0]['eselon_id']) ->get();
       
       return view('Backend.sas.index' , ['TahunAng' => $Parameter[0]['value'] , 'Data' => $Data_SAS]);
    }

    public function upload_excel(Request $request)
    {
    	ini_set('max_execution_time', 600);
    	ini_set('memory_limit',-1);

    	if(Input::hasFile('import_file'))
    	{
    		DB::table('sas_upload_pagu')->delete();
    		$file = Input::file('import_file');
        	$file_path = $file->getRealPath();
        	$data = Excel::load($file_path)->get();
			$import_data = [];
			$user_data = Auth::user();
			$bagianEselon = BagianEselon::where('bagian_id' , $user_data['bagian_id'])->get();
      		
          	foreach ($data as $key => $value) {
				$import_file['eselon_id'] 	=  $bagianEselon[0]['eselon_id'];
				$no_mak_sys = '';
				

				if(trim($value->level) == 1)
				{
					$no_mak_sys = trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram);
				}

				if(trim($value->level) == 2)
				{
					$no_mak_sys	=  trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram) . '.' . trim($value->kdgiat);
				}

				if(trim($value->level) == 3)
				{
					$no_mak_sys 	=  trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram) . '.' . trim($value->kdgiat) . '.' . trim($value->kdoutput);
				}

				if(trim($value->level) == 5)
				{
					$no_mak_sys 	=  trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram) . '.' . trim($value->kdgiat) . '.' . trim($value->kdoutput) . '.' . trim($value->kdkmpnen);
				}

				if(trim($value->level) == 6)
				{
					$no_mak_sys 	=  trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram) . '.' . trim($value->kdgiat) . '.' . trim($value->kdoutput) . '.' . trim($value->kdkmpnen) . '.' . trim($value->kdskmpnen);
				}

				if(trim($value->level) == 7)
				{
					$cek = sas::where('no_mak_sys' , 'LIKE' , '%' . trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram) . '.' . trim($value->kdgiat) . '.' . trim($value->kdoutput) . '.' . trim($value->kdkmpnen) . '%')
											->where('level' , 6)
											->get();
					
						if(Count($cek))
						{
							$no_mak_sys 	=  trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram) . '.' . trim($value->kdgiat) . '.' . trim($value->kdoutput) . '.' . trim($value->kdkmpnen) . '.' . trim($value->kdskmpnen) . '.' . trim($value->jnsbel);		
						}
						else
						{
							$no_mak_sys 	=  trim($value->kddept) . '.' . trim($value->kdunit) . '.' . trim($value->kdprogram) . '.' . trim($value->kdgiat) . '.' . trim($value->kdoutput) . '.' . trim($value->kdkmpnen) . '.' . trim($value->jnsbel);
						}
						
					
				}

				$data_rkakl 				= Rkakl::where('no_mak_sys' , $no_mak_sys)
													->where('eselon_id' , $bagianEselon[0]['eselon_id'] )->get(['uraian']);
				

				$import_file['no_mak_sys']	=  $no_mak_sys;
				$import_file['level'] 		=  trim($value->level);
				$import_file['thang'] 		=  trim($value->thang);
				$import_file['kdjendok'] 	=  trim($value->kdjendok);
				$import_file['kdsatker'] 	=  trim($value->kdsatker);
				$import_file['kddept'] 		=  trim($value->kddept);
				$import_file['kdunit'] 		=  trim($value->kdunit);
				$import_file['kddekon'] 	=  trim($value->kddekon);
				$import_file['nokarwas'] 	=  trim($value->nokarwas);
				$import_file['kdprogram'] 	=  trim($value->kdprogram);
				$import_file['kdgiat'] 		=  trim($value->kdgiat);
				$import_file['kdlokasi'] 	=  trim($value->kdlokasi);
				$import_file['kdkabkota'] 	=  trim($value->kdkabkota);
				$import_file['kdoutput'] 	=  trim($value->kdoutput);
				$import_file['kdsoutput'] 	=  trim($value->kdsoutput);
				$import_file['kdkmpnen'] 	=  trim($value->kdkmpnen);
				$import_file['kdskmpnen'] 	=  trim($value->kdskmpnen);
				$import_file['kdkppn'] 		=  trim($value->kdkppn);
				$import_file['kdbeban'] 	=  trim($value->kdbeban);
				$import_file['kdjnsban'] 	=  trim($value->kdjnsban);
				$import_file['register'] 	=  trim($value->register);
				$import_file['kdctarik'] 	=  trim($value->kdctarik);
				$import_file['jnsbel'] 		=  trim($value->jnsbel);
				$import_file['paguakhir'] 	=  trim($value->paguakhir);
				$import_file['trmskpa'] 	=  trim($value->trmskpa);
				$import_file['kembel'] 		=  trim($value->kembel);
				$import_file['klrskpa'] 	=  trim($value->klrskpa);
				$import_file['nilblokir'] 	=  trim($value->nilblokir);
				$import_file['pagu'] 		=  trim($value->pagu);
				$import_file['realisasi'] 	=  trim($value->realisasi);
				$import_file['sisa'] 		=  trim($value->sisa);
				$import_file['realspmgu'] 	=  trim($value->realspmgu);
				$import_file['realnongu'] 	=  trim($value->realnongu);
				$import_file['realkwt'] 	=  trim($value->realkwt);
				$import_file['realgu'] 		=  trim($value->realgu);
				if(Count($data_rkakl))
				{
					$import_file['ket'] 		=  $data_rkakl[0]['uraian'];	
				}
				
				$import_file['kode'] 		=  trim($value->kode);
				$import_file['kdindex'] 	=  trim($value->kdindex);
				$import_file['kdanaks'] 	=  trim($value->kdanaks);

				if($value->level != 4)
				{
					if(trim($value->ket) != "A   tanpa sub komponen" )
					{
						DB::table('sas_upload_pagu')->insert($import_file);		
					}
					
				}
				
				
        	}

        	
        	// $Data_Upload = sas::where('ket' , 'Like' , '%_x000D_[Base Line]%')->get();
        	// foreach ($Data_Upload as $key => $value) {
        	// 	$uraian = substr($value->ket, 0 , strlen($value->ket) - 18);
        	// 	$update = sas::where('id' , $value->id)
        	// 				->update(['ket' => $uraian]);
        	// }
        	
        	


    		return redirect()->route('keuangan.sas.index');	
    	}
    }

    public function dashboard()
    {
    	return view('Backend.dashboard.sas.index');
    }

    public function realisasi()
    {
    	$Parameter = Parameter::where('name' , 'Tahun Anggaran')->get();
    	
    	
			$Data_SAS	= DB::table('sas_upload_pagu')
       							->join('eselon' , 'sas_upload_pagu.eselon_id' , 'eselon.id')
       							->select(DB::raw('SUM(paguakhir) AS pagu , SUM(realisasi) AS realisasi'))
       							->where('sas_upload_pagu.level' , 1)
       							->where('thang' , $Parameter[0]['value'])
       							->get();
       
       	$Data = [];
       	foreach ($Data_SAS as $key => $value) {
       			$Data['pagu'] 		= $value->pagu;
       			$Data['realisasi']	= $value->realisasi;
       			}		

       	return $Data;
    }

    public function jenis_belanja()
    {
    	$Parameter = Parameter::where('name' , 'Tahun Anggaran')->get();
    	$user_data = Auth::user();
		$bagianEselon = BagianEselon::where('bagian_id' , $user_data['bagian_id'])->get();

		$cek1 = SasJnsBel::where('eselon_id' , $bagianEselon[0]['eselon_id'])->get();
		if(Count($cek1) == 0)
		{

			$DataJenisBelanja = JenisBelanja::all();

			foreach ($DataJenisBelanja as $key => $value) {
				$Insert = new SasJnsBel;
				$Insert->eselon_id 				= $bagianEselon[0]['eselon_id'];
				$Insert->thang 					= $Parameter[0]['value'];
				$Insert->code_jenis_belanja 	= $value->code;
				$Insert->desc_jenis_belanja 	= $value->description;
				$Insert->pagu 					= 0;
				$Insert->realisasi 				= 0;
				$Insert->save();
			}
		}

		// $DataSAS = DB::select('select eselon_id , SUBSTR(jnsbel , 1 , 2) AS CODE , SUM(paguakhir) AS pagu , SUM(realisasi) AS realisasi FROM sas_upload_pagu WHERE LEVEL = 7 GROUP BY SUBSTR(jnsbel , 1 , 2) , eselon_id');
		$DataSAS = DB::table('sas_upload_pagu')
					->select(DB::raw('SUBSTR(jnsbel , 1 , 2) AS kode') , 'eselon_id' , DB::raw('SUM(paguakhir) AS pagu') , DB::raw('SUM(realisasi) AS realisasi'))
					->where('level' , 7)
					->groupby(DB::raw('SUBSTR(jnsbel , 1 , 2)'))
					->groupby('eselon_id')
					->get();
		$Data = [];
		foreach ($DataSAS as $key => $value ) {

			$DataJnsBel = SasJnsBel::where('code_jenis_belanja' , $value->kode)
									->where('thang' , $Parameter[0]['value'])
									->where('eselon_id' , $value->eselon_id)
									->update(
										[
											'pagu' 		=> $value->pagu,
											'realisasi'	=> $value->realisasi
										]);
		}

		$RealJnsBel = SasJnsBel::all();

		return $RealJnsBel;
    }

    public function get_spm_sp2d()
    {
    	$Parameter = Parameter::where('name' , 'Tahun Anggaran')->get();

    	$Data_SP2D = DB::table('sas_sp2d')
    					->select(DB::raw('SUM(nilai_spm) as total_spm , SUM(nilai_sp2d) as total_sp2d') , 'eselon_id')
    					->whereYear('tgl_spm' , $Parameter[0]['value'])
    					->groupby('eselon_id')
    					->get();

    	// return $Data_SP2D;

    	$Data = [];
    	foreach ($Data_SP2D as $key => $value) {
    		$Data[$key]['spm'] 	= $value->total_spm;
    		$Data[$key]['sp2d']	= $value->total_sp2d;
    		$Data_Eselon = Eselon::where('id', $value->eselon_id)->get();
    		$Data[$key]['satker'] = $Data_Eselon[0]['nama_singkat'];
    	}

    	return $Data;
    }

    public function get_rm_pnbp()
    {
    	$Parameter = Parameter::where('name' , 'Tahun Anggaran')->get();

    	$Data_RM = DB::table('sas_upload_pagu')
    					->select('eselon_id' , 'kdbeban' , DB::raw('SUM(paguakhir) AS pagu , SUM(realisasi) AS realisasi'))
    					->groupby('kdbeban' , 'eselon_id')
    					->where('thang' , $Parameter[0]['value'])
    					->get();

    	$Data = [];
    	foreach ($Data_RM as $key => $value) {
    		$Data[$key]['pagu'] 		= $value->pagu;
    		$Data[$key]['realisasi'] 	= $value->realisasi;
			$Data_Eselon = Eselon::where('id', $value->eselon_id)->get();
    		$Data[$key]['satker'] = $Data_Eselon[0]['nama_singkat'];

    	}

    }
}