<?php

namespace App\Http\Controllers\Backend\Pertanggungjawaban;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pengajuan\LayananPerkantoran\Perkantoran;
use App\Models\Backend\Pengajuan\LayananPerkantoran\DetailPerkantoran;
use App\Models\Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoran;
use App\Models\Backend\Pengajuan\Transaksi;
use App\Models\Backend\Master\Status;

class Pj_PerkantoranController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $PK09 = Status::where('kode_status', '=', 'PK09')->first();
        $PK11 = Status::where('kode_status', '=', 'PK11')->first();
        $PK12 = Status::where('kode_status', '=', 'PK12')->first();
        $PK15 = Status::where('kode_status', '=', 'PK15')->first();
        $PK99 = Status::where('kode_status', '=', 'PK99')->first();
        $PK13 = Status::where('kode_status', '=', 'PK13')->first();

        if (\Auth::user()->hasRole('user')) {
            $perkantorans = Perkantoran::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PK09->id, $PK11->id, $PK12->id, $PK15->id, $PK99->id, $PK13->id])
                ->paginate(10);
            $totalpengajuans = DetailPerkantoran::all();
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perkantorans = Perkantoran::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PK09->id, $PK12->id, $PK15->id, $PK13->id])
                ->paginate(10);
            $totalpengajuans = DetailPerkantoran::all();
        }

    	return view('backend.pertanggungjawaban.perkantoran.index', [
            'perkantorans'    => $perkantorans,
            'totalpengajuans' => $totalpengajuans,
        ]);
    }

    public function detail($id){
        $perkantorans       = Perkantoran::where('id', $id)->first();
        $detailPerkantorans = DetailPerkantoran::where('perkantoran_id', '=', $id)->get();

//        $totalpengajuan = DetailPerkantoran::select(\DB::raw('sum(jml_rph) as jml_rph'))
//            ->where('perkantoran_id', $id)
//            ->where('header', '=', '0')
//            ->first();
//        $totalpjpengajuan = DetailPerkantoran::select(\DB::raw('sum(pj_jml_rph) as pj_jml_rph'))
//            ->where('perkantoran_id', $id)
//            ->where('header', '=', '0')
//            ->first();

//        $status = Status::whereIn('kode_status' , ['PK08' , 'PK13' , 'PK11'])->get();

        $dokumenPerkantorans = DokumenPerkantoran::where('perkantoran_id', '=', $id)->paginate(6);

        return view('backend.pertanggungjawaban.perkantoran.detail', [
            'perkantorans'        => $perkantorans,
            'detailPerkantorans'  => $detailPerkantorans,
            'dokumenPerkantorans' => $dokumenPerkantorans,
//            'status' => $status
        ]);
    }

//    public function kirimBendahara(Request $request)
//    {
//        $input = $request->all();
//
//        if($input != Null){
//            foreach ($input['id_detail'] as $key => $value) {
//
//                $input_detail['pj_jumlah'] = str_replace(",", "", $input['nilai'][$key]);
//                $updatedata = DetailPerkantoran::where('id' , '=' , $input['id_detail'][$key])->update($input_detail);
//
//            }
//
//            $status_id = Status::where('kode_status', 'PK09')->first();
//            $input_master['status_id'] = $status_id->id;
//
//            $update = Perkantoran::where('id' , '=' , $input['id'])->update($input_master);
//
//            \Session::flash('success', trans('backend/pertanggungjawaban.perkantoran.sent.messages.success'));
//            return redirect()->route('pertanggungjawaban.layanan-perkantoran.index')->withInput();
//        }
//    }

    /**
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function kirimStatus(Request $request, $id)
    {
        if ($request->keterangan == 'PJ31') {
            $PK11 = Status::where('kode_status', '=', 'PK11')->first();
            Perkantoran::where('id', $id)
                ->update([
                    'status_id' => $PK11->id,
                    'alasan'    => $request->input('alasan')
                ]);

        \Session::flash('info', trans('backend/perkantoran.perkantoran.submodule.draft_perkantoran.berkas.messages.info'));
        return redirect()->route('pertanggungjawaban.layanan-perkantoran.index')->withInput();

        } else {
            $PK12 = Status::where('kode_status', '=', 'PK12')->first();
            Perkantoran::where('id', $id)
                ->update([
                    'status_id' => $PK12->id,
                ]);
        }

        \Session::flash('success', trans('backend/perkantoran.perkantoran.submodule.draft_perkantoran.berkas.messages.success'));
        return redirect()->route('pertanggungjawaban.layanan-perkantoran.index')->withInput();
    }

    /**
     * @param $id
     * @return $this
     */
    public function selesai($id)
    {
        $detailperkantorans = DetailPerkantoran::where('perkantoran_id', '=', $id)->get();
        foreach ($detailperkantorans as $key => $value) {
            Transaksi::where('id_t', '=', $id)
                ->where('no_mak_sys', '=', $value->no_mak_sys)
                ->where('keterangan', '=', 'Perkantoran')
                ->update([
                    'status' => 'RL03',
                    'jumlah' => $value->pj_jumlah,
                ]);
        }

        $PK13 = Status::select('id')->where('kode_status', 'PK13')->first();
        Perkantoran::where('id', '=', $id)
            ->update([
                'status_id' => $PK13->id
            ]);

//        $PK06 = Status::where('kode_status', '=', 'PK06')->first();
//        app('App\Http\Controllers\Backend\Pengajuan\KegiatanController')->hitungRealisasi($PK06->id , 'realisasi_2' , 'vol_2' , 'jml_rph');
        $PK13 = Status::where('kode_status', '=', 'PK13')->first();
        app('App\Http\Controllers\Backend\Pengajuan\KegiatanController')->hitungRealisasi($PK13->id , 'realisasi_3' , 'vol_3' , 'pj_jml_rph');

        \Session::flash('success', trans('backend/perkantoran.perkantoran.selesai.messages.success'));
        return redirect()->route('pertanggungjawaban.layanan-perkantoran.index')->withInput();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $PK09 = Status::where('kode_status', '=', 'PK09')->first();
        $PK11 = Status::where('kode_status', '=', 'PK11')->first();
        $PK12 = Status::where('kode_status', '=', 'PK12')->first();
        $PK15 = Status::where('kode_status', '=', 'PK15')->first();
        $PK99 = Status::where('kode_status', '=', 'PK99')->first();

        if (\Auth::user()->hasRole('user')) {
            $perkantorans = Perkantoran::orderBy('perkantoran.created_at', 'desc')
                ->join('status', 'status.id', '=', 'perkantoran.status_id')
                ->where($request->options,'like', '%' . $request->search . '%')
                ->whereIn('perkantoran.status_id', [$PK09->id, $PK11->id, $PK12->id, $PK15->id, $PK99->id])
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perkantorans = Perkantoran::orderBy('perkantoran.created_at', 'desc')
                ->join('status', 'status.id', '=', 'perkantoran.status_id')
                ->where($request->options,'like', '%' . $request->search . '%')
                ->whereIn('perkantoran.status_id', [$PK09->id, $PK12->id, $PK15->id])
                ->paginate(10);
        }

        return view('backend.pertanggungjawaban.perkantoran.index', [
            'perkantorans' => $perkantorans,
        ]);
    }

    /**
     * @param Request $request
     * @param $perkantoran_id
     * @return $this
     */
    public function simpanDetail(Request $request, $perkantoran_id)
    {
        foreach ($request->id as $key => $value) {
            $jml = str_replace(".", "", $request->jml[$key]);
            DetailPerkantoran::where('id', $value)
                ->update([
                    'pj_jumlah' => $jml
                ]);
        }

        if ($request->rampung == 1) {
            $PK09 = Status::where('kode_status', '=', 'PK09')->first();
            Perkantoran::where('id', $perkantoran_id)
                ->update([
                    'status_id' => $PK09->id,
                ]);

            \Session::flash('success', trans('backend/perkantoran.perkantoran.submodule.draft_perkantoran.rampung.messages.success'));
            return redirect()->route('pertanggungjawaban.layanan-perkantoran.index')->withInput();
        }

        \Session::flash('info', trans('backend/perkantoran.perkantoran.submodule.draft_perkantoran.rampung.messages.info'));
        return redirect()->route('pertanggungjawaban.layanan-perkantoran.detail', $perkantoran_id)->withInput();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimPertanggungjawaban($id)
    {
        $PK09 = Status::where('kode_status', 'PK09')->first();
        Perkantoran::where('id', '=', $id)
            ->update([
                'status_id' => $PK09->id
            ]);

        \Session::flash('success', trans('backend/perkantoran.perkantoran.sent.messages.success'));
        return redirect()->route('pertanggungjawaban.layanan-perkantoran.index');
    }
}