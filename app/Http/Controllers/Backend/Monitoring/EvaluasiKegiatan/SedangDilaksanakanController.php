<?php

namespace App\Http\Controllers\Backend\Monitoring\EvaluasiKegiatan;

use App\Models\Backend\Master\Status;
use App\Models\Backend\Pengajuan\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SedangDilaksanakanController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $KG08 = Status::where('kode_status', '=', 'KG08')->first();
        $KG09 = Status::where('kode_status', '=', 'KG09')->first();

        $kegiatans = Kegiatan::orderBy('created_at', 'desc')
            ->whereIn('status_id', [$KG06->id, $KG08->id, $KG09->id])
            ->get();
        $totalkegiatan = Kegiatan::whereIn('status_id', [$KG06->id, $KG08->id, $KG09->id])
            ->get()->count();
        $totalrealisasi = Kegiatan::select(\DB::raw('sum(total_realisasi) as total_realisasi'))
            ->whereIn('status_id', [$KG06->id, $KG08->id, $KG09->id])
            ->first();

        return view('backend.monitoring.evaluasikegiatan.sedangdilaksanakan.index', ['kegiatans' => $kegiatans, 'totalkegiatan' => $totalkegiatan, 'totalrealisasi' => $totalrealisasi]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $KG08 = Status::where('kode_status', '=', 'KG08')->first();
        $KG09 = Status::where('kode_status', '=', 'KG09')->first();

        $kegiatans = Kegiatan::orderBy('kegiatan.created_at', 'desc')
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->whereIn('kegiatan.status_id', [$KG06->id, $KG08->id, $KG09->id])
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get();

        $totalkegiatan = Kegiatan::whereIn('kegiatan.status_id', [$KG06->id, $KG08->id, $KG09->id])
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get()->count();

        $totalrealisasi = Kegiatan::select(\DB::raw('sum(total_realisasi) as total_realisasi'))
            ->whereIn('kegiatan.status_id', [$KG06->id, $KG08->id, $KG09->id])
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->where($request->options, 'like', '%' . $request->search . '%')
            ->first();

        return view('backend.monitoring.evaluasikegiatan.sedangdilaksanakan.index', ['kegiatans' => $kegiatans, 'totalkegiatan' => $totalkegiatan, 'totalrealisasi' => $totalrealisasi]);
    }
}
