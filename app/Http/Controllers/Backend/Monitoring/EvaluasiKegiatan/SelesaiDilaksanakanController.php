<?php

namespace App\Http\Controllers\Backend\Monitoring\EvaluasiKegiatan;

use App\Models\Backend\Master\Status;
use App\Models\Backend\Pengajuan\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelesaiDilaksanakanController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $KG13 = Status::where('kode_status', '=', 'KG13')->first();

        $kegiatans = Kegiatan::orderBy('created_at', 'desc')
            ->where('status_id', $KG13->id)
            ->get();
        $totalrealisasi = Kegiatan::select(\DB::raw('sum(total_realisasi) as total_realisasi'))
            ->where('status_id', $KG13->id)
            ->first();

        return view('backend.monitoring.evaluasikegiatan.selesaidilaksanakan.index', [
            'kegiatans'      => $kegiatans,
            'totalrealisasi' => $totalrealisasi
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $KG13 = Status::where('kode_status', '=', 'KG13')->first();

        $kegiatans = Kegiatan::orderBy('kegiatan.created_at', 'desc')
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->where('kegiatan.status_id', $KG13->id)
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get();

        $totalkegiatan = Kegiatan::where('kegiatan.status_id', $KG13->id)
            ->where($request->options,'like', '%' . $request->search . '%')
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->get()->count();

        $totalrealisasi = Kegiatan::select(\DB::raw('sum(total_realisasi) as total_realisasi'))
            ->where('kegiatan.status_id', $KG13->id)
            ->where($request->options, 'like', '%' . $request->search . '%')
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->first();

        return view('backend.monitoring.evaluasikegiatan.selesaidilaksanakan.index', ['kegiatans' => $kegiatans, 'totalkegiatan' => $totalkegiatan, 'totalrealisasi' => $totalrealisasi]);
    }
}
