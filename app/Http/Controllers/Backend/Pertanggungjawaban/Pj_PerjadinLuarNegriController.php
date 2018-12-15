<?php

namespace App\Http\Controllers\Backend\Pertanggungjawaban;

use App\Http\Controllers\Controller;
use App\Models\Backend\Pengajuan\Perjadin\PerjadinAkun;
use App\Models\Backend\Pertanggungjawaban\JenisBiayaPerjadin;
use Illuminate\Http\Request;
use App\Models\Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegri;
use App\Models\Backend\PertanggungJawaban\DataPerjadin;
use App\Models\Backend\Master\Status;
use App\Models\Backend\Pimpinan;
use App\Models\Backend\Master\Pejabat;
use App\Models\Backend\Pengajuan\Transaksi;
use Carbon\Carbon;
use PDF;

class Pj_PerjadinLuarNegriController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $PR05 = Status::where('kode_status', '=', 'PR05')->first();
        $PR04 = Status::where('kode_status', '=', 'PR04')->first();
        $PR08 = Status::where('kode_status', '=', 'PR08')->first();
        $PR07 = Status::where('kode_status', '=', 'PR07')->first();
        $PR09 = Status::where('kode_status', '=', 'PR09')->first();
        $PR12 = Status::where('kode_status', '=', 'PR12')->first();
        $PR01 = Status::where('kode_status', '=', 'PR01')->first();

        if (\Auth::user()->hasRole('user')) {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'asc')
                ->where('bagian_id', \Auth::user()->bagian_id)
                ->whereIn('status_id', [$PR05->id, $PR04->id, $PR08->id, $PR07->id, $PR09->id, $PR12->id])
                ->paginate(10);
            $totalpengajuans = PerjadinAkun::where('keterangan', '=', 'perjadin-luar-negeri')->first();
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'desc')
                ->whereIn('status_id', [$PR05->id , $PR09->id])
                ->paginate(10);
            $totalpengajuans = PerjadinAkun::where('keterangan', '=', 'perjadin-luar-negeri')->first();
        } elseif (\Auth::user()->hasRole('ppk')) {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'desc')
                ->whereIn('status_id', [$PR01->id])
                ->paginate(10);
            $totalpengajuans = PerjadinAkun::where('keterangan', '=', 'perjadin-luar-negeri')->first();
        } else {
            $perjadins = PerjadinLuarNegri::orderBy('created_at', 'desc')
                        ->paginate(10);
            $totalpengajuans = PerjadinAkun::where('keterangan', '=', 'perjadin-luar-negeri')->first();
        }

        return view('backend.pertanggungjawaban.perjadin-luar-negeri.index', ['perjadins' => $perjadins, 'totalpengajuans' => $totalpengajuans]);
    }

    public function pj_detail($id)
    {
//        $roles           = Auth::user()->roles->first()->name;
//        $perjadin        = Perjadin::findOrFail($id);
//        $data_perjadin   = DataPerjadin::where('perjadin_id', $id)->select('*', DB::raw('(penginapan + uang_harian + transport + pesawat + taksi_kab_kota + registration) as total'))->get();
//        $detail_perjadin = DetailPerjadin::where('perjadin_id', $id)->get();
//        $total           = DetailPerjadin::where('perjadin_id', $id)->select('perjadin_id', DB::raw('SUM(jumlah_pengajuan) as total_pengajuan'), DB::raw('SUM(sisa_pagu) as total_pagu'))->groupBy('perjadin_id')->first();
//        $biaya           = JenisBiayaPerjadin::all();
//        $no              = '1';
//
//        return view('backend.pertanggungjawaban.perjadin.detail', [
//            'perjadin'        => $perjadin,
//            'detail_perjadin' => $detail_perjadin,
//            'data_perjadin'   => $data_perjadin,
//            'no'              => $no,
//            'total'           => $total,
//            'biaya'           => $biaya,
//            'roles'           => $roles
//        ]);
        $perjadin       = PerjadinLuarNegri::where('id', $id)->first();
        $data_perjadins = DataPerjadin::select('*', \DB::raw('(penginapan + uang_harian + transport + pesawat + taksi_kab_kota + registration) as total'))
            ->where('perjadin_id', $id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')->get();

        $perjadinakuns       = PerjadinAkun::where('perjadin_id', $id)
                                            ->where('keterangan', '=', 'perjadin-luar-negeri')->get();

        $sisapagu            = PerjadinAkun::select(\DB::raw('SUM(sisa_pagu) AS sisa_pagu'))
            ->where('perjadin_id', $id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->first();
        $jumlahpengajuan     = PerjadinAkun::select(\DB::raw('SUM(jumlah_pengajuan) AS jumlah_pengajuan'), \DB::raw('SUM(pj_jumlah) AS pj_jumlah_pengajuan'))
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->where('perjadin_id', $id)->first();
            
        $jenisbiayaperjadins = JenisBiayaPerjadin::all();

        $totalpengajuan = DataPerjadin::select(\DB::raw('(SUM(penginapan) + SUM(uang_harian) + SUM(transport) + SUM(pesawat)) AS totalpengajuan'))
            ->where('perjadin_id', $id)
            ->first();

        return view('backend.pertanggungjawaban.perjadin-luar-negeri.detailperjadin.index', [
            'perjadin'            => $perjadin,
            'data_perjadins'      => $data_perjadins,
            'perjadinakuns'       => $perjadinakuns,
            'sisapagu'            => $sisapagu,
            'jumlahpengajuan'     => $jumlahpengajuan,
            'jenisbiayaperjadins' => $jenisbiayaperjadins,
//            'detailperjadins'     => $detailperjadins,
            'totalpengajuan'      => $totalpengajuan,
        ]);
    }

    public function pj_draft($id)
    {
        $perjadin       = PerjadinLuarNegri::where('id', $id)->first();
        $data_perjadins = DataPerjadin::select('*', \DB::raw('(penginapan + uang_harian + transport + pesawat + taksi_kab_kota + registration) as total'), \DB::raw('(pj_penginapan + pj_uang_harian + pj_transport + pj_pesawat + pj_taksi_kab_kota + pj_registration) as total_pj'))
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->where('perjadin_id', $id)->get();
//        $perjadinakuns       = PerjadinAkun::where('perjadin_id', $id)->get();
//        $detailperjadins     = DetailPerjadin::where('perjadin_id', $id)->get();
        $jenisbiayaperjadins = JenisBiayaPerjadin::all();

        $statuss = Status::where('modul', '=', 'FORMPR01')->get();

        $totalpengajuan = DataPerjadin::select(\DB::raw('(SUM(penginapan) + SUM(uang_harian) + SUM(transport) + SUM(pesawat)) AS totalpengajuan'))
            ->where('perjadin_id', $id)
            ->first();

        return view('backend.pertanggungjawaban.perjadin-luar-negeri.draftperjadin.index', [
            'perjadin'       => $perjadin,
            'data_perjadins' => $data_perjadins,
//            'perjadinakuns'       => $perjadinakuns,
//            'detailperjadins'     => $detailperjadins,
            'jenisbiayaperjadins' => $jenisbiayaperjadins,
            'totalpengajuan'      => $totalpengajuan,
            'statuss'             => $statuss,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $PR05 = Status::where('kode_status', '=', 'PR05')->first();
        $PR04 = Status::where('kode_status', '=', 'PR04')->first();
        $PR08 = Status::where('kode_status', '=', 'PR08')->first();
        $PR07 = Status::where('kode_status', '=', 'PR07')->first();
        $PR09 = Status::where('kode_status', '=', 'PR09')->first();
        $PR12 = Status::where('kode_status', '=', 'PR12')->first();
        $PR01 = Status::where('kode_status', '=', 'PR01')->first();

        if (\Auth::user()->hasRole('user')) {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin.created_at', 'desc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->where('perjadin.bagian_id', \Auth::user()->bagian_id)
                ->whereIn('perjadin.status_id', [$PR05->id, $PR04->id, $PR08->id, $PR07->id, $PR09->id, $PR12->id])
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin.created_at', 'desc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->whereIn('perjadin.status_id', [$PR05->id])
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('ppk')) {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin.created_at', 'desc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->whereIn('perjadin.status_id', [$PR01->id])
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $perjadins = PerjadinLuarNegri::orderBy('perjadin.created_at', 'desc')
                ->join('bagian', 'bagian.id', '=', 'perjadin.bagian_id')
                ->join('provinsi', 'provinsi.id', '=', 'perjadin.provinsi_id')
                ->join('kabkota', 'kabkota.id', '=', 'perjadin.kabkota_id')
                ->join('status', 'status.id', '=', 'perjadin.status_id')
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        }

        return view('backend.pertanggungjawaban.perjadin-luar-negeri.index', ['perjadins' => $perjadins]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirim(Request $request, $id)
    {
        foreach ($request->perjadinakun_id as $key => $value) {
            PerjadinAkun::where('id', $value)
                ->update([
                    'pj_jumlah' => str_replace(".", "", $request->nilai[$key] )
                ]);
        }

        $dataperjadins = DataPerjadin::where('perjadin_id', $id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->get();
        $x = 0;
        $n = 6;
        foreach ($dataperjadins as $key => $value) {
            $x = $x + 1;

            $pj_total = $request->total_aju[$x];

            if($x == 1)
            {
                $pesawat      = $request->nilai2[1];
                $taksi_prov   = $request->nilai2[2];
                $taksi_kab    = $request->nilai2[3];
                $uangharian   = $request->nilai2[4];
                $penginapan   = $request->nilai2[5];
                $registrasion = $request->nilai2[6];
            }
            else
            {
                $n = $n * ($x - 1);

                $pesawat      = $request->nilai2[1 + $n];
                $taksi_prov   = $request->nilai2[2 + $n];
                $taksi_kab    = $request->nilai2[3 + $n];
                $uangharian   = $request->nilai2[4 + $n];
                $penginapan   = $request->nilai2[5 + $n];
                $registrasion = $request->nilai2[6 + $n];
            }

            DataPerjadin::where('id', $value->id)
                        ->where('keterangan', '=', 'perjadin-luar-negeri')
                ->update([
                    'pj_pesawat'        => str_replace(".", "", $pesawat),
                    'pj_taksi_provinsi' => str_replace(".", "", $taksi_prov),
                    'pj_taksi_kab_kota' => str_replace(".", "", $taksi_kab),
                    'pj_uang_harian'    => str_replace(".", "", $uangharian),
                    'pj_penginapan'     => str_replace(".", "", $penginapan),
                    'pj_registration'   => str_replace(".", "", $registrasion),
                    'pj_total'          => str_replace(".", "", $pj_total),
                ]);
        }

        $PR09 = Status::where('kode_status', '=', 'PR09')->first();
        PerjadinLuarNegri::where('id', $id)
            ->update([
                'status_id' => $PR09->id,
            ]);

        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.sentper.messages.success'));
        return redirect()->route('pertanggungjawaban.perjadin-luar-negeri.index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimbendahara(Request $request, $id)
    {
        $status = Status::where('id', '=', $request->status_id)->first();
        if($status->kode_status == 'PR12'){

            Transaksi::where('id_t', '=', $id)
            ->where('keterangan', '=', 'perjadin-luar-negeri')
            ->update(['status' => 'RL03']);

            app('App\Http\Controllers\Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegriController')->hitungTransaksi();
        }

        PerjadinLuarNegri::where('id', $id)
            ->update([
                'status_id' => $request->status_id
            ]);

        \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.submodule.draft_perjadin.sent.messages.success'));
        return redirect()->route('pertanggungjawaban.perjadin-luar-negeri.index');
    }

    public function kuitansiRill($id)
    {
        $dataperjadins   = DataPerjadin::find($id);
        $perjadin        = PerjadinLuarNegri::where('id', $dataperjadins->perjadin_id)->first();
        $pimpinan        = Pimpinan::where('bagian_id', $perjadin->bagian_id)->first();
        $bendahara       = Pejabat::where('jabatan' , 'Bendahara')->first();
        $ppk             = Pejabat::where('jabatan' , '=' , 'Pejabat Pembuat Komitmen')->first();

        $pdf = PDF::loadView('backend.pengajuan.perjadin.laporan.kuitansirill', ['perjadin' => $perjadin, 'dataperjadins' => $dataperjadins, 'ppk' => $ppk, 'pimpinan' => $pimpinan]);

        return $pdf->stream('kuitansirill_'.Carbon::now()->format('d-m-Y').'.pdf');

    }

}