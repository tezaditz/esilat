<?php

namespace App\Http\Controllers\Backend\Pengajuan;

use App\Models\Backend\Master\Pegawai;
use App\Models\Backend\Pengajuan\Jadwal;
use App\Models\Backend\Pengajuan\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    /**
     * @param $kegiatan_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPegawai($kegiatan_id)
    {
        $pegawais = Pegawai::orderBy('jabatan_id', 'ASC')->get();
        $total    = Pegawai::orderBy('jabatan_id', 'ASC')->get()->count();

        $kegiatan = Kegiatan::where('id', $kegiatan_id)->first();
        $start    = Carbon::parse($kegiatan->tgl_awal);
        $end      = Carbon::parse($kegiatan->tgl_akhir);
        $dt       = $start->diffInDays($end) + 1;

        return view('backend.pengajuan.kegiatan.listpegawai.index', ['pegawais' => $pegawais, 'dt' => $dt, 'kegiatan_id' => $kegiatan_id, 'total' => $total]);
    }

    /**
     * @param $kegiatan_id
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function pilihPegawai($kegiatan_id, Request $request)
    {
        if (is_null($request->chk)) {
//            \Session::flash('info', trans('backend/master/pegawai.pegawai.store.messages.info'));
//            return redirect()->route('pengajuan.kegiatan.list-pegawai', $kegiatan_id);
            \Session::flash('success', trans('backend/pengajuan.kegiatan.pilih.messages.success'));
            return redirect()->route('pengajuan.kegiatan.draft-kegiatan', $kegiatan_id)->withInput();
        }

        Jadwal::where('kegiatan_id', $kegiatan_id)->delete();

        $kegiatan = Kegiatan::where('id', $kegiatan_id)->first();
        $start    = Carbon::parse($kegiatan->tgl_awal);

        foreach ($request->chk as $key => $value) {
            $x = 1;
            $jadwal = new Jadwal();

            $jadwal->tanggal        = $start->addDays($x);
            $jadwal->pegawai_id     = $request->chk[$key];
            $jadwal->kegiatan_id    = $kegiatan_id;
            $jadwal->judul_kegiatan = $kegiatan->nama_kegiatan;
            $jadwal->keterangan     = 'kegiatan';

            $jadwal->save();
        }

        \Session::flash('success', trans('backend/pengajuan.kegiatan.pilih.messages.success'));
        return redirect()->route('pengajuan.kegiatan.draft-kegiatan', $kegiatan_id)->withInput();
    }

    /**
     * @param $kegiatan_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($kegiatan_id, $id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/pegawai.pegawai.destroy.messages.info'));

            return redirect()->route('master.status.index');
        }

        Jadwal::destroy($id);
        \Session::flash('success', trans('backend/master/pegawai.pegawai.destroy.messages.success'));

        return redirect()->route('pengajuan.kegiatan.draft-kegiatan', $kegiatan_id);
    }
}