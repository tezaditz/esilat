<?php

namespace App\Http\Controllers\Backend\Pengajuan\LayananPerkantoran;

use App\Models\Backend\Pengajuan\LayananPerkantoran\DokumenPerkantoran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DokumenPerkantoranController extends Controller
{
    /**
     * @param $perkantoran_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($perkantoran_id)
    {
        $dokumenperkantorans = DokumenPerkantoran::orderBy('created_at', 'desc')
            ->where('perkantoran_id', '=', $perkantoran_id)->paginate(10);

        return view('backend.pengajuan.perkantoran.dokumenperkantoran.index', ['dokumenperkantorans' => $dokumenperkantorans, 'perkantoran_id' => $perkantoran_id]);
    }

    /**
     * @param Request $request
     * @param $perkantoran_id
     * @return $this
     */
    public function store(Request $request, $perkantoran_id)
    {
        $validator = \Validator::make($request->all(), DokumenPerkantoran::rules());

        if($validator->fails())
        {
            return redirect()->route('pengajuan.layanan-perkantoran.dokumen', $perkantoran_id)->withErrors($validator)->withInput();
        }

        $insert = new DokumenPerkantoran();

        $insert->nama_dokumen   = $request->nama_dokumen;
        $insert->ada            = $request->ada;
        $insert->perkantoran_id = $perkantoran_id;

        $insert->save();

        \Session::flash('success', trans('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.store.messages.success'));

        return redirect()->route('pengajuan.layanan-perkantoran.dokumen', $perkantoran_id)->withInput();
    }

    /**
     * @param $perkantoran_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($perkantoran_id, $id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.destroy.messages.info'));

            return redirect()->route('pengajuan.layanan-perkantoran.dokumen', $perkantoran_id);
        }

        DokumenPerkantoran::destroy($id);
        \Session::flash('success', trans('backend/perkantoran.perkantoran.submodule.dokumen_perkantoran.destroy.messages.success'));

        return redirect()->route('pengajuan.layanan-perkantoran.dokumen', $perkantoran_id);
    }

    /**
     * @param Request $request
     * @param $perkantoran_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request, $perkantoran_id)
    {
        $dokumenperkantorans = DokumenPerkantoran::where('perkantoran_id', '=', $perkantoran_id)
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.pengajuan.perkantoran.dokumenperkantoran.index', ['dokumenperkantorans' => $dokumenperkantorans, 'perkantoran_id' => $perkantoran_id]);
    }
}