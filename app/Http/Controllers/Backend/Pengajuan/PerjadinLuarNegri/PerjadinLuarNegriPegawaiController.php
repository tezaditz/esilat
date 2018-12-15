<?php

namespace App\Http\Controllers\Backend\Pengajuan\PerjadinLuarNegri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Master\Pegawai;
use App\Models\Backend\Pengajuan\Jadwal;
use App\Models\Backend\Pengajuan\PerjadinLuarNegri\PerjadinLuarNegri;
use Carbon\Carbon;

class PerjadinLuarNegriPegawaiController extends Controller
{
    //
    /**
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPegawai($perjadin_id)
	{
		$pegawais = Pegawai::orderBy('jabatan_id', 'ASC')->get();
        $total    = Pegawai::orderBy('jabatan_id', 'ASC')->get()->count();

        $perjadin = PerjadinLuarNegri::where('id', $perjadin_id)->first();
        $start    = Carbon::parse($perjadin->tgl_awal);
        $end      = Carbon::parse($perjadin->tgl_akhir);
        $dt       = $end->diffInDays($start) + 1;

      	return view('backend.pengajuan.perjadinluarnegri.listpegawai.index', ['pegawais' => $pegawais, 'dt' => $dt, 'perjadin_id' => $perjadin_id, 'total' => $total]);
	}

    /**
     * @param $perjadin_id
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function pilihPegawai($perjadin_id, Request $request)
    {
        if (is_null($request->chk)) {
//            \Session::flash('info', trans('backend/master/pegawai.pegawai.store.messages.info'));
//            return redirect()->route('pengajuan.perjadin-luar-negeri.list-pegawai', $perjadin_id);
            \Session::flash('success', trans('backend/pengajuan.kegiatan.pilih.messages.success'));
            return redirect()->route('pengajuan.perjadin-luar-negeri.draft-perjadin', $perjadin_id)->withInput();
        }

        Jadwal::where('kegiatan_id', $perjadin_id)->delete();

        $perjadin = PerjadinLuarNegri::where('id', $perjadin_id)->first();
        $start = Carbon::parse($perjadin->tgl_awal);

        foreach ($request->chk as $key => $value) {
            $x = 1;
            $jadwal = new Jadwal();

            $jadwal->tanggal        = $start->addDays($x);
            $jadwal->pegawai_id     = $request->chk[$key];
            $jadwal->kegiatan_id    = $perjadin_id;
            $jadwal->judul_kegiatan = $perjadin->nama_kegiatan;
            $jadwal->keterangan     = 'perjadin-luar-negeri';

            $jadwal->save();
        };

        \Session::flash('success', trans('backend/pengajuan.kegiatan.pilih.messages.success'));
        return redirect()->route('pengajuan.perjadin-luar-negeri.draft-perjadin', $perjadin_id)->withInput();
    }

    public function destroy($perjadin_id, $id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/pegawai.pegawai.destroy.messages.info'));

            return redirect()->route('master.pegawai.index');
        }

        Jadwal::destroy($id);
        \Session::flash('success', trans('backend/master/pegawai.pegawai.destroy.messages.success'));

        return redirect()->route('pengajuan.perjadin-luar-negeri.draft-perjadin', $perjadin_id);
    }


}
