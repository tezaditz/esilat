<?php

namespace App\Http\Controllers\Backend\Pengajuan;

use App\Models\Backend\Pengajuan\DetailAkun;
use App\Http\Controllers\Controller;
use App\Models\Backend\Pengajuan\DetailKegiatan;
use Illuminate\Http\Request;

class DetailAkunController extends Controller
{
    /**
     * @param $kegiatan_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailAkun($kegiatan_id)
    {
        $d_akuns         = DetailAkun::where('kegiatan_id', $kegiatan_id)->Paginate(10);
        $total           = DetailAkun::where('kegiatan_id', $kegiatan_id)->get()->count();
        $detailkegiatans = DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)->get();

        return view('backend.pengajuan.kegiatan.detailakun.index', ['d_akuns' => $d_akuns, 'total' => $total, 'kegiatan_id' => $kegiatan_id, 'detailkegiatans' => $detailkegiatans]);
    }

    /**
     * @param Request $request
     * @param $kegiatan_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request, $kegiatan_id)
    {
        $d_akuns = DetailAkun::orderBy('created_at', 'desc')
            ->where('kegiatan_id', '=', $kegiatan_id)
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);
        $total = DetailAkun::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->get()->count();
        $detailkegiatans = DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)->get();

        return view('backend.pengajuan.kegiatan.detailakun.index', ['d_akuns' => $d_akuns, 'total' => $total, 'kegiatan_id' => $kegiatan_id, 'detailkegiatans' => $detailkegiatans]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $detailakun = DetailAkun::where('id', $id)->first();

        if (is_null($id)) {
            \Session::flash('info', trans('backend/pengajuan.kegiatan.submodule.detail_akun.destroy.messages.info'));

            return redirect()->route('pengajuan.kegiatan.detail-akun', $detailakun->kegiatan_id);
        }

        DetailAkun::destroy($id);
        \Session::flash('success', trans('backend/pengajuan.kegiatan.submodule.detail_akun.destroy.messages.success'));

        return redirect()->route('pengajuan.kegiatan.detail-akun', $detailakun->kegiatan_id);
    }
}