<?php

namespace App\Http\Controllers\Backend\Pengajuan\Perjadin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Master\Status;
use App\Models\Backend\PertanggungJawaban\Perjadin;
use App\Models\Backend\PertanggungJawaban\DataPerjadin;
use App\Models\Backend\Pengajuan\Perjadin\PerjadinAkun;
use App\Models\Backend\Pimpinan;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Provinsi;
use App\Models\Backend\Master\KabKota;
use App\Models\Backend\Master\Bagian;
use App\Models\Backend\Master\Pejabat;
use App\Models\Backend\Master\BagianEselon;
use App\Models\Backend\Parameter;
use App\Models\Backend\Rpd;
use App\Models\Backend\Rpk;
use App\Models\Backend\Master\NoPengajuan;
use App\Models\Backend\Pengajuan\Jadwal;
use App\Models\Backend\Pengajuan\Transaksi;
use Carbon\Carbon;
use PDF;
use DB;
use Auth;

class PerjadinController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $akun = Parameter::where('name' , '=' , 'Akun Perjadin')->first();
        $thn_ang = Parameter::where('id' , '=' , 1)->first();
        $bagianid = Auth::user()->bagian_id;
        $eselonid = BagianEselon::where('bagian_id' , '=' , $bagianid)->first();

        $datas = DB::select('select no_mak from rkakl where kode in ('. $akun['value'] .') and eselon_id = '. $eselonid['eselon_id'] .' and bagian_id = ' . $bagianid . ' and tahun = ' . $thn_ang['value'] . '');
        
                $datas = DB::select('select SUBSTR(no_mak_sys , 1 , LENGTH(no_mak_sys) - 7) as no_mak from rkakl where kode in ('. $akun['value'] .') and eselon_id = '. $eselonid['eselon_id'] .' and bagian_id = ' . $bagianid . ' and tahun = ' . $thn_ang['value'] . ' group by SUBSTR(no_mak_sys , 1 , LENGTH(no_mak_sys) - 7)');
        
        
        $rkakls = [];
        
        foreach ($datas as $key => $value) {
            $nomaks = $value->no_mak;
            $rkakl_data = Rkakl::where('no_mak_sys' , '=' , $nomaks)
                                ->get();


                $realisasi = $rkakl_data[0]['realisasi'] + $rkakl_data[0]['realisasi_2'] + $rkakl_data[0]['realisasi_3'];

                array_push($rkakls, ['no_mak' => $rkakl_data[0]['no_mak_sys'] , 'uraian' => $rkakl_data[0]['uraian'] , 'jumlah' => $rkakl_data[0]['jumlah'] , 'realisasi' => $realisasi ]); 
            
        }

        $bagians   = Bagian::findOrFail(\Auth::user()->bagian_id);
        $provinsis = Provinsi::get();
        $kotas     = KabKota::get();

        $PR03 = Status::where('kode_status', '=', 'PR03')->first();
        $PR00 = Status::where('kode_status', '=', 'PR00')->first();
        $PR91 = Status::where('kode_status', '=', 'PR91')->first();
        $PR01 = Status::where('kode_status', '=', 'PR01')->first();
        $PR02 = Status::where('kode_status', '=', 'PR02')->first();

        if (\Auth::user()->hasRole('user')) {
    		$perjadins = Perjadin::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PR01->id, $PR02->id, $PR03->id, $PR00->id, $PR91->id])
                ->where('bagian_id', \Auth::user()->bagian_id)
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('ppk')) {
            $perjadins = Perjadin::orderBy('created_at', 'asc')
                ->where('status_id', '=', $PR01->id)
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('bendahara')) {
    		$perjadins = Perjadin::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PR01->id, $PR02->id, $PR03->id])
                ->paginate(10);
    	} else {
            $perjadins = Perjadin::orderBy('created_at', 'asc')
                ->paginate(10);
    	}

    	return view('backend.pengajuan.perjadin.index', [
            'perjadins' => $perjadins,
            'rkakls'    => $rkakls,
            'bagians'   => $bagians,
            'kotas'     => $kotas,
            'provinsis' => $provinsis
        ]);
    }

    /**
     * @param $judul
     * @return mixed
     */
   public function memuatMak($judul)
   {
        $akun = Parameter::where('name' , '=' , 'Akun Perjadin')->first();
        $thn_ang = Parameter::where('id' , '=' , 1)->first();
        $bagianid = Auth::user()->bagian_id;
        $eselonid = BagianEselon::where('bagian_id' , '=' , $bagianid)->first();

        $maks = DB::select('select id , kode , no_mak , uraian , FORMAT(jumlah - realisasi, 0) as alokasi from rkakl where  kode in ('. $akun['value'] .') and eselon_id = '. $eselonid['eselon_id'] .' and bagian_id = ' . $bagianid . ' and tahun = ' . $thn_ang['value'] . ' and no_mak_sys like "%' . $judul . '%"' );

       $data = [
           'maks_data' => $maks,
       ];

       return response($data, 200)->header('Content-Type', 'text/plain');
   }

    /**
     * @param $no_mak
     * @return mixed
     */
    public function memuatUraian($no_mak)
    {
        $uraian = Rkakl::where('no_mak', 'like', '%'. $no_mak .'%')
            ->where('level', '=', 11)
            ->get();

        $data = [
            'uraian_data' => $uraian,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function memuatKabkota($id)
    {
        $kabkota = KabKota::where('provinsi_id', '=', $id)->get();

        $data = [
            'kabkota_data' => $kabkota,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Perjadin::rules());

        if($validator->fails())
        {
            return redirect()->route('pengajuan.perjadin-dalam-negeri.index')->withErrors($validator)->withInput();
        }

        $thn_anggaran = Parameter::where('name', '=', 'Tahun Anggaran')
            ->first();

        $check = NoPengajuan::where('bagian_id', '=', \Auth::user()->bagian_id)
            ->where('jenis', '=', 'Perjadin')->first();

        $tglawal   = $request->tgl_awal;
        $tglakhir  = $request->tgl_akhir;
        $datetime1 = carbon::parse($tglawal);
        $datetime2 = carbon::parse($tglakhir);
        $interval  = $datetime2->diffInDays($datetime1);
        // ===== check RPK ==============================================================================
        
        $data_rpd = rpd::where('no_mak' , '=' , $request->judul)
                            ->where('level' , '=' , 7)
                            ->first();
        if($data_rpd->count() > 0)
        {
            $dataRpk = Rpk::where('rpd_id' , '=' , $data_rpd['id'])
                            ->where('tglFrom_update' , '<=' , $datetime1)
                            ->where('tglTo_update' , '>=' , $datetime2)
                            ->get();
            if($dataRpk->count() == 0)
            {
                \Session::flash('error', trans('backend/pengajuan.perjadin.store.rpk.empty'));
                return redirect()->route('pengajuan.perjadin-dalam-negeri.index');
            }
        }
        //===================================================================================================




        if ($check === null) {
            $nopengajuan = new NoPengajuan();

            $nopengajuan->bagian_id      = \Auth::user()->bagian_id;
            $nopengajuan->nomor          = 0;
            $nopengajuan->jenis          = 'Perjadin';
            $nopengajuan->kode_transaksi = '02';

            $nopengajuan->save();
        }

        $tabel_no = NoPengajuan::where('bagian_id' ,'=', $request->bagian_id)
            ->where('jenis', '=', 'Perjadin')
            ->first();

        $nomor_pengajuan = $tabel_no->nomor;
        $nomor_pengajuan = $nomor_pengajuan + 1;

        $status = Status::where('kode_status', '=', 'PR00')->first();

        $perjadin = new Perjadin();

        $perjadin->bagian_id       = $request->bagian_id;
        $perjadin->no_pengajuan    = $nomor_pengajuan;
        $perjadin->tgl_pengajuan   = Carbon::now();
        $perjadin->no_mak          = $request->no_mak;
        $perjadin->thn_anggaran    = $thn_anggaran->value;
        $perjadin->nama_kegiatan   = $request->nama_kegiatan;
        $perjadin->no_surat_tugas  = $request->no_surat_tugas;
        $perjadin->tgl_surat_tugas = $request->tgl_surat_tugas;
        $perjadin->tgl_awal        = $request->tgl_awal;
        $perjadin->tgl_akhir       = $request->tgl_akhir;
        $perjadin->provinsi_id     = $request->provinsi_id;
        $perjadin->kabkota_id      = $request->kabkota;
        $perjadin->prov_asal       = 'DKI Jakarta';
        $perjadin->status_id       = $status->id;
        $perjadin->lama            = $interval + 1;

        $perjadin->save();

        NoPengajuan::where('bagian_id' ,'=', $request->bagian_id)
            ->where('jenis', '=', 'Perjadin')
            ->update([
                'nomor' => $nomor_pengajuan
            ]);

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-akun.list-akun', $perjadin->id)->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Perjadin::rules_edit());

        if($validator->fails())
        {
            return redirect()->route('pengajuan.perjadin-dalam-negeri.index')->withErrors($validator)->withInput();
        }

        $status = Status::where('kode_status', '=', 'PR00')->first();

        $perjadin = Perjadin::find($id);

        $perjadin->no_surat_tugas  = $request->no_surat_tugas;
        $perjadin->tgl_surat_tugas = $request->tgl_surat_tugas;
        $perjadin->tgl_awal        = $request->tgl_awal;
        $perjadin->tgl_akhir       = $request->tgl_akhir;
        $perjadin->provinsi_id     = $request->provinsi_id;
        $perjadin->kabkota_id      = $request->kabkota;
        $perjadin->status_id       = $status->id;

        $perjadin->save();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-akun', $id)->withInput();
    }

    /**
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function draftPerjadin($perjadin_id)
    {
        $perjadin = Perjadin::where('id', $perjadin_id)->first();

        $dataperjadins     = DataPerjadin::where('perjadin_id', $perjadin_id)
                                        ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                        ->get();

        $totaldataperjadin = DataPerjadin::where('perjadin_id', $perjadin_id)
                                        ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                        ->get()->count();

        $perjadinakuns     = PerjadinAkun::where('perjadin_id', $perjadin_id)
                                        ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                        ->get();

        $totalperjadinakun = PerjadinAkun::where('perjadin_id', $perjadin_id)
                                        ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                        ->get()->count();

        $perjadinakun = PerjadinAkun::groupby( 'kode_11')
            ->where('perjadin_id', $perjadin_id)
            ->first();

        $jadwals     = Jadwal::where('kegiatan_id', '=', $perjadin_id)
                             ->where('keterangan', '=', 'perjadin-dalam-negeri')
                             ->get();
                             
        $totaljadwal = Jadwal::where('kegiatan_id', '=', $perjadin_id)->get()->count();

        $statuss = Status::whereIn('kode_status', ['PR02', 'PR03'])->get();

        return view('backend.pengajuan.perjadin.draftperjadin.index', ['perjadin' => $perjadin, 'dataperjadins' => $dataperjadins, 'totaldataperjadin' => $totaldataperjadin, 'perjadinakuns' => $perjadinakuns, 'totalperjadinakun' => $totalperjadinakun, 'perjadinakun' => $perjadinakun, 'perjadin_id' => $perjadin_id, 'jadwals' => $jadwals, 'totaljadwal' => $totaljadwal, 'statuss' => $statuss]);
    }

    /**
     * @param $perjadin_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimPerjadin($perjadin_id)
    {
        $perjadin    = Perjadin::where('id', $perjadin_id)->first();
        $detailakuns = PerjadinAkun::where('perjadin_id', $perjadin_id)
                                    ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                    ->get();

        $total = 0;
        foreach ($detailakuns as $key => $value) {
            $total = $total + $value->jumlah_pengajuan;

            $datatransaksi = Transaksi::where('id_t', '=', $value->perjadin_id)
                ->where('keterangan', '=', 'Perjadin')
                ->where('no_mak_sys', '=', $value->no_mak_sys)
                ->get();

            if ($datatransaksi->count() == 0) {
                $transaksi             = new Transaksi();
                $transaksi->id_t       = $value->perjadin_id;
                $transaksi->no_mak_sys = $value->no_mak_sys;
                $transaksi->jumlah     = $value->jumlah_pengajuan;
                $transaksi->kode_9     = $value->kode_9;
                $transaksi->kode_4     = $value->kode_4;
                $transaksi->kode_8     = $value->kode_8;
                $transaksi->kode_6     = $value->kode_6;
                $transaksi->kode_7     = $value->kode_7;
                $transaksi->kode_11    = $value->kode_11;
                $transaksi->kode_0     = $value->kode_0;
                $transaksi->status     = 'RL01';
                $transaksi->keterangan = 'Perjadin';
                $transaksi->tanggal    = $perjadin->tgl_pengajuan;

                $transaksi->save();
            }
        }

        $update_stat = Status::where('kode_status', 'PR01')->first();
        Perjadin::where('id', '=', $perjadin_id)
            ->update(['status_id'       => $update_stat->id,
                      'total_pengajuan' => $total]);

        $this->hitungTransaksi();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.index');
    }

    /**
     *
     */
    public function hitungTransaksi()
    {
        Rkakl::where('id', '!=', 0)
            ->update([
                'realisasi'   => 0,
                'realisasi_2' => 0,
                'realisasi_3' => 0
            ]);

        $detail = Transaksi::groupby('kode_9', 'kode_8', 'kode_6', 'kode_7', 'kode_11', 'kode_0', 'status')
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, kode_11, kode_0 , sum(jumlah) as nilai, status')
            ->get();

        foreach ($detail as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            $no_mak = $value['kode_9'] . "." . $value['kode_8'] . "." . $value['kode_6'] . "." . $value['kode_7'] . "." . $value['kode_11'] . "." . $value['kode_0'];

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value['nilai']
                ]);
        }

        $detail = Transaksi::groupby('kode_9', 'kode_8', 'kode_6', 'kode_7', 'kode_11', 'status')
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, kode_11 , sum(jumlah) as nilai, status')
            ->get();

        foreach ($detail as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            $no_mak = $value['kode_9'] . "." . $value['kode_8'] . "." . $value['kode_6'] . "." . $value['kode_7'] . "." . $value['kode_11'];

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value['nilai']
                ]);
        }

        $detail = Transaksi::groupby('kode_9', 'kode_8', 'kode_6', 'kode_7', 'status')
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, sum(jumlah) as nilai, status')
            ->get();

        foreach ($detail as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            $no_mak = $value['kode_9'] . "." . $value['kode_8'] . "." . $value['kode_6'] . "." . $value['kode_7'];

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value['nilai']
                ]);
        }

        $detail = Transaksi::groupby('kode_9', 'kode_8', 'kode_6', 'status')
            ->selectRaw('kode_9, kode_8, kode_6, sum(jumlah) as nilai, status')
            ->get();

        foreach ($detail as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            $no_mak = $value['kode_9'] . "." . $value['kode_8'] . "." . $value['kode_6'];

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value['nilai']
                ]);
        }

        $detail = Transaksi::groupby('kode_9', 'kode_8', 'status')
            ->selectRaw('kode_9, kode_8, sum(jumlah) as nilai, status')
            ->get();

        foreach ($detail as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            $no_mak = $value['kode_9'] . "." . $value['kode_8'];

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value['nilai']
                ]);
        }

        $detail = Transaksi::groupby('kode_9', 'kode_4', 'status')
            ->selectRaw('kode_9, kode_4, sum(jumlah) as nilai, status')
            ->get();

        foreach ($detail as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            $no_mak = $value['kode_9'] . "." . $value['kode_4'];

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value['nilai']
                ]);
        }

        $detail = Transaksi::groupby('kode_9', 'status')
            ->selectRaw('kode_9, sum(jumlah) as nilai, status')
            ->get();

        $eselon_id = BagianEselon::where('bagian_id','=', Auth::user()->bagian_id)->first();
        foreach ($detail as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            $no_mak = $value['kode_9'];
            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->where('eselon_id', '=', $eselon_id['eselon_id'])
                ->update([
                    $field => $value['nilai']
                ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimBendahara(Request $request)
    {
        if ($request->keterangan == 'PR07') {
            $rules = array(
                'metode_bayar' => 'required',
                'status_id'    => 'required',
                'keterangan'   => 'required',
                'alasan'       => 'required'
            );

            $validator = \Validator::make($request->all(), $rules);

            if($validator->fails())
            {
                return redirect()->route('pengajuan.perjadin-dalam-negeri.index', $request->id)->withErrors($validator)->withInput();
            }

            $PR91 = Status::where('kode_status', '=', 'PR91')->first();
            Perjadin::where('id', $request->id)
                ->update([
                    'status_id' => $PR91->id,
                    'alasan'    => $request->input('alasan')
                ]);

            \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.berkas.messages.info'));

            return redirect()->route('pengajuan.perjadin-dalam-negeri.index');
        } else {
            Perjadin::where('id', $request->id)
                ->update([
                    'status_id'    => $request->Input('status_id'),
                    'metode_bayar' => $request->Input('metode')
                ]);

            \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.berkas.messages.success'));

            return redirect()->route('pengajuan.perjadin-dalam-negeri.index');
        }
    }

    /**
     * @param $perjadin_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uangDiserahkan($perjadin_id)
    {
        $update_stat = Status::where('kode_status', 'PR04')->first();
        Perjadin::where('id', '=', $perjadin_id)
            ->update([
                'status_id' => $update_stat->id
            ]);

        Transaksi::where('id_t', '=', $perjadin_id)
            ->where('keterangan', '=', 'Perjadin')
            ->update(['status' => 'RL02']);

        $this->hitungTransaksi();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.serahkan.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.destroy.messages.info'));

            return redirect()->route('pengajuan.perjadin-dalam-negeri.index');
        }

        Jadwal::where('kegiatan_id', $id)
                    ->where('keterangan', '=', 'perjadin-dalam-negri')
                    ->delete();
        PerjadinAkun::where('perjadin_id', $id)
                    ->where('keterangan', '=', 'perjadin-dalam-negri')
                    ->delete();
        DataPerjadin::where('perjadin_id', $id)
                    ->where('keterangan', '=', 'perjadin-dalam-negri')
                    ->delete();
        Perjadin::where('id', $id)->delete();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.destroy.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $rkakls    = Rkakl::where('level', '=', 7)->get();
        $bagians   = Bagian::findOrFail(\Auth::user()->bagian_id);
        $provinsis = Provinsi::get();
        $kotas     = KabKota::get();

        $PR03 = Status::where('kode_status', '=', 'PR03')->first();
        $PR00 = Status::where('kode_status', '=', 'PR00')->first();
        $PR91 = Status::where('kode_status', '=', 'PR91')->first();
        $PR01 = Status::where('kode_status', '=', 'PR01')->first();
        $PR02 = Status::where('kode_status', '=', 'PR02')->first();

        if (\Auth::user()->hasRole('user')) {
            $perjadins = Perjadin::orderBy('perjadin.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->whereIn('perjadin.status_id', [$PR03->id, $PR00->id, $PR91->id])
                ->where('perjadin.bagian_id', \Auth::user()->bagian_id)
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('ppk')) {
            $perjadins = Perjadin::orderBy('perjadin.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->where('perjadin.status_id', '=', $PR01->id)
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perjadins = Perjadin::orderBy('perjadin.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->whereIn('perjadin.status_id', [$PR01->id, $PR02->id, $PR03->id])
                ->paginate(10);
        } else {
            $perjadins = Perjadin::orderBy('perjadin.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        }

        return view('backend.pengajuan.perjadin.index', ['perjadins' => $perjadins, 'rkakls' => $rkakls, 'bagians' => $bagians, 'kotas' => $kotas, 'provinsis' => $provinsis]);
    }


    public function notaDinas($id)
    {
        $perjadin        = Perjadin::find($id);
        $details         = PerjadinAkun::where('perjadin_id', $id)
                                        ->where('keterangan', '=', 'perjadin-dalam-negeri')->get();
        $tanggalprint    = $this->tanggalIndonesia(Carbon::Now());
        $pimpinan        = Pimpinan::where('bagian_id', \Auth::user()->bagian_id)->first();

        $pdf = PDF::loadView('backend.pengajuan.perjadin.laporan.notadinas', ['perjadin' => $perjadin, 'details' => $details, 'tanggalprint' => $tanggalprint, 'pimpinan' => $pimpinan]);

        return $pdf->stream('notadinas_'.Carbon::now()->format('d-m-Y').'.pdf');
    }

    /**
     * @param $tanggal
     * @return string
     */
    public function tanggalIndonesia($tanggal)
    {
        $dt = new Carbon($tanggal);
        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $tgl = $dt->day;
        $bln = $dt->month;
        $thn = $dt->year;

        $result = $tgl . " " . $bulan[(int)$bln-1] . " " . $thn;

        return $result;
    }


    public function tandaTerima($perjadin_id)
    {
        $perjadin        = Perjadin::find($perjadin_id);
        $dataperjadins   = DataPerjadin::where('perjadin_id', '=', $perjadin_id)
                                        ->where('keterangan', '=', 'perjadin-dalam-negeri')->get();
        $pimpinan        = Pimpinan::where('bagian_id', $perjadin->bagian_id)->first();
        $bendahara       = Pejabat::where('jabatan' , 'Bendahara')->first();

        $pdf = PDF::loadView('backend.pengajuan.perjadin.laporan.tandaterima', ['perjadin' => $perjadin, 'dataperjadins' => $dataperjadins, 'bendahara' => $bendahara, 'pimpinan' => $pimpinan]);

        return $pdf->stream('tandaterima_'.Carbon::now()->format('d-m-Y').'.pdf');

    }



}