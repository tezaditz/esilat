<?php

namespace App\Http\Controllers\Backend\Monitoring\EvaluasiKegiatan;

use App\Models\Backend\Master\Status;
use App\Models\Backend\Pengajuan\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SedangDiajukanController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $KG00 = Status::where('kode_status', '=', 'KG00')->first();
        $KG01 = Status::where('kode_status', '=', 'KG01')->first();
        $KG04 = Status::where('kode_status', '=', 'KG04')->first();
        $KG05 = Status::where('kode_status', '=', 'KG05')->first();

        $kegiatans = Kegiatan::orderBy('created_at', 'desc')
            ->whereIn('status_id', [$KG00->id, $KG01->id, $KG04->id, $KG05->id])
            ->get();
        $totalkegiatan = Kegiatan::whereIn('status_id', [$KG00->id, $KG01->id, $KG04->id, $KG05->id])
            ->get()->count();
        $totalrealisasi = Kegiatan::select(\DB::raw('sum(total_realisasi) as total_realisasi'))
            ->whereIn('status_id', [$KG00->id, $KG01->id, $KG04->id, $KG05->id])
            ->first();

        return view('backend.monitoring.evaluasikegiatan.sedangdiajukan.index', ['kegiatans' => $kegiatans, 'totalkegiatan' => $totalkegiatan, 'totalrealisasi' => $totalrealisasi]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $KG00 = Status::where('kode_status', '=', 'KG00')->first();
        $KG01 = Status::where('kode_status', '=', 'KG01')->first();
        $KG04 = Status::where('kode_status', '=', 'KG04')->first();
        $KG05 = Status::where('kode_status', '=', 'KG05')->first();

        $kegiatans = Kegiatan::orderBy('kegiatan.created_at', 'desc')
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->whereIn('kegiatan.status_id', [$KG00->id, $KG01->id, $KG04->id, $KG05->id])
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get();

        $totalkegiatan = Kegiatan::whereIn('status_id', [$KG00->id, $KG01->id, $KG04->id, $KG05->id])
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get()->count();

        $totalrealisasi = Kegiatan::select(\DB::raw('sum(total_realisasi) as total_realisasi'))
            ->whereIn('status_id', [$KG00->id, $KG01->id, $KG04->id, $KG05->id])
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->where($request->options, 'like', '%' . $request->search . '%')
            ->first();

        return view('backend.monitoring.evaluasikegiatan.sedangdiajukan.index', ['kegiatans' => $kegiatans, 'totalkegiatan' => $totalkegiatan, 'totalrealisasi' => $totalrealisasi]);
    }
}