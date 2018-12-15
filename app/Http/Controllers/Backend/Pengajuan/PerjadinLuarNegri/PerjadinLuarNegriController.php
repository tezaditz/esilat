<?php

namespace App\Http\Controllers\Backend\Pengajuan\PerjadinLuarNegri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegri;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Bagian;
use App\Models\Backend\Master\BagianEselon;
use App\Models\Backend\Master\Provinsi;
use App\Models\Backend\Master\KabKota;
use App\Models\Backend\Master\Status;
use App\Models\Backend\Parameter;
use App\Models\Backend\Master\NoPengajuan;
use App\Models\Backend\PertanggungJawaban\DataPerjadin;
use App\Models\Backend\Pengajuan\Perjadin\PerjadinAkun;
use App\Models\Backend\Pengajuan\Jadwal;
use App\Models\Backend\Pengajuan\Transaksi;
use App\Models\Backend\Master\Negara;

use App\Models\Backend\Master\Pejabat;
use App\Models\Backend\Pimpinan;
use Carbon\Carbon;
use PDF;
use Auth;

class PerjadinLuarNegriController extends Controller
{
    //
    public function index()
    {
        $a = Auth::user()->bagian_id;
        $b = BagianEselon::where('bagian_id' , $a)->get();
        // return $b[0]['eselon_id'];
        $rkakls = Rkakl::where('level', '=', 11)
            ->where('eselon_id' , $b[0]['eselon_id'])
            ->where(function ($q) {
                $q->Where('no_mak_sys', 'LIKE', '%524211%')
                    ->Orwhere('no_mak_sys', 'LIKE', '%524219%');
            })->get();

        $data = [];
        foreach ($rkakls as $key => $value) {
            $getRkakl = Rkakl::where('no_mak_sys' , substr($value->no_mak_sys, 0 , 24))->get();
            $data[$key]['nama_kegiatan'] = $getRkakl[0]['no_mak_sys'] . '|' .$getRkakl[0]['uraian'];
            $data[$key]['no_mak_sys'] = $getRkakl[0]['no_mak_sys'];
            $data[$key]['id']            = $getRkakl[0]['id'];
        }
        
        $Count_Rkakl = Count($data);
        // return $data;

        $bagians = Bagian::findOrFail(\Auth::user()->bagian_id);
        $negaras = Negara::get();

        $PR03 = Status::where('kode_status', '=', 'PR03')->first();
        $PR00 = Status::where('kode_status', '=', 'PR00')->first();
        $PR91 = Status::where('kode_status', '=', 'PR91')->first();
        $PR01 = Status::where('kode_status', '=', 'PR01')->first();
        $PR02 = Status::where('kode_status', '=', 'PR02')->first();

        if (\Auth::user()->hasRole('user')) {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PR01->id, $PR02->id, $PR03->id, $PR00->id, $PR91->id])
                ->where('bagian_id', \Auth::user()->bagian_id)
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('ppk')) {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'asc')
                ->where('status_id', '=', $PR01->id)
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PR01->id, $PR02->id, $PR03->id])
                ->paginate(10);
        } else {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'asc')
                ->paginate(10);
        }

        
        
        return view('backend.pengajuan.perjadinluarnegri.index', ['perjadins' => $perjadins, 'rkakls' => $rkakls, 'bagians' => $bagians, 'negaras' => $negaras , 'data'=>$data , 'dataCount'=>$Count_Rkakl ]);
    }

    /**
     * @param $judul
     * @return mixed
     */
//    public function memuatMak($judul)
//    {
//        $maks = \DB::table('rkakl')
//            ->select('id', 'no_mak', 'uraian', \DB::raw('FORMAT(jumlah - realisasi, 0) as pegu'))
//            ->where('no_mak', 'like', '%' . $judul . '%')->get();
//        $data = [
//            'maks_data' => $maks,
//        ];
//
//        return response($data, 200)->header('Content-Type', 'text/plain');
//    }

    public function memuatUraian($no_mak)
    {
        $uraian = Rkakl::where('no_mak', '=', $no_mak)
            ->where('level', '=', 11)
            ->get();

        $data = [
            'uraian_data' => $uraian,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), PerjadinLuarNegri::rules());

        if ($validator->fails()) {
            return redirect()->route('pengajuan.perjadin-luar-negeri.index')->withErrors($validator)->withInput();
        }

        $thn_anggaran = Parameter::where('name', '=', 'Tahun Anggaran')
            ->first();

        $check = NoPengajuan::where('bagian_id', '=', \Auth::user()->bagian_id)
            ->where('jenis', '=', 'Perjadin Luar Negeri')->first();

        if ($check === null) {
            $nopengajuan = new NoPengajuan();

            $nopengajuan->bagian_id      = \Auth::user()->bagian_id;
            $nopengajuan->nomor          = 0;
            $nopengajuan->jenis          = 'Perjadin Luar Negeri';
            $nopengajuan->kode_transaksi = '02';

            $nopengajuan->save();
        }

        $tabel_no = NoPengajuan::where('bagian_id', '=', $request->bagian_id)
            ->where('jenis', '=', 'Perjadin Luar Negeri')
            ->first();

        $nomor_pengajuan = $tabel_no->nomor;
        $nomor_pengajuan = $nomor_pengajuan + 1;

        $status = Status::where('kode_status', '=', 'PR00')->first();

        $tglawal   = $request->tgl_awal;
        $tglakhir  = $request->tgl_akhir;
        $datetime1 = carbon::parse($tglawal);
        $datetime2 = carbon::parse($tglakhir);
        $interval  = $datetime2->diffInDays($datetime1);

        $perjadin = new PerjadinLuarNegri();

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
        $perjadin->negara_id       = $request->negara_id;
        $perjadin->nilai_kurs      = $request->nilai_kurs;
        $perjadin->prov_asal       = 'DKI Jakarta';
        $perjadin->status_id       = $status->id;
        $perjadin->lama            = $interval + 1;

        $perjadin->save();

        NoPengajuan::where('bagian_id', '=', $request->bagian_id)
            ->where('jenis', '=', 'Perjadin Luar Negeri')
            ->update([
                'nomor' => $nomor_pengajuan
            ]);

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.detail-pelaksana', $perjadin->id)->withInput();
        // return redirect()->route('pengajuan.perjadin-luar-negeri.detail-akun.list-akun', $perjadin->id)->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), PerjadinLuarNegri::rules_edit());

        if ($validator->fails()) {
            return redirect()->route('pengajuan.perjadin-luar-negeri.index')->withErrors($validator)->withInput();
        }

        $status = Status::where('kode_status', '=', 'PR00')->first();

        $perjadin = PerjadinLuarNegri::find($id);

        $perjadin->no_surat_tugas  = $request->no_surat_tugas;
        $perjadin->tgl_surat_tugas = $request->tgl_surat_tugas;
        $perjadin->tgl_awal        = $request->tgl_awal;
        $perjadin->tgl_akhir       = $request->tgl_akhir;
        $perjadin->negara_id       = $request->negara_id;
        $perjadin->status_id       = $status->id;

        $perjadin->save();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.detail-akun', $id)->withInput();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.destroy.messages.info'));

            return redirect()->route('pengajuan.perjadin-luar-negeri.index');
        }

        Jadwal::where('kegiatan_id', $id)
            ->where('keterangan', '=', 'perjadin-luar-negri')
            ->delete();
        PerjadinAkun::where('perjadin_id', $id)
            ->where('keterangan', '=', 'perjadin-luar-negri')
            ->delete();
        DataPerjadin::where('perjadin_id', $id)
            ->where('keterangan', '=', 'perjadin-luar-negri')
            ->delete();
        PerjadinLuarNegri::where('id', $id)->delete();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.destroy.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $rkakls = Rkakl::where('level', '=', 11)
            ->where(function ($q) {
                $q->Where('no_mak_sys', 'LIKE', '%524211%')
                    ->Orwhere('no_mak_sys', 'LIKE', '%524219%');
            })->get();

        $bagians = Bagian::findOrFail(\Auth::user()->bagian_id);
        $negaras = Negara::get();

        $PR03 = Status::where('kode_status', '=', 'PR03')->first();
        $PR00 = Status::where('kode_status', '=', 'PR00')->first();
        $PR91 = Status::where('kode_status', '=', 'PR91')->first();
        $PR01 = Status::where('kode_status', '=', 'PR01')->first();
        $PR02 = Status::where('kode_status', '=', 'PR02')->first();

        if (\Auth::user()->hasRole('user')) {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin_luar_negri.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin_luar_negri.bagian_id')
                ->join('negara', 'negara.id', '=', 'perjadin_luar_negri.negara_id')
                ->join('status', 'status.id', '=', 'perjadin_luar_negri.status_id')
                ->whereIn('perjadin_luar_negri.status_id', [$PR03->id, $PR00->id, $PR91->id])
                ->where('perjadin_luar_negri.bagian_id', \Auth::user()->bagian_id)
                ->where($request->options, 'like', '%' . $request->search . '%')
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('ppk')) {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin_luar_negri.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin_luar_negri.bagian_id')
                ->join('negara', 'negara.id', '=', 'perjadin_luar_negri.negara_id')
                ->join('status', 'status.id', '=', 'perjadin_luar_negri.status_id')
                ->where('perjadin_luar_negri.status_id', '=', $PR01->id)
                ->where($request->options, 'like', '%' . $request->search . '%')
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin_luar_negri.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin_luar_negri.bagian_id')
                ->join('negara', 'negara.id', '=', 'perjadin_luar_negri.negara_id')
                ->join('status', 'status.id', '=', 'perjadin_luar_negri.status_id')
                ->whereIn('perjadin_luar_negri.status_id', [$PR01->id, $PR02->id, $PR03->id])
                ->paginate(10);
        } else {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin_luar_negri.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'perjadin_luar_negri.bagian_id')
                ->join('negara', 'negara.id', '=', 'perjadin_luar_negri.negara_id')
                ->join('status', 'status.id', '=', 'perjadin_luar_negri.status_id')
                ->where($request->options, 'like', '%' . $request->search . '%')
                ->paginate(10);
        }

        return view('backend.pengajuan.perjadinluarnegri.index', ['perjadins' => $perjadins, 'rkakls' => $rkakls, 'bagians' => $bagians, 'negaras' => $negaras]);
    }

    /**
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function draftPerjadin($perjadin_id)
    {
        $perjadin = PerjadinLuarNegri::where('id', $perjadin_id)->first();

        $dataperjadins     = DataPerjadin::where('perjadin_id', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->get();
        $totaldataperjadin = DataPerjadin::where('perjadin_id', $perjadin_id)->get()->count();

        $perjadinakuns = PerjadinAkun::where('perjadin_id', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->get();

        $totalperjadinakun = PerjadinAkun::where('perjadin_id', $perjadin_id)->get()
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->count();

        $perjadinakun = PerjadinAkun::groupby('kode_11')
            ->where('perjadin_id', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->first();

        $jadwals = Jadwal::where('kegiatan_id', '=', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->get();

        $totaljadwal = Jadwal::where('kegiatan_id', '=', $perjadin_id)->get()->count();

        $statuss = Status::whereIn('kode_status', ['PR02', 'PR03'])->get();

        return view('backend.pengajuan.perjadinluarnegri.draftperjadin.index', ['perjadin' => $perjadin, 'dataperjadins' => $dataperjadins, 'totaldataperjadin' => $totaldataperjadin, 'perjadinakuns' => $perjadinakuns, 'totalperjadinakun' => $totalperjadinakun, 'perjadinakun' => $perjadinakun, 'perjadin_id' => $perjadin_id, 'jadwals' => $jadwals, 'totaljadwal' => $totaljadwal, 'statuss' => $statuss]);
    }

    public function kirimPerjadin($perjadin_id)
    {
        $perjadin    = PerjadinLuarNegri::where('id', $perjadin_id)->first();
        $detailakuns = PerjadinAkun::where('perjadin_id', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->get();

        $total = 0;
        foreach ($detailakuns as $key => $value) {
            $total = $total + $value->jumlah_pengajuan;

            $datatransaksi = Transaksi::where('id_t', '=', $value->perjadin_id)
                ->where('keterangan', '=', 'perjadin-luar-negeri')
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
                $transaksi->keterangan = 'perjadin-luar-negeri';
                $transaksi->tanggal    = $perjadin->tgl_pengajuan;

                $transaksi->save();
            }
        }

        $update_stat = Status::where('kode_status', 'PR01')->first();

        PerjadinLuarNegri::where('id', '=', $perjadin_id)
            ->update(['status_id'       => $update_stat->id,
                      'total_pengajuan' => $total]);

        $this->hitungTransaksi();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.store.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.index');
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

            if ($validator->fails()) {
                return redirect()->route('pengajuan.perjadin-luar-negeri.index', $request->id)->withErrors($validator)->withInput();
            }

            $PR91 = Status::where('kode_status', '=', 'PR91')->first();
            PerjadinLuarNegri::where('id', $request->id)
                ->update([
                    'status_id' => $PR91->id,
                    'alasan'    => $request->input('alasan')
                ]);

            \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.berkas.messages.info'));

            return redirect()->route('pengajuan.perjadin-luar-negeri.index');
        } else {
            PerjadinLuarNegri::where('id', $request->id)
                ->update([
                    'status_id'    => $request->Input('status_id'),
                    'metode_bayar' => $request->Input('metode')
                ]);

            \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.berkas.messages.success'));

            return redirect()->route('pengajuan.perjadin-luar-negeri.draft-perjadin', $request->id);
        }
    }

    /**
     * @param $perjadin_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uangDiserahkan($perjadin_id)
    {
        $update_stat = Status::where('kode_status', 'PR04')->first();

        PerjadinLuarNegri::where('id', '=', $perjadin_id)
            ->update([
                'status_id' => $update_stat->id
            ]);

        Transaksi::where('id_t', '=', $perjadin_id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->update(['status' => 'RL02']);

        $this->hitungTransaksi();

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.serahkan.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.index');
    }

    /**
     * @param $tanggal
     * @return string
     */
    public function tanggalIndonesia($tanggal)
    {
        $dt    = new Carbon($tanggal);
        $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $tgl   = $dt->day;
        $bln   = $dt->month;
        $thn   = $dt->year;

        $result = $tgl . " " . $bulan[(int)$bln - 1] . " " . $thn;

        return $result;
    }

    public function notaDinas($id)
    {
        $perjadin     = PerjadinLuarNegri::find($id);
        $details      = PerjadinAkun::where('perjadin_id', $id)
                                    ->where('keterangan', '=', 'perjadin-luar-negeri')->get();
        $tanggalprint = $this->tanggalIndonesia(Carbon::Now());
        $pimpinan     = Pimpinan::where('bagian_id', \Auth::user()->bagian_id)->first();

        $pdf = PDF::loadView('backend.pengajuan.perjadinluarnegri.laporan.notadinas', ['perjadin' => $perjadin, 'details' => $details, 'tanggalprint' => $tanggalprint, 'pimpinan' => $pimpinan]);

        return $pdf->stream('notadinas_' . Carbon::now()->format('d-m-Y') . '.pdf');
    }

    public function tandaTerima($perjadin_id)
    {
        $perjadin      = PerjadinLuarNegri::find($perjadin_id);
        $dataperjadins = DataPerjadin::where('perjadin_id', '=', $perjadin_id)
                                      ->where('keterangan', '=', 'perjadin-luar-negeri')->get();
        $pimpinan      = Pimpinan::where('bagian_id', $perjadin->bagian_id)->first();
        $bendahara     = Pejabat::where('jabatan', 'Bendahara')->first();

        $pdf = PDF::loadView('backend.pengajuan.perjadinluarnegri.laporan.tandaterima', ['perjadin' => $perjadin, 'dataperjadins' => $dataperjadins, 'bendahara' => $bendahara, 'pimpinan' => $pimpinan]);

        return $pdf->stream('tandaterima_' . Carbon::now()->format('d-m-Y') . '.pdf');

    }
}