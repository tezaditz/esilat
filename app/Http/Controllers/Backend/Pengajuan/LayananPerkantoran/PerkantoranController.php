<?php

namespace App\Http\Controllers\Backend\Pengajuan\LayananPerkantoran;

use App\Models\Backend\Master\MetodeBayar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pengajuan\LayananPerkantoran\Perkantoran;
use App\Models\Backend\Pengajuan\LayananPerkantoran\DetailPerkantoran;
use App\Models\Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoran;
use App\Models\Backend\Pengajuan\Transaksi;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Status;
use App\Models\Backend\Master\NoPengajuan;
use App\Models\Backend\Parameter;
use App\Models\Backend\Pimpinan;
use Carbon\Carbon;
use PDF;

class PerkantoranController extends Controller
{
    public function index()
    {
        $PK00 = Status::where('kode_status', '=', 'PK00')->first();
        $PK01 = Status::where('kode_status', '=', 'PK01')->first();
        $PK02 = Status::where('kode_status', '=', 'PK02')->first();
        $PK03 = Status::where('kode_status', '=', 'PK03')->first();
        $KG05 = Status::where('kode_status', '=', 'KG05')->first();

        if (\Auth::user()->hasRole('user')) {
            $perkantorans = Perkantoran::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PK00->id, $PK01->id, $PK02->id, $PK03->id])
                ->paginate(10);

            $no_mak_perkantoran = Parameter::where('name', '=', 'Layan Perkantoran')->first();

            $rkakls = Rkakl::where('level', '=', 11)
                ->where('no_mak_sys', 'like', '%' . $no_mak_perkantoran->value . '%')
                ->get();
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perkantorans = Perkantoran::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PK01->id, $PK02->id, $PK03->id, $KG05->id])
                ->paginate(10);

            $no_mak_perkantoran = Parameter::where('name', '=', 'Layan Perkantoran')->first();

            $rkakls = Rkakl::where('level', '=', 11)
                ->where('no_mak_sys', 'like', '%' . $no_mak_perkantoran->value . '%')
                ->get();
        } elseif (\Auth::user()->hasRole('administrator')) {
            $perkantorans = Perkantoran::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$PK01->id, $PK02->id, $PK03->id, $KG05->id])
                ->paginate(10);

            $no_mak_perkantoran = Parameter::where('name', '=', 'Layan Perkantoran')->first();

            $rkakls = Rkakl::where('level', '=', 11)
                ->where('no_mak_sys', 'like', '%' . $no_mak_perkantoran->value . '%')
                ->get();
        }

    	return view('backend.pengajuan.perkantoran.index', ['perkantorans' => $perkantorans, 'rkakls' => $rkakls]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Perkantoran::rules());

        if($validator->fails())
        {
            return redirect()->route('pengajuan.layanan-perkantoran.index')->withErrors($validator)->withInput();
        }

        $check = NoPengajuan::where('bagian_id', '=', \Auth::user()->bagian_id)
            ->where('jenis', '=', 'Perkantoran')->first();

        if ($check === null) {
            $nopengajuan = new NoPengajuan();

            $nopengajuan->bagian_id      = \Auth::user()->bagian_id;
            $nopengajuan->nomor          = 0;
            $nopengajuan->jenis          = 'Perkantoran';
            $nopengajuan->kode_transaksi = '03';

            $nopengajuan->save();
        }

        $get_no = NoPengajuan::where('bagian_id', '=', \Auth::user()->bagian->id)
            ->where('jenis', '=', 'Perkantoran')->first();

        $nox = $get_no->nomor + 1;

        switch (strlen($nox)) {
            case 1:
                $no = '000' . $nox;
                break;
            case 2:
                $no = '00' . $nox;
                break;
            case 3:
                $no = '0' . $nox;
                break;
            
            default:
                $no = $nox;
                break;
        }

        $noaju = 'AJU-' . $no . '/' . \Auth::user()->bagian->kode . '/' . date('Y');

        $status_id = Status::where('kode_status', 'PK00')->first();

        $saveperkantoran = new Perkantoran();

        $saveperkantoran->no_pengajuan  = $noaju;
        $saveperkantoran->tgl_pengajuan = Carbon::now();
        $saveperkantoran->no_mak        = $request->no_mak;
        $saveperkantoran->uraian        = $request->uraian;
        $saveperkantoran->keterangan    = $request->keterangan;
        $saveperkantoran->status_id     = $status_id->id;

        $saveperkantoran->save();

        NoPengajuan::where('bagian_id', '=', \Auth::user()->bagian_id)
            ->where('jenis', '=', 'Perkantoran')
            ->update(['nomor' => $nox]);

        $perkantoran = Perkantoran::where('no_pengajuan', '=', $noaju)->first();

        \Session::flash('success', trans('backend/perkantoran.perkantoran.store.messages.success'));
        return redirect()->route('pengajuan.layanan-perkantoran.detail-perkantoran', $perkantoran->id)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/perkantoran.perkantoran.destroy.messages.info'));

            return redirect()->route('pengajuan.layanan-perkantoran.index');
        }

        DokumenPerkantoran::where('perkantoran_id', $id)->delete();
        DetailPerkantoran::where('perkantoran_id', $id)->delete();
        Perkantoran::where('id', $id)->delete();

        \Session::flash('success', trans('backend/perkantoran.perkantoran.destroy.messages.success'));

        return redirect()->route('pengajuan.layanan-perkantoran.index');
    }

    public function memuatUraian($no_mak)
    {
        $uraian = Rkakl::where('no_mak_sys', '=', $no_mak)->get();

        $data = [
            'uraian_data' => $uraian,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function draftPerkantoran($id)
    {
        $perkantorans       = Perkantoran::where('id', $id)->first();
        $detailPerkantorans = DetailPerkantoran::where('perkantoran_id', '=', $id)->get();

        $pengajuan = DetailPerkantoran::select(\DB::raw('sum(jumlah) as jumlah'))
            ->where('perkantoran_id', '=', $id)
            ->first();

        $dokumenPerkantorans = DokumenPerkantoran::where('perkantoran_id', '=', $id)->paginate(10);

        $metodebayars = MetodeBayar::orderBy('created_at', 'desc')->get();
        $statuss      = Status::where('modul', 'FORMKN01')->get();

//        \Session::flash('success', trans('backend/perkantoran.perkantoran.store.messages.success'));
        return view('backend.pengajuan.perkantoran.draftperkantoran.index', ['perkantorans' => $perkantorans, 'detailPerkantorans' => $detailPerkantorans, 'pengajuan' => $pengajuan, 'dokumenPerkantorans' => $dokumenPerkantorans, 'metodebayars' => $metodebayars, 'statuss' => $statuss]);
    }

    public function kirimPerkantoran($id)
    {
        $detail = DetailPerkantoran::where('perkantoran_id', '=', $id)->get();
        $totalpengajuan = 0;

        foreach ($detail as $key => $value) {
            $totalpengajuan = $totalpengajuan + $value->jumlah;

            $cek_transaksi = Transaksi::where('no_mak_sys', '=', $value->no_mak_sys)
                ->where('keterangan', '=', 'Perkantoran')
                ->where('id_t', '=', $value->perkantoran_id)
                ->get();
        
            if($cek_transaksi->count() == 0)
            {
                $transaksi = new Transaksi();

                $transaksi->id_t       = $value->perkantoran_id;
                $transaksi->no_mak_sys = $value->no_mak_sys;
                $transaksi->jumlah     = $value->jumlah;
                $transaksi->kode_9     = $value->kode_9;
                $transaksi->kode_4     = $value->kode_4;
                $transaksi->kode_8     = $value->kode_8;
                $transaksi->kode_6     = $value->kode_6;
                $transaksi->kode_7     = $value->kode_7;
                $transaksi->kode_11    = $value->kode_11;
                $transaksi->kode_0     = $value->kode_0;
                $transaksi->keterangan = 'Perkantoran';
                $transaksi->status     = 'RL02';

                $transaksi->save();
            }
        }

        $status_id = Status::where('kode_status', 'PK01')->first();

        Perkantoran::where('id', '=', $id)
            ->update([
                'status_id'   => $status_id->id,
                'total_nilai' => $totalpengajuan
            ]);

        $this->hitung_transaksi('RL02');

        \Session::flash('success', trans('backend/perkantoran.perkantoran.sent.messages.success'));

        return redirect()->route('pengajuan.layanan-perkantoran.index');
    }

    public function hitung_transaksi($kode_realisasi)
    {
        switch ($kode_realisasi) {
            case 'RL02':
                $field_nilai = 'realisasi_2';
                $field_vol   = 'vol_2';
                break;
            case 'RL03':
                $field_nilai = 'realisasi_3';
                $field_vol   = 'vol_3';
                break;
            default:
                $field_nilai = 'realisasi';
                $field_vol   = 'vol_pengajuan';
                break;
        }

        $detail = Transaksi::groupby( 'kode_9', 'kode_8', 'kode_6', 'kode_7', 'kode_11', 'kode_0', 'status')
        ->selectRaw('kode_9, kode_8, kode_6, kode_7, kode_11, kode_0, sum(jumlah) as nilai, vol')
        ->where('status', '=', $kode_realisasi)
        ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value['kode_9'] .".". $value['kode_8'] .".". $value['kode_6'] .".". $value['kode_7'] .".". $value['kode_11'] ."." . $value['kode_0'];

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field_nilai => $value->nilai,
                    $field_vol   => $value->vol
                ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $PK00 = Status::where('kode_status', '=', 'PK00')->first();
        $PK01 = Status::where('kode_status', '=', 'PK01')->first();
        $PK02 = Status::where('kode_status', '=', 'PK02')->first();
        $PK03 = Status::where('kode_status', '=', 'PK03')->first();

        if (\Auth::user()->hasRole('user')) {
            $perkantorans = Perkantoran::orderBy('perkantoran.created_at', 'asc')
                ->join('status', 'status.id', '=', 'perkantoran.status_id')
                ->where($request->options,'like', '%' . $request->search . '%')
                ->whereIn('perkantoran.status_id', [$PK00->id, $PK01->id, $PK02->id, $PK03->id])
                ->paginate(10);

            $no_mak_perkantoran = Parameter::where('name', '=', 'Layan Perkantoran')->first();

            $rkakls = Rkakl::where('level', '=', 11)
                ->where('no_mak_sys', 'like', '%' . $no_mak_perkantoran->value . '%')
                ->get();
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $perkantorans = Perkantoran::orderBy('perkantoran.created_at', 'asc')
                ->join('status', 'status.id', '=', 'perkantoran.status_id')
                ->where($request->options,'like', '%' . $request->search . '%')
                ->whereIn('perkantoran.status_id', [$PK01->id, $PK02->id, $PK03->id])
                ->paginate(10);

            $no_mak_perkantoran = Parameter::where('name', '=', 'Layan Perkantoran')->first();

            $rkakls = Rkakl::where('level', '=', 11)
                ->where('no_mak_sys', 'like', '%' . $no_mak_perkantoran->value . '%')
                ->get();
        }

        return view('backend.pengajuan.perkantoran.index', ['perkantorans' => $perkantorans, 'rkakls' => $rkakls]);
    }

    public function kirimBendahara(Request $request, $id)
    {
        if ($request->keterangan == 'PG01') {
            $rules = array(
                'metode'     => 'required',
                'status_id'  => 'required',
                'keterangan' => 'required',
            );
        } else {
            $rules = array(
                'keterangan' => 'required',
                'alasan'     => 'required'
            );
        }

        $validator = \Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->route('pengajuan.layanan-perkantoran.draft-perkantoran', $request->id)->withErrors($validator)->withInput();
        }

        if ($request->keterangan == 'PG01') {
            Perkantoran::where('id', '=', $id)
                ->update([
                    'status_id' => $request->status_id,
                    'metode'    => $request->metode,
                ]);

            Transaksi::where('id_t', '=', $id)
                ->where('keterangan', '=', 'Perkantoran')
                ->update([
                    'status' => 'RL02'
                ]);
        } else {
            $PK99 = Status::where('kode_status', '=', 'PK99')->first();
            Perkantoran::where('id', '=', $id)
                ->update([
                    'status_id' => $PK99->id,
                    'alasan'    => $request->alasan,
                ]);
        }

        \Session::flash('success', trans('backend/perkantoran.perkantoran.sent.messages.success'));

        return redirect()->route('pengajuan.layanan-perkantoran.index')->withInput();
    }

    /**
     * @param $id
     * @return $this
     */
    public function serahkanUang($id)
    {
        $PK15 = Status::where('kode_status', '=', 'PK15')->first();
        Perkantoran::where('id' , '=' , $id)
            ->update([
                'status_id' => $PK15->id
            ]);

        \Session::flash('success', trans('backend/perkantoran.perkantoran.submodule.draft_perkantoran.sent.messages.success'));
        return redirect()->route('pengajuan.layanan-perkantoran.index')->withInput();
    }

    public function notaDinas($id)
    {
        $perkantoran        = Perkantoran::find($id);
        $details            = DetailPerkantoran::where('perkantoran_id', $id)->get();
        $tanggalprint       = $this->tanggalIndonesia(Carbon::Now());
        $pimpinan           = Pimpinan::where('bagian_id', \Auth::user()->bagian_id)->first();

        $pdf = PDF::loadView('backend.pengajuan.perkantoran.laporan.notadinas', ['perkantoran' => $perkantoran, 'tanggalprint' => $tanggalprint, 'pimpinan' => $pimpinan, 'details' => $details ]);

        return $pdf->stream('notadinas_'.Carbon::now()->format('d-m-Y').'.pdf');

    }

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

}