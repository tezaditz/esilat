<?php

namespace App\Http\Controllers\Backend\Pengajuan\Perjadin;

use App\Models\Backend\Pengajuan\Perjadin\PerjadinAkun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\PertanggungJawaban\DetailPerjadin;

class PerjadinAkunController extends Controller
{
    /**
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function perjadinAkun($perjadin_id)
    {
        $perjadinakuns = PerjadinAkun::where('perjadin_id', $perjadin_id)
                                     ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                     ->Paginate(10);

    	return view('backend.pengajuan.perjadin.detailakun.index', ['perjadinakuns' => $perjadinakuns, 'perjadin_id' => $perjadin_id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $detailakun = PerjadinAkun::where('id', $id)
                                  ->where('keterangan', '=', 'perjadin-dalam-negeri')
                                  ->first();

        if (is_null($id)) {
            \Session::flash('info', trans('backend/pertanggungjawaban.perjadin.submodule.detail_akun.destroy.messages.info'));

            return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-akun', $detailakun->perjadin_id);
        }

        PerjadinAkun::destroy($id);
        \Session::flash('success', trans('backend/pertanggungjawaban.perjadin.submodule.detail_akun.destroy.messages.success'));

        return redirect()->route('pengajuan.perjadin-dalam-negeri.detail-akun', $detailakun->perjadin_id);
    }

    /**
     * @param Request $request
     * @param $perjadin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request, $perjadin_id)
    {
        $perjadinakuns = PerjadinAkun::where('perjadin_id', $perjadin_id)
            ->where($request->options,'like', '%' . $request->search . '%')
            ->Paginate(10);

        return view('backend.pengajuan.perjadin.detailakun.index', ['perjadinakuns' => $perjadinakuns, 'perjadin_id' => $perjadin_id]);
    }
}