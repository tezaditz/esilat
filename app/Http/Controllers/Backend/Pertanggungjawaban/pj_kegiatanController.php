<?php

namespace App\Http\Controllers\Backend\Pertanggungjawaban;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Backend\Pengajuan\Kegiatan;
use App\Models\Backend\Master\Status;
use App\Models\Backend\Nominatif\Nominatif;
use App\Models\Backend\Pengajuan\DetailKegiatan;
use App\Models\Backend\Pengajuan\Transaksi;

use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class pj_kegiatanController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $KG08 = Status::where('kode_status', '=', 'KG08')->first();
        $KG09 = Status::where('kode_status', '=', 'KG09')->first();
        $KG11 = Status::where('kode_status', '=', 'KG11')->first();
        $KG12 = Status::where('kode_status', '=', 'KG12')->first();

        if (\Auth::user()->hasRole('user')) {
            $kegiatans = Kegiatan::orderBy('created_at', 'asc')
                ->where('bagian_id', \Auth::user()->bagian_id)
                ->whereIn('status_id', [$KG06->id, $KG08->id, $KG11->id, $KG12->id, $KG09->id])
                ->paginate(10);
            $totalpengajuans = DetailKegiatan::select(\DB::raw('sum(jml_rph) as jml_rph'))
            ->where('header', '=', '0')
                ->first();
        } else {
            $kegiatans = Kegiatan::orderBy('created_at', 'asc')
//                ->where('bagian_id', \Auth::user()->bagian_id)
                ->whereIn('status_id', [$KG06->id, $KG08->id, $KG11->id, $KG12->id, $KG09->id])
                ->paginate(10);
            $totalpengajuans = DetailKegiatan::select(\DB::raw('sum(jml_rph) as jml_rph'))
                ->where('header', '=', '0')
                ->first();
        }

        return view('backend.pertanggungjawaban.kegiatan.index', [
            'kegiatans'       => $kegiatans,
            'totalpengajuans' => $totalpengajuans,
        ]);
    }

    public function show($id)
    {
        
        $kegiatan = Kegiatan::findOrFail($id);
//        $Provinsi = Provinsi::where('id', $kegiatan->provinsi_id)->first();
//        $akun     = DetailAkun::where('kegiatan_id', $id)->get();
        $details  = DetailKegiatan::where('kegiatan_id', $id)
            ->where('header', '=', '0')->get();

        $totalpengajuan = DetailKegiatan::select(\DB::raw('sum(jml_rph) as jml_rph'))
            ->where('kegiatan_id', $id)
            ->where('header', '=', '0')
            ->first();
        $totalpjpengajuan = DetailKegiatan::select(\DB::raw('sum(pj_jml_rph) as pj_jml_rph'))
            ->where('kegiatan_id', $id)
            ->where('header', '=', '0')
            ->first();

//        $honor     = "";
//        $jeniskeg  = 0;
//        $fullboard = DetailAkun::where('akun', '=', '524119 ')
//            ->where('kegiatan_id', '=', $id)
//            ->count();

        $nominatifs = Nominatif::where('kegiatan_id', '=', $id)
            ->where('flag', '=', 1)
            ->where('peserta', '=', 1)->paginate(100);

        $nominatif_daerahs = Nominatif::where('kegiatan_id', '=', $id)
            ->where('flag', '=', 1)
            ->where('peserta', '=', 2)->paginate(100);

        $nominatif_fullday_pusats = Nominatif::where('kegiatan_id', '=', $id)
            ->where('flag', '=', 2)
            ->where('peserta', '=', 1)->paginate(100);

        $nominatif_fullday_lokals = Nominatif::where('kegiatan_id', '=', $id)
            ->where('flag', '=', 2)
            ->where('peserta', '=', 0)->paginate(100);

        $nominatif_perjadins = nominatif::where('kegiatan_id', '=', $id)
            ->where('flag', '=', 3)->paginate(100);

//        if ($fullboard != 0) {
//            $jenisKeg = 1;
//        }
            

        return view('backend.pertanggungjawaban.kegiatan.detail', [
            'kegiatan'            => $kegiatan,
            'totalpengajuan'      => $totalpengajuan,
            'totalpjpengajuan'    => $totalpjpengajuan,
            'details'             => $details,
            'nominatif_perjadins' => $nominatif_perjadins,

//            'Provinsi'                 => $Provinsi,
//            'akun'                     => $akun,
////            'honor'                   => $honor,
//            'fullboard'                => $fullboard,
            'nominatifs'               => $nominatifs,
            'nominatif_daerahs'        => $nominatif_daerahs,
            'nominatif_fullday_pusats' => $nominatif_fullday_pusats,
            'nominatif_fullday_lokals' => $nominatif_fullday_lokals,
        ]);
    }

    /**
     * @param Request $request
     * @param $kegiatan_id
     * @return $this
     */
    public function simpanDetail(Request $request, $kegiatan_id)
    {
        foreach ($request->id as $key => $value) {
            $jml = str_replace(".", "", $request->jml[$key]);
            DetailKegiatan::where('id', $value)
                ->update([
                    'pj_jml_rph' => $jml
                ]);
        }

        if ($request->rampung == 1) {
            $KG09 = Status::where('kode_status', '=', 'KG09')->first();
            Kegiatan::where('id', $kegiatan_id)
                ->update([
                    'status_id' => $KG09->id,
                ]);

            \Session::flash('success', trans('backend/pengajuan.kegiatan.rampung.messages.success'));
            return redirect()->route('pertanggungjawaban.kegiatan.index')->withInput();
        }

        \Session::flash('success', trans('backend/pengajuan.kegiatan.rampung.messages.info'));
        return redirect()->route('pertanggungjawaban.kegiatan.detail', $kegiatan_id)->withInput();
    }

//    public function kirimPertanggungjawaban($id)
//    {
//        $KG09 = Status::where('kode_status', 'KG09')->first();
//        Kegiatan::where('id', '=', $id)
//            ->update([
//                'status_id' => $KG09->id
//            ]);
//
//        \Session::flash('info', trans('backend/pertanggungjawaban.kegiatan.store.messages.info'));
//        return redirect()->route('pertanggungjawaban.kegiatan.index');
//    }

    public function import(Request $request)
    {
        $input = $request->all();
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            Excel::load($path, function ($reader) use ($input){
                $reader->noHeading();
                $reader->skipRows(7);
                $reader->each(function ($sheet) use ($input){
                    $x = 0;
                    foreach ($sheet->toArray() as $row){
                        if ($row[1] != null) {
                            $x = $x + 1;

                            $dataUpload = new Nominatif();

                            $dataUpload->kegiatan_id        = $input['kegiatan_id'];
                            $dataUpload->peserta_id         = $x; // NO
                            $dataUpload->nama_peserta       = $row[1]; // nama
                            $dataUpload->nip                = $row[2]; // nip
                            $dataUpload->instansi           = $row[3];  // instansi
                            $dataUpload->gol                = $row[4]; // gol
                            $dataUpload->daerah_asal        = $row[5]; // tujuan => dari
                            $dataUpload->prov_daerah_tujuan = $row[6]; // tujuan => ke
                            $dataUpload->tgl_berangkat      = $row[7]; // tanggal spd
                            $dataUpload->tgl_kembali        = $row[8]; // tanggal spd
                            $dataUpload->lama               = $row[9]; // hari
                            $dataUpload->tiket_pesawat      = $row[10]; // transport => pesawat
                            $dataUpload->transport          = $row[11]; // transport => taksi
                            $dataUpload->uang_harian        = $row[13]; // uangsaku = > nilai satuan * lama
                            $dataUpload->penginapan         = $row[14]; // penginapan = > nilai satuan * lama
                            $dataUpload->flag               = $input['flag'];
                            $dataUpload->peserta            = $input['peserta'];

                            $dataUpload->save();
                        }
                    }
                });
            });

            \Session::flash('success', trans('backend/pertanggungjawaban.nominatif.store.messages.success'));

            return redirect()->back()->withInput();
        }
        \Session::flash('info', trans('backend/pertanggungjawaban.nominatif.store.messages.success'));

        return redirect()->back();
    }

    public function importfb(Request $request)
    {
        $input = $request->all();
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            Excel::load($path, function ($reader) use ($input){
                $reader->noHeading();
                $reader->skipRows(7);
                $reader->each(function ($sheet) use ($input){
                    $x = 0;
                    $kegiatan_id  = $input['kegiatan_id'];
                    $datakegiatan = Kegiatan::where('id', '=', $kegiatan_id)->get(); 
                    foreach ($sheet->toArray() as $row){
                        if ($row[1] != null) {
                            $x = $x + 1;

                            $dataUpload = new Nominatif();

                            $dataUpload->kegiatan_id        = $kegiatan_id;
                            $dataUpload->peserta_id         = $x; // NO
                            $dataUpload->nama_peserta       = $row[1]; // nama
                            $dataUpload->nip                = $row[2]; // nip
                            $dataUpload->instansi           = $row[3];  // instansi
                            $dataUpload->gol                = $row[4]; // gol
                            $dataUpload->daerah_asal        = 'DKI Jakarta'; // tujuan => dari
                            $dataUpload->prov_daerah_tujuan = 'DKI Jakarta'; // tujuan => ke
                            $dataUpload->tgl_berangkat      = $datakegiatan[0]['tgl_awal']; // tanggal spd
                            $dataUpload->tgl_kembali        = $datakegiatan[0]['tgl_akhir']; // tanggal spd
                            $dataUpload->lama               = $row[5]; // hari
                            $dataUpload->transport          = $row[6]; // transport => taksi
                            $dataUpload->uang_harian        = $row[7]; // uangsaku = > nilai satuan * lama
                            $dataUpload->flag               = $input['flag'];
                            $dataUpload->peserta            = $input['peserta'];

                            $dataUpload->save();
                        }
                    }
                });
            });

            \Session::flash('success', trans('backend/pertanggungjawaban.nominatif.store.messages.success'));

            return redirect()->back()->withInput();
        }
        \Session::flash('info', trans('backend/pertanggungjawaban.nominatif.store.messages.success'));

        return redirect()->back();
    }

    public function destroy_nominatif($id)
    {
        Nominatif::where('id', $id)->first();

        if (is_null($id)) {
            \Session::flash('info', trans('backend/pertanggungjawaban.nominatif.destroy.messages.info'));

            return redirect()->back();
        }

        Nominatif::destroy($id);
        \Session::flash('success', trans('backend/pertanggungjawaban.nominatif.destroy.messages.success'));

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $input = $request->all();
        if (is_null($input['kegiatan_id'])) {
            \Session::flash('info', trans('backend/pertanggungjawaban.nominatif.destroy.messages.info'));

            return redirect()->back();
        }

       Nominatif::where('kegiatan_id', '=', $input['kegiatan_id'])
                            ->where('flag', '=', $input['flag'])
                            ->where('peserta', '=', $input['peserta'])
                            ->delete();
        \Session::flash('success', trans('backend/pertanggungjawaban.nominatif.destroy.messages.success'));

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimpjbendahara(Request $request, $id)
    {
        if ($request->keterangan == 'PJ31') {
            $KG11 = Status::where('kode_status', '=', 'KG11')->first();
            Kegiatan::where('id', $id)
                ->update([
                    'status_id' => $KG11->id,
                    'alasan'    => $request->input('alasan')
                ]);

            \Session::flash('success', trans('backend/pengajuan.kegiatan.berkas.messages.info'));
            return redirect()->route('pertanggungjawaban.kegiatan.index');
        } else {
            $KG12 = Status::where('kode_status', '=', 'KG12')->first();
            Kegiatan::where('id', $id)
                ->update([
                    'status_id' => $KG12->id,
                ]);

            \Session::flash('success', trans('backend/pengajuan.kegiatan.berkas.messages.success'));
            return redirect()->route('pertanggungjawaban.kegiatan.index');
        }
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
        $KG11 = Status::where('kode_status', '=', 'KG11')->first();
        $KG12 = Status::where('kode_status', '=', 'KG12')->first();

        if (\Auth::user()->hasRole('user')) {
            $kegiatans = Kegiatan::orderBy('kegiatan.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
                ->join('status', 'status.id', '=', 'kegiatan.status_id')
                ->where('bagian_id', \Auth::user()->bagian_id)
                ->whereIn('kegiatan.status_id', [$KG06->id, $KG08->id, $KG11->id, $KG12->id, $KG09->id])
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $kegiatans = Kegiatan::orderBy('kegiatan.created_at', 'asc')
                ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
                ->join('status', 'status.id', '=', 'kegiatan.status_id')
                ->whereIn('kegiatan/status_id', [$KG06->id, $KG08->id, $KG12->id, $KG09->id])
                ->where($request->options,'like', '%' . $request->search . '%')
                ->paginate(10);
        }

        return view('backend.pertanggungjawaban.kegiatan.index', ['kegiatans' => $kegiatans]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function selesai($id)
    {
        $detailkegiatan = DetailKegiatan::where('kegiatan_id', $id)->get();
        foreach ($detailkegiatan as $key => $value) {
            Transaksi::where('id_t', $id)
                ->where('no_mak_sys', $value->rincian_akun)
                ->where('keterangan', 'Kegiatan')
                ->update([
                    'status' => 'RL03',
                    'jumlah' => $value->pj_jml_rph
                ]);
        }

        $KG13 = Status::where('kode_status', '=', 'KG13')->first();
        Kegiatan::where('id', $id)
            ->update([
                'status_id' => $KG13->id,
            ]);

        DetailKegiatan::where('kegiatan_id', $id)
            ->update([
                'status_id' => $KG13->id,
            ]);

        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $KG13 = Status::where('kode_status', '=', 'KG13')->first();
        app('App\Http\Controllers\Backend\Pengajuan\KegiatanController')->hitungRealisasi($KG06->id , 'realisasi_2' , 'vol_2' , 'jml_rph');
        app('App\Http\Controllers\Backend\Pengajuan\KegiatanController')->hitungRealisasi($KG13->id , 'realisasi_3' , 'vol_3' , 'pj_jml_rph');

        \Session::flash('success', trans('backend/pengajuan.kegiatan.selesai.messages.success'));
        return redirect()->route('pertanggungjawaban.kegiatan.index');
    }
}