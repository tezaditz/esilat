<?php

namespace App\Http\Controllers\Backend\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\Backend\Nominatif\Nominatif;
use App\Models\Backend\Pengajuan\Kegiatan;
use App\Models\Backend\Master\Pejabat;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PDF;

class NominatifController extends Controller
{
    /**
     * @param $kegiatan_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($kegiatan_id)
    {
        $nominatifs = nominatif::where('kegiatan_id', $kegiatan_id)
            ->where('flag', '=', 1)
            ->where('peserta', '=', 1)
            ->paginate(250);
        $nominatif_daerahs = nominatif::where('kegiatan_id', '=' , $kegiatan_id)
            ->where('flag' , '=' , 1)
            ->where('peserta' , '=' , 2)
            ->paginate(250);

        $nominatif_fullday_pusats = Nominatif::where('kegiatan_id', '=' , $kegiatan_id)
            ->where('flag' , '=' , 2)
            ->where('peserta' , '=' , 1)
            ->paginate(250);

        $nominatif_fullday_lokals = nominatif::where('kegiatan_id', '=', $kegiatan_id)
            ->where('flag' , '=' , 2)
            ->where('peserta' , '=' , 2)
            ->paginate(250);

//        $nominatif_perjadins = Nominatif::where('kegiatan_id', '=', $kegiatan_id)
//            ->where('flag' , '=' , 3)
//            ->where('peserta' , '=' , 1)
//            ->paginate(250);

        return view('backend.pengajuan.kegiatan.nominatif.index', [
            'nominatifs'               => $nominatifs,
            'nominatif_daerahs'        => $nominatif_daerahs,
            'nominatif_fullday_pusats' => $nominatif_fullday_pusats,
            'nominatif_fullday_lokals' => $nominatif_fullday_lokals,
            'kegiatan_id'              => $kegiatan_id
        ]);
    }

    public function downloadNominatifFullday($kegiatan_id)
    {
        $kegiatan = Kegiatan::find($kegiatan_id);

        Excel::create($kegiatan->nama_kegiatan, function ($excel) use ($kegiatan) {
            $excel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Doni Setiawan")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");
            $excel->sheet('sheet_1', function ($sheet) use ($kegiatan) {
                $sheet->mergeCells('A1:I1');
                $sheet->mergeCells('A2:I2');
                $sheet->mergeCells('A3:I3');
                $sheet->mergeCells('A4:I4');

                $sheet->cells('A1:A4', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                });
                $sheet->setCellValue('A1', 'DAFTAR NOMINATIF');
                $sheet->setCellValue('A2', 'PEGAWAI YANG MELAKUKAN KEGIATAN');
                $sheet->setCellValue('A3', $kegiatan->nama_kegiatan);
                $sheet->setCellValue('A4', ($kegiatan->provinsi->title . ', ' . date('d', strtotime($kegiatan->tgl_awal)) . ' s.d ' . date('d M Y', strtotime($kegiatan->tgl_akhir))));

                $sheet->mergeCells('A6:A7');
                $sheet->mergeCells('B6:B7');
                $sheet->mergeCells('C6:C7');
                $sheet->mergeCells('D6:D7');
                $sheet->mergeCells('E6:E7');
                $sheet->mergeCells('F6:F7');
                $sheet->mergeCells('G6:G7');
                $sheet->mergeCells('H6:H7');
                $sheet->mergeCells('I6:I7');
                $sheet->cells('A6:I6', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setBackground('#cccfd4');
                });
                $sheet->setCellValue('A6', 'No');
                $sheet->setCellValue('B6', 'NAMA');
                $sheet->setCellValue('C6', 'NIP');
                $sheet->setCellValue('D6', 'UNIT KERJA');
                $sheet->setCellValue('E6', 'GOL');
                $sheet->setCellValue('F6', 'HARI');
                $sheet->setCellValue('G6', 'Transport');
                $sheet->setCellValue('H6', 'Uang Saku');
                $sheet->setCellValue('I6', 'Jumlah');
                $sheet->setCellValue('I8', '=F8*(G8+H8)');

                $sheet->setSize(array(
                    'A6' => array(
                        'width' => 5,
                    ),
                    'B6' => array(
                        'width' => 25,
                    ),
                    'C6' => array(
                        'width' => 25,
                    ),
                    'D6' => array(
                        'width' => 20
                    ),
                    'G6' => array(
                        'width' => 15
                    ),
                    'H6' => array(
                        'width' => 15
                    ),
                    'I6' => array(
                        'width' => 15
                    )
                ));
            });
        })->download('xls');
    }

    public function downloadNominatifFullboard($kegiatan_id)
    {
        $kegiatan = Kegiatan::find($kegiatan_id);

        Excel::create($kegiatan->nama_kegiatan, function ($excel) use ($kegiatan) {
            $excel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Doni Setiawan")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");
            $excel->sheet('sheet_1', function ($sheet) use ($kegiatan) {
                $sheet->mergeCells('A1:O1');
                $sheet->mergeCells('A2:O2');
                $sheet->mergeCells('A3:O3');
                $sheet->mergeCells('A4:O4');

                $sheet->cells('A1:A4', function ($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                });
                $sheet->setCellValue('A1', 'DAFTAR NOMINATIF');
                $sheet->setCellValue('A2', 'PEGAWAI YANG MELAKUKAN KEGIATAN');
                $sheet->setCellValue('A3', $kegiatan->nama_kegiatan);
                $sheet->setCellValue('A4', ($kegiatan->provinsi->title . ', ' . date('d', strtotime($kegiatan->tgl_awal)) . ' s.d ' . date('d M Y', strtotime($kegiatan->tgl_akhir))));

                $sheet->mergeCells('A6:A7');
                $sheet->mergeCells('B6:B7');
                $sheet->mergeCells('C6:C7');
                $sheet->mergeCells('D6:D7');
                $sheet->mergeCells('E6:E7');
                $sheet->mergeCells('F6:G6');
                $sheet->mergeCells('H6:I6');
                $sheet->mergeCells('J6:J7');
                $sheet->mergeCells('K6:L6');
                $sheet->mergeCells('M6:N7');
                $sheet->mergeCells('O6:O7');

                $sheet->cells('A6:O7', function ($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setBackground('#cccfd4');
                });
                $sheet->setCellValue('A6', 'No');
                $sheet->setCellValue('B6', 'NAMA');
                $sheet->setCellValue('C6', 'NIP');
                $sheet->setCellValue('D6', 'UNIT KERJA');
                $sheet->setCellValue('E6', 'GOL');
                $sheet->setCellValue('F6', 'Tujuan Perjalanan');
                $sheet->setCellValue('F7', 'Dari');
                $sheet->setCellValue('F7', 'dari');
                $sheet->setCellValue('G7', 'ke');
                $sheet->setCellValue('H6', 'Tanggal SPD');
                $sheet->setCellValue('H7', 'Berangkat');
                $sheet->setCellValue('I7', 'Pulang');
                $sheet->setCellValue('J6', 'HARI');
                $sheet->setCellValue('K6', 'Transport');
                $sheet->setCellValue('K7', 'Pesawat');
                $sheet->setCellValue('L7', 'Taksi (pp)');
                $sheet->setCellValue('M6', 'Uang Saku');
                $sheet->setCellValue('O6', 'Jumlah');

                $sheet->setCellValue('J8', '=IF(AND(I8<>"",H8<>""),I8-H8+1,"")');
                $sheet->setCellValue('N8', '=IF(J8<>"",M8*J8,"")');
                $sheet->setCellValue('O8', '=IF(OR(J8<>"",K8<>"",L8<>"",N8<>""),K8+L8+N8,0)');

                $sheet->setSize(array(
                    'A6' => array(
                        'width' => 5,
                    ),
                    'B6' => array(
                        'width' => 25,
                    ),
                    'C6' => array(
                        'width' => 25,
                    ),
                    'D6' => array(
                        'width' => 20
                    ),
                    'F8' => array(
                        'width' => 13
                    ),
                    'G8' => array(
                        'width' => 13
                    ),
                    'H8' => array(
                        'width' => 13
                    ),
                    'I8' => array(
                        'width' => 13
                    )
                ));
            });
        })->download('xls');
    }

    public function importPerjadin($kegiatan_id)
    {
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            Excel::load($path, function ($reader) {
                $reader->noHeading();
                $reader->skipRows(7);
                $reader->each(function ($sheet) {
                    $x = 0;
                    $kegiatan_id = Request::segment(5);
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
                            $dataUpload->daerah_asal        = $row[5]; // tujuan => dari
                            $dataUpload->prov_daerah_tujuan = $row[6]; // tujuan => ke
                            $dataUpload->tgl_berangkat      = $row[7]; // tanggal spd
                            $dataUpload->tgl_kembali        = $row[8]; // tanggal spd
                            $dataUpload->lama               = $row[9]; // hari
                            $dataUpload->tiket_pesawat      = $row[10]; // transport => pesawat
                            $dataUpload->transport          = $row[11]; // transport => taksi
                            $dataUpload->uang_harian        = $row[13]; // uangsaku = > nilai satuan * lama
                            $dataUpload->penginapan         = $row[14]; // penginapan = > nilai satuan * lama
                            $dataUpload->flag               = 3;
                            $dataUpload->peserta            = 1;

                            $dataUpload->save();
                        }
                    }
                });
            });

            \Session::flash('success', trans('backend/nominatif.nominatif.store.messages.success'));

            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id)->withInput();
        }
        \Session::flash('info', trans('backend/nominatif.nominatif.store.messages.success'));

        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function importPusat(\Illuminate\Http\Request $request, $kegiatan_id)
    {
        if (Input::hasFile('import_file')) {
            Excel::selectSheetsByIndex(0)->load($request->import_file, function ($reader) use ($request) {
                $reader->noHeading();
                $reader->skipRows(7);

                $content = $reader->toArray();
                $rows    = collect($content);

                $x = 0;
                $kegiatan_id = Request::segment(5);
                $datakegiatan = Kegiatan::where('id' , '=' , $kegiatan_id)->get();

                $rows->each(function ($item) use ($x, $datakegiatan, $kegiatan_id, $request) {
                    $x = $x + 1;

                    $dataUpload = new Nominatif();

                    $dataUpload->kegiatan_id        = $kegiatan_id;
                    $dataUpload->peserta_id         = $x; // NO
                    $dataUpload->nama_peserta       = $item[1]; // nama
                    $dataUpload->nip                = $item[2]; // nip
                    $dataUpload->instansi           = $item[3];  // instansi
                    $dataUpload->gol                = $item[4]; // gol
                    $dataUpload->daerah_asal        = 'DKI Jakarta'; // tujuan => dari
                    $dataUpload->prov_daerah_tujuan = 'DKI Jakarta'; // tujuan => ke
                    $dataUpload->tgl_berangkat      = $datakegiatan[0]['tgl_awal']; // tanggal spd
                    $dataUpload->tgl_kembali        = $datakegiatan[0]['tgl_akhir']; // tanggal spd
                    $dataUpload->lama               = $item[5]; // hari
                    $dataUpload->transport          = $item[6]; // transport => taksi
                    $dataUpload->uang_harian        = $item[7]; // uangsaku = > nilai satuan * lama
                    $dataUpload->flag               = 2;
//                        $dataUpload->akun               = '524111';
                    $dataUpload->peserta            = 1;

                    $dataUpload->save();
                });
            });

            \Session::flash('success', trans('backend/nominatif.nominatif.store.messages.success'));
            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id)->withInput();
        }
        \Session::flash('info', trans('backend/nominatif.nominatif.store.messages.success'));
        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function importLokal(\Illuminate\Http\Request $request, $kegiatan_id)
    {
        if (Input::hasFile('import_file')) {
            Excel::selectSheetsByIndex(0)->load($request->import_file, function ($reader) use ($request) {
                $reader->noHeading();
                $reader->skipRows(7);

                $content = $reader->toArray();
                $rows    = collect($content);

                $x            = 0;
                $kegiatan_id  = Request::segment(5);
                $datakegiatan = Kegiatan::where('id', '=', $kegiatan_id)->get();

                $rows->each(function ($item) use ($x, $datakegiatan, $kegiatan_id, $request) {
                    $x = $x + 1;

                    $dataUpload = new Nominatif();

                    $dataUpload->kegiatan_id        = $kegiatan_id;
                    $dataUpload->peserta_id         = $x; // NO
                    $dataUpload->nama_peserta       = $item[1]; // nama
                    $dataUpload->nip                = $item[2]; // nip
                    $dataUpload->instansi           = $item[3];  // instansi
                    $dataUpload->gol                = $item[4]; // gol
                    $dataUpload->daerah_asal        = 'DKI Jakarta'; // tujuan => dari
                    $dataUpload->prov_daerah_tujuan = 'DKI Jakarta'; // tujuan => ke
                    $dataUpload->tgl_berangkat      = $datakegiatan[0]['tgl_awal']; // tanggal spd
                    $dataUpload->tgl_kembali        = $datakegiatan[0]['tgl_akhir']; // tanggal spd
                    $dataUpload->lama               = $item[5]; // hari
                    $dataUpload->transport          = $item[6]; // transport => taksi
                    $dataUpload->uang_harian        = $item[7]; // uangsaku = > nilai satuan * lama
                    $dataUpload->flag               = 2;
//                        $dataUpload->akun               = '524111';
                    $dataUpload->peserta = 2;

                    $dataUpload->save();
                });
            });

            \Session::flash('success', trans('backend/nominatif.nominatif.store.messages.success'));
            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id)->withInput();
        }
        \Session::flash('info', trans('backend/nominatif.nominatif.store.messages.success'));
        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function importPusatfb(\Illuminate\Http\Request $request, $kegiatan_id)
    {
        if (Input::hasFile('import_file')) {
            Excel::selectSheetsByIndex(0)->load($request->import_file, function ($reader) use ($request) {
                $reader->noHeading();
                $reader->skipRows(7);

                $content = $reader->toArray();
                $rows    = collect($content);

                $x = 0;
                $kegiatan_id = Request::segment(5);
                $datakegiatan = Kegiatan::where('id' , '=' , $kegiatan_id)->get();

                $rows->each(function ($item) use ($x, $datakegiatan, $kegiatan_id, $request) {
                    $x = $x + 1;

                    $dataUpload = new Nominatif();

                    $dataUpload->kegiatan_id        = $kegiatan_id;
                    $dataUpload->peserta_id         = $x; // NO
                    $dataUpload->nama_peserta       = $item[1]; // nama
                    $dataUpload->nip                = $item[2]; // nip
                    $dataUpload->instansi           = $item[3];  // instansi
                    $dataUpload->gol                = $item[4]; // gol
                    $dataUpload->daerah_asal        = $item[5]; // tujuan => dari
                    $dataUpload->prov_daerah_tujuan = $item[6]; // tujuan => ke
                    $dataUpload->tgl_berangkat      = $item[7]; // tanggal spd
                    $dataUpload->tgl_kembali        = $item[8]; // tanggal spd
                    $dataUpload->lama               = $item[9]; // hari
                    $dataUpload->tiket_pesawat      = $item[10]; // transport => pesawat
                    $dataUpload->transport          = $item[11]; // transport => taksi
                    $dataUpload->uang_harian        = $item[13]; // uangsaku = > nilai satuan * lama
                    $dataUpload->flag               = 1;
//                        $dataUpload->akun               = '524111';
                    $dataUpload->peserta            = 1;

                    $dataUpload->save();
                });
            });

            \Session::flash('success', trans('backend/nominatif.nominatif.store.messages.success'));
            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id)->withInput();
        }
        \Session::flash('info', trans('backend/nominatif.nominatif.store.messages.success'));
        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function importDaerahfb(\Illuminate\Http\Request $request, $kegiatan_id)
    {
        if (Input::hasFile('import_file')) {
            Excel::selectSheetsByIndex(0)->load($request->import_file, function ($reader) use ($request) {
                $reader->noHeading();
                $reader->skipRows(7);

                $content = $reader->toArray();
                $rows    = collect($content);

                $x = 0;
                $kegiatan_id = Request::segment(5);

                $rows->each(function ($item) use ($x, $kegiatan_id, $request) {
                    $x = $x + 1;

                    $dataUpload = new Nominatif();

                    $dataUpload->kegiatan_id        = $kegiatan_id;
                    $dataUpload->peserta_id         = $x; // NO
                    $dataUpload->nama_peserta       = $item[1]; // nama
                    $dataUpload->nip                = $item[2]; // nip
                    $dataUpload->instansi           = $item[3];  // instansi
                    $dataUpload->gol                = $item[4]; // gol
                    $dataUpload->daerah_asal        = $item[5]; // tujuan => dari
                    $dataUpload->prov_daerah_tujuan = $item[6]; // tujuan => ke
                    $dataUpload->tgl_berangkat      = $item[7]; // tanggal spd
                    $dataUpload->tgl_kembali        = $item[8]; // tanggal spd
                    $dataUpload->lama               = $item[9]; // hari
                    $dataUpload->tiket_pesawat      = $item[10]; // transport => pesawat
                    $dataUpload->transport          = $item[11]; // transport => taksi
                    $dataUpload->uang_harian        = $item[13]; // uangsaku = > nilai satuan * lama
                    $dataUpload->flag               = 1;
//                        $dataUpload->akun               = '524111';
                    $dataUpload->peserta            = 2;

                    $dataUpload->save();
                });
            });

            \Session::flash('success', trans('backend/nominatif.nominatif.store.messages.success'));
            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id)->withInput();
        }
        \Session::flash('info', trans('backend/nominatif.nominatif.store.messages.success'));
        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

//    public function destroy($id)
//    {
//        if (is_null($id)) {
//            \Session::flash('info', trans('backend/nominatif.nominatif.destroy.messages.info'));
//
//            return redirect()->route('nominatif.index');
//        }
//
//        Nominatif::destroy($id);
//        \Session::flash('success', trans('backend/nominatif.nominatif.destroy.messages.success'));
//
//        return redirect()->route('nominatif.index');
//    }

    public function destroy($id)
    {
        $nominatif = Nominatif::where('id', $id)->first();

        if (is_null($id)) {
            \Session::flash('info', trans('backend/nominatif.nominatif.destroy.messages.info'));

            return redirect()->route('pengajuan.kegiatan.nominatif.index', $nominatif->kegiatan_id);
        }

        Nominatif::destroy($id);
        \Session::flash('success', trans('backend/nominatif.nominatif.destroy.messages.success'));

        return redirect()->route('pengajuan.kegiatan.nominatif.index', $nominatif->kegiatan_id);
    }

//    public function deletePerjadin($kegiatan_id)
//    {
//        if (is_null($kegiatan_id)) {
//            \Session::flash('info', trans('backend/nominatif.nominatif.destroyPerjadin.messages.success'));
//            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
//        }
//
//        Nominatif::where('kegiatan_id', '=', $kegiatan_id)
//            ->where('flag', '=', 3)
//            ->delete();
//        \Session::flash('success', trans('backend/nominatif.nominatif.destroyPerjadin.messages.success'));
//
//        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
//    }

    public function fulldayLocal($kegiatan_id)
    {

        if (is_null($kegiatan_id)) {
            \Session::flash('info', trans('backend/nominatif.nominatif.destroyFdpesertalocal.messages.success'));

            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
        }

       Nominatif::where('kegiatan_id' , '=' , $kegiatan_id)
                            ->where('flag' , '=' , 2)
                            ->where('peserta' , '=' , 2)
                            ->delete();
        \Session::flash('success', trans('backend/nominatif.nominatif.destroyFdpesertalocal.messages.success'));

        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function fulldayPusat($kegiatan_id)
    {

        if (is_null($kegiatan_id)) {
            \Session::flash('info', trans('backend/nominatif.nominatif.destroyFdpesertapusat.messages.success'));

            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
        }

       Nominatif::where('kegiatan_id' , '=' , $kegiatan_id)
                            ->where('flag' , '=' , 2)
                            ->where('peserta' , '=' , 1)
                            ->delete();
        \Session::flash('success', trans('backend/nominatif.nominatif.destroyFdpesertapusat.messages.success'));

        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function nominatifDaerah($kegiatan_id)
    {

        if (is_null($kegiatan_id)) {
            \Session::flash('info', trans('backend/nominatif.nominatif.destroyFbpesertadaerah.messages.success'));

            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
        }

       Nominatif::where('kegiatan_id' , '=' , $kegiatan_id)
                            ->where('flag' , '=' , 1)
                            ->where('peserta' , '=' , 2)
                            ->delete();
        \Session::flash('success', trans('backend/nominatif.nominatif.destroyFbpesertadaerah.messages.success'));

        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function nominatifPusat($kegiatan_id)
    {

        if (is_null($kegiatan_id)) {
            \Session::flash('info', trans('backend/nominatif.nominatif.destroyFbpesertapusat.messages.success'));

            return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
        }

       Nominatif::where('kegiatan_id' , '=' , $kegiatan_id)
                            ->where('flag' , '=' , 1)
                            ->where('peserta' , '=' , 1)
                            ->delete();
        \Session::flash('success', trans('backend/nominatif.nominatif.destroyFbpesertapusat.messages.success'));

        return redirect()->route('pengajuan.kegiatan.nominatif.index', $kegiatan_id);
    }

    public function cetakRill($id)
    {
        $nominatif        = Nominatif::find($id);
        $tanggalprint     = $this->tanggalIndonesia(Carbon::Now());
        $pejabat          = Pejabat::where('id', 1)->first();

        $pdf = PDF::loadView('backend.pengajuan.kegiatan.laporan.kuitansirill', ['nominatif' => $nominatif, 'tanggalprint' => $tanggalprint, 'pejabat' => $pejabat]);

        return $pdf->stream('kuitansirill_'.Carbon::now()->format('d-m-Y').'.pdf');
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
