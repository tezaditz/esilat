<?php

namespace App\Http\Controllers\Backend\Keuangan;

use Illuminate\Http\Request;
use App\Models\Backend\Keuangan\SPM;
use App\Models\Backend\Keuangan\jenisspm;
use App\Models\Backend\Keuangan\spmdetail;
use App\Models\Backend\Pengajuan\kegiatan;
use App\Models\Backend\Pengajuan\DetailAkun;
use App\Models\Backend\Pengajuan\Perjadin\PerjadinAkun;
use App\Models\Backend\Pengajuan\LayananPerkantoran\Perkantoran;
use App\Http\Controllers\Controller;
use App\Models\Backend\Master\Status;
use DB;

class spmController extends Controller
{
    public function index()
    {
        $SPM01 = status::where('kode_status' , '=' , 'SPM01')->first();
        $SPM02 = status::where('kode_status' , '=' , 'SPM01')->first();
        $spm = SPM::whereIn('status_spm' , [ $SPM01->id , $SPM02->id ])->paginate(100);
    	$total = SPM::count();
        $jenisspm = jenisspm::where('show' , '=' , 1)->get();
        
        
    	return view('backend.keuangan.spm.index' , ['spm' => $spm , 'total' => $total , 'jnsspm' => $jenisspm]);
    }

    public function store(Request $request)
    {

        $SPM00  = status::where('kode_status' , '=' , 'SPM00')->first();

    	$spm = new SPM();
    	$spm->nomor_spm = $request->nomor_spm;
    	$spm->tanggal_spm = $request->tanggal_spm;
    	$spm->metode_bayar = $request->metode_bayar;
        $spm->status_spm = $SPM00->id;
    	$spm->save();

        $idspm = SPM::where('nomor_spm' , '=' , $request->nomor_spm)->first();

    	\Session::flash('success', trans('backend/keuangan.SPM.store.messages.success'));

        return redirect()->route('keuangan.spm.detail_spm' , ['id' => $idspm])->withInput();

    }

    public function detail_spm($id)
    {
    	$spmdetail = spmdetail::where('id_spm' , '=' , $id)->get();

        return view('backend.keuangan.spm_detail.index' , ['spmdetail' => $spmdetail , 'id' => $id]);
    }

    public function kegiatan_list($id)
    {
        $KG04 = Status::where('kode_status', '=', 'KG04')->first();
        $KG05 = Status::where('kode_status', '=', 'KG05')->first();
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $KG07 = Status::where('kode_status', '=', 'KG14')->first();


        
        $total = kegiatan::whereIn('status_id' , [  $KG05->id ,$KG06->id ])->count();
    
        $kegiatan = DB::select('select b.`no_pengajuan2` as no_pengajuan2 , b.`tgl_pengajuan` as tgl_pengajuan , b.`nama_kegiatan` as nama_kegiatan  , b.`no_mak` as no_mak , a.* FROM detail_akun a JOIN kegiatan b ON b.`id` = a.`kegiatan_id` where a.status_id in ( ' . $KG05->id . ' , '. $KG06->id .' ) and ISNULL(a.no_spm)');



        return view('backend.keuangan.spm_detail.data_kegiatan' , ['data' => $kegiatan , 'total' => $total , 'id' => $id]);
    }

    public function simpan_kegiatan(Request $request)
    {
        $data = collect($request->input('chk'));
        $nilai = collect($request->input('nilai'));
        $id = $request->idspm;


        foreach ($data as $key => $value) {


            $idkeg          = DetailAkun::where('id' , '=' , $value) ->first();
            $DataKegiatan   = Kegiatan::where('id' , '=' , $idkeg['kegiatan_id'])->first();


            $spmdetail = new spmdetail();
            $spmdetail->id_spm = $id;
            $spmdetail->keterangan = 'Kegiatan';
            $spmdetail->id_transaksi = $idkeg['kegiatan_id'];
            $spmdetail->deskripsi = $DataKegiatan['nama_kegiatan'];
            $spmdetail->no_mak = $DataKegiatan['no_mak'] . '.' . $idkeg['akun'];
            $spmdetail->nilai_transaksi = $nilai[$value];
            $spmdetail->save();

            $nospm = SPM::where('id' , '=' , $id)->first();

            DetailAkun::where('id' , '=' , $value)
                        ->update([
                            'spm_id' => $id,
                            'no_spm' => $nospm['nomor_spm'],
                        ]);



        }

        \Session::flash('success', trans('backend/keuangan.spm_detail.kegiatan.messages.success'));

        return redirect()->route('keuangan.spm.detail_spm' , [ 'id' => $id ])->withInput();

    }


}
