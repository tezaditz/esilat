<?php

namespace App\Http\Controllers\Backend\Pengajuan;

use App\Models\Backend\Master\Bagian;
use App\Models\Backend\Master\Hotel;
use App\Models\Backend\Master\MetodeBayar;
use App\Models\Backend\Master\NoPengajuan;
use App\Models\Backend\Master\Pejabat;
use App\Models\Backend\Master\Provinsi;
use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Master\Status;
use App\Models\Backend\Master\BagianEselon;
use App\Models\Backend\Parameter;
use App\Models\Backend\Pengajuan\Jadwal;
use App\Models\Backend\Pengajuan\Kegiatan;
use App\Models\Backend\Pengajuan\DetailKegiatan;
use App\Models\Backend\Pengajuan\PilihAkun;
use App\Models\Backend\Pengajuan\Transaksi;
use App\Models\Backend\Pengajuan\Realisasi;
use App\Models\Backend\Nominatif\Nominatif;
use App\Models\Backend\Pimpinan;
use App\Models\Backend\Rpk;
use App\Models\Backend\Rpd;
use App\Models\Backend\Rpdsummary\Rpdsummary;
use App\Models\Backend\Pengajuan\DetailAkun;
use PDF;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ang = parameter::where('id' , '=' , 1)->first();
        $KG00 = Status::where('kode_status', '=', 'KG00')->first();
        $KG01 = Status::where('kode_status', '=', 'KG01')->first();
        $KG04 = Status::where('kode_status', '=', 'KG04')->first();
        $KG05 = Status::where('kode_status', '=', 'KG05')->first();
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $KG14 = Status::where('kode_status', '=', 'KG14')->first();
        $KG15 = Status::where('kode_status', '=', 'KG15')->first();
        $KG99 = Status::where('kode_status', '=', 'KG99')->first();

        if (\Auth::user()->hasRole('user')) {
            $kegiatans = Kegiatan::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$KG00->id, $KG01->id, $KG04->id, $KG05->id, $KG14->id, $KG15->id, $KG99->id])
                ->where('bagian_id', \Auth::user()->bagian_id)
                ->where('tahun_anggaran' , $tahun_ang['value'])
                ->paginate(10);
        } elseif (\Auth::user()->hasRole('bendahara')) {
            $kegiatans = Kegiatan::orderBy('created_at', 'asc')
                ->whereIn('status_id', [$KG01->id, $KG04->id, $KG05->id, $KG14->id])
                ->where('tahun_anggaran' , $tahun_ang['value'])
                ->paginate(10);
        } else {
            $kegiatans = Kegiatan::orderBy('created_at', 'asc')
                ->where('tahun_anggaran' , $tahun_ang['value'])
                ->paginate(10);
        }
        $tahun_ang = parameter::where('id' , '=' , 1)->first();
        $bageselon = BagianEselon::where('bagian_id' , '=' , Auth::User()->bagian_id)->first();


        $rkakls  = DB::select("select * FROM rkakl WHERE no_mak_sys IN (SELECT SUBSTR(no_mak , 1 , 22) FROM rpd WHERE LEVEL = 7 and bagian_id = " . \Auth::user()->bagian_id . " GROUP BY SUBSTR(no_mak , 1 , 22)) and tahun = " . $tahun_ang['value'] . " and eselon_id = " . $bageselon['eselon_id'] . " ");
        
        // return $rkakls;

        // $rkakls    = Rkakl::where('level', '=', 6)
        //                     ->where('tahun' , '=' , $tahun_ang['value'])
        //                     ->where('eselon_id' , '=' , $bageselon['eselon_id'] )
        //                     ->where('bagian_id' , '=' , \Auth::user()->bagian_id )
        //                     ->get();

        

        $hotels    = Hotel::all();
        $provinsis = Provinsi::all();
        $bagian    = Bagian::find(\Auth::user()->bagian_id);

        return view('backend.pengajuan.kegiatan.index', ['kegiatans' => $kegiatans, 'rkakls' => $rkakls, 'hotels' => $hotels, 'provinsis' => $provinsis, 'bagian' => $bagian]);
    }

    /**
     * @param $judul
     * @return mixed
     */
    public function memuatMak($judul)
    {
        $tahun_ang = parameter::where('id' , '=' , 1)->first();
        $maks = \DB::table('rkakl')
            ->select('id', 'no_mak', 'uraian', \DB::raw('FORMAT(jumlah - realisasi, 0) as pegu'))
            ->where('no_mak', 'like', '%' . $judul . '%')
            ->where('tahun' , '=' , $tahun_ang['value'])
            ->where('bagian_id' , '=' , Auth::user()->bagian_id)
            ->where('level', '=', 7)->get();

        $data = [
            'maks_data' => $maks,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function memuatUraian($id)
    {
        $uraian = Rkakl::where('no_mak', '=', $id)->get();

        $data = [
            'uraian_data' => $uraian,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Kegiatan::rules());

        if($validator->fails())
        {
            return redirect()->route('pengajuan.kegiatan.index')->withErrors($validator)->withInput();
        }

        $bagian = Bagian::where('id', '=', $request->bagian_id)
            ->first();

        $status = Status::where('kode_status', '=', 'KG00')
            ->first();

        $check = NoPengajuan::where('bagian_id', '=', \Auth::user()->bagian_id)
            ->where('jenis', '=', 'Kegiatan')->first();

        //================================================================================================//
        //cek RPK
            $rpk = rpk::where('no_mak' , '=' , $request->no_mak)
                        ->where('tglFrom_update' , '=' , $request->tgl_awal)
                        ->where('tglTo_update' , '=' , $request->tgl_akhir )
                        ->get();
            

            // if($rpk->count() == 0)
            // {
            //     \Session::flash('error', trans('backend/monitoring/rpd.rpk_kegiatan.messages.is_empty'));
            //     return redirect()->route('pengajuan.kegiatan.index');
            // }
        //================================================================================================//


        if ($check === null) {
            $nopengajuan = new NoPengajuan();

            $nopengajuan->bagian_id      = \Auth::user()->bagian_id;
            $nopengajuan->nomor          = 0;
            $nopengajuan->jenis          = 'Kegiatan';
            $nopengajuan->kode_transaksi = '01';

            $nopengajuan->save();
        }

        $no_pengajuans = NoPengajuan::where('bagian_id', '=', $request->bagian_id)
            ->where('jenis', '=', 'Kegiatan')
            ->first();
        $no_pengajuan = $no_pengajuans->nomor;
        $no_pengajuan = $no_pengajuan + 1;

        $thn_anggaran = Parameter::where('name', '=', 'Tahun Anggaran')
            ->first();

        $metodebayar = MetodeBayar::where('kode', '=', 'MB00')
            ->first();

        $kegiatan = new Kegiatan();

        $kegiatan->bagian_id            = $request->bagian_id;
        $kegiatan->judul                = $request->judul;
        $kegiatan->no_mak               = $request->no_mak;
        $kegiatan->nama_kegiatan        = $request->nama_kegiatan;
        $kegiatan->hotel_id             = $request->hotel_id;
        $kegiatan->tgl_awal             = $request->tgl_awal;
        $kegiatan->tgl_akhir            = $request->tgl_akhir;
        $kegiatan->tgl_awal_update      = $request->tgl_awal;
        $kegiatan->tgl_akhir_update     = $request->tgl_akhir;
        $kegiatan->provinsi_id          = $request->provinsi_id;
        $kegiatan->status_id            = $status->id;
        $kegiatan->tgl_pengajuan        = Carbon::now();
        $kegiatan->tahun_anggaran       = $thn_anggaran->value;
        $kegiatan->no_pengajuan         = $no_pengajuan;
        $kegiatan->no_pengajuan2        = 'AJU-' . $no_pengajuan . '/' . $bagian->kode . '/' . date('Y');
        $kegiatan->metode_bayar_id      = $metodebayar->id;

        $kegiatan->save();

        NoPengajuan::where('bagian_id', $request->bagian_id)
            ->where('jenis', '=', 'Kegiatan')
            ->update([
                'nomor' => $no_pengajuan
            ]);

        \Session::flash('success', trans('backend/pengajuan.kegiatan.store.messages.success'));

        $kegiatan = Kegiatan::where('no_pengajuan', '=', $no_pengajuan)
            ->where('bagian_id', '=', $request->bagian_id)->first();

        return redirect()->route('pengajuan.kegiatan.detail-akun.list-akun', $kegiatan->id)->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), Kegiatan::rules());

        if($validator->fails())
        {
            return redirect()->route('pengajuan.kegiatan.index')->withErrors($validator)->withInput();
        }

        $kegiatan = Kegiatan::find($id);

        $kegiatan->hotel_id    = $request->hotel_id;
        $kegiatan->tgl_awal    = $request->tgl_awal;
        $kegiatan->tgl_akhir   = $request->tgl_akhir;
        $kegiatan->provinsi_id = $request->provinsi_id;

        $kegiatan->save();

        \Session::flash('success', trans('backend/pengajuan.kegiatan.update.messages.success'));

        return redirect()->route('pengajuan.kegiatan.detail-akun', $id)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/pengajuan.kegiatan.destroy.messages.info'));

            return redirect()->route('pengajuan.kegiatan.index');
        }

        $this->kembaliUang($id);

        Nominatif::where('kegiatan_id', $id)->delete();
        DetailAkun::where('kegiatan_id', $id)->delete();
        PilihAkun::where('kegiatan_id', $id)->delete();
        DetailKegiatan::where('kegiatan_id', $id)->delete();
        Kegiatan::where('id', $id)->delete();

        \Session::flash('success', trans('backend/pengajuan.kegiatan.destroy.messages.success'));

        return redirect()->route('pengajuan.kegiatan.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $kegiatans = Kegiatan::orderBy('kegiatan.created_at', 'asc')
            ->join('bagian', 'bagian.id', '=', 'kegiatan.bagian_id')
            ->join('status', 'status.id', '=', 'kegiatan.status_id')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);
        $rkakls    = Rkakl::where('level', '=', 6)->get();
        $hotels    = Hotel::all();
        $provinsis = Provinsi::all();
        $bagian    = Bagian::find(\Auth::user()->bagian_id);

        return view('backend.pengajuan.kegiatan.index', ['kegiatans' => $kegiatans, 'rkakls' => $rkakls, 'hotels' => $hotels, 'provinsis' => $provinsis, 'bagian' => $bagian]);
    }

    public function draftKegiatan($id)
    {
        $kegiatan   = Kegiatan::where('id', $id)->first();
        $d_akuns    = DetailAkun::where('kegiatan_id', $id)->get();
        $nominatifs = Nominatif::where('kegiatan_id', $id)->get();

        $detailkegiatans = DetailKegiatan::where('kegiatan_id', $id)
            ->where('header', '=', '0')
            ->get();

        $pengajuan = DetailKegiatan::select(\DB::raw('sum(jml_rph) as jml_rph'))
            ->where('kegiatan_id', $id)
            ->where('header', '=', '0')->first();

        $jadwals = Jadwal::where('kegiatan_id', $id)
            ->where('keterangan', '=', 'kegiatan')
            ->get();

        $metodebayars = MetodeBayar::orderBy('created_at', 'desc')->get();
        $statuss      = Status::where('modul', 'FORMKG01')->get();

        $KG05 = status::where('kode_status' , '=' , 'KG05')->first();

        $UP = DetailAkun::where('kegiatan_id' , '=' , $id)
                            ->where('metode_bayar_id' , '=', 2)
                            ->where('status_id' , '=' , $KG05->id)->get();

        $LS = DetailAkun::where('kegiatan_id' , '=' , $id)
                            ->where('metode_bayar_id' , '=', 1)
                            ->where('status_id' , '=' , $KG05->id)->get();

        



        return view('backend.pengajuan.kegiatan.detailkegiatan.index', [
            'kegiatan'        => $kegiatan,
            'd_akuns'         => $d_akuns,
            'nominatifs'      => $nominatifs,
            'detailkegiatans' => $detailkegiatans,
            'pengajuan'       => $pengajuan,
            'jadwals'         => $jadwals,
            'metodebayars'    => $metodebayars,
            'statuss'         => $statuss,
            'id'              => $id,
            'totalUP'         => $UP->count(),
            'totalLS'         => $LS->count(),
        ]);
    }

    public function kirimKegiatan($id)
    {
        $status_id = Status::where('kode_status', 'KG01')->first();

        Kegiatan::where('id', '=', $id)
            ->update([
                'status_id'      => $status_id->id,
                'flag_pengajuan' => 1
            ]);

        $kegiatan = Kegiatan::where('id', $id)->first();

        $detail = DetailKegiatan::where('kegiatan_id', '=', $id)->get();

        $total = 0;
        foreach ($detail as $key => $value) {
            $rkakl = Rkakl::where('no_mak_sys', $value->rincian_akun)->first();

            // return $rkakl;

            $sisapagu = $rkakl->jumlah - ($rkakl->realisasi + $rkakl->realisasi_2 + $rkakl->realisasi_3);

            DetailKegiatan::where('id', '=', $value->id)
                ->update(['sisa_pagu' => $sisapagu]);

            $total = $total + $value->jml_rph;

            $transaksi = new Transaksi();

            $transaksi->id_t        = $value->kegiatan_id;
            $transaksi->no_mak_sys  = $value->rincian_akun;
            $transaksi->jumlah      = $value->jml_rph;
            $transaksi->kode_9      = $value->kode_9;
            $transaksi->kode_4      = $value->kode_4;
            $transaksi->kode_8      = $value->kode_8;
            $transaksi->kode_6      = $value->kode_6;
            $transaksi->kode_7      = $value->kode_7;
            $transaksi->kode_11     = $value->kode_11;
            $transaksi->kode_0      = $value->kode_0;
            $transaksi->status      = 'RL01';
            $transaksi->keterangan  = 'Kegiatan';
            $transaksi->tanggal     = $kegiatan->tgl_pengajuan;


            // return $value->rincian_akun;
            $transaksi->save();

            $rkakl = Rkakl::where('no_mak_sys', '=', $value->rincian_akun)->get();

            // return $rkakl;
            // return $total;
            if($rkakl[0]['realisasi'] == 0)
            {
                // return $value->rincian_akun;
                $update_rkakl = rkakl::where('no_mak_sys' ,$value->rincian_akun)
                                    ->update(['realisasi' => $total]);
            }
            else
            {

                $getNilai = $rkakl[0]['realisasi'] + $total;
                $update_rkakl = rkakl::where('id' , $rkakl[0]['id'])->update(['realisasi' => $getNilai]);   
            }
            
        }

        Kegiatan::where('id', $id)
            ->update(['total_realisasi' => $total]);

        $status_id = Status::where('kode_status', 'DT01')->first();
        // $this->hitungRealisasi($status_id->id, 'realisasi', 'vol_pengajuan', 'jml_rph');

        $kegiatan     = Kegiatan::where('id', '=', $id)->first();
        $tglPengajuan = Carbon::parse($kegiatan->tgl_pengajuan);

        $detailAkun = DetailAkun::where('kegiatan_id', '=', $id)->get();

        $totalPengajuan = 0;
        foreach ($detailAkun as $key => $value) {
            $totalPengajuan = $totalPengajuan + $value->jumlah;
        }

        $rkakl = Rkakl::where('level', '=', 4)->first();
        $pagu  = $rkakl->jumlah;

        $percent = ($totalPengajuan / $pagu) * 100;

        $bulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des' ];

        $realisasi = Realisasi::where('bulan', '=', $bulan[$tglPengajuan->month])->first();
        $nilaiRealisasi = $realisasi->nilai_pengajuan;

        Realisasi::where('bulan', '=', $bulan[$tglPengajuan->month])
            ->update([
                'nilai_pengajuan' => $totalPengajuan + $nilaiRealisasi
            ]);

        $CurrentPercent = Rpdsummary::where('bulan', '=', $bulan[$tglPengajuan->month])->first();
        $CPercent = $CurrentPercent->realisasi;

        Rpdsummary::where('bulan', '=', $bulan[$tglPengajuan->month])
            ->update([
                'realisasi' => $CPercent + $percent
            ]);

        \Session::flash('success', trans('backend/pengajuan.kegiatan.sent.messages.success'));
        return redirect()->route('pengajuan.kegiatan.index');
    }

    public function hitungRealisasi($status, $field, $volume, $nilaiRph)
    {
        $status_id = Status::where('id', $status)->first();

        Rkakl::where('id', '!=', 0)
            ->update([
                $field  => 0,
                $volume => 0
            ]);

        $detail = DetailKegiatan::groupby('kode_9', 'kode_8', 'kode_6', 'kode_7', 'kode_11', 'kode_0', 'status_id')
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, kode_11, kode_0, sum(' . $nilaiRph .') as nilai, sum(vol1*vol2) as volum')
            ->where('status_id', '=', $status_id->id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8 .".". $value->kode_6 .".". $value->kode_7 .".". $value->kode_11 ."." . $value->kode_0;

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field  => $value->nilai,
                    $volume => $value->volum
                ]);
        }

        //11
        $detail = DetailKegiatan::groupby('kode_9', 'kode_8', 'kode_6', 'kode_7', 'kode_11')
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, kode_11, sum(' . $nilaiRph .') as nilai, sum(vol1*vol2) as vol')
            ->where('status_id', '=', $status_id->id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8 .".". $value->kode_6 .".". $value->kode_7 .".". $value->kode_11;

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value->nilai
                ]);
        }

        // UPDATE LEVEL 7
        $detail = DetailKegiatan::groupby( 'kode_9', 'kode_8', 'kode_6', 'kode_7' )
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, sum(' . $nilaiRph .') as nilai, sum(vol1*vol2) as vol')
            ->where('status_id', '=', $status_id->id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8 .".". $value->kode_6 .".". $value->kode_7;

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value->nilai,
                ]);
        }

        // update level 6
        $detail = DetailKegiatan::groupby('kode_9', 'kode_8', 'kode_6')
            ->selectRaw('kode_9, kode_8, kode_6, sum(' . $nilaiRph .') as nilai, sum(vol1*vol2) as vol')
            ->where('status_id', '=', $status_id->id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8 .".". $value->kode_6;

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value->nilai,
                ]);
        }

        // update level 8
        $detail = DetailKegiatan::groupby('kode_9', 'kode_8')
            ->selectRaw('kode_9, kode_8, sum(' . $nilaiRph .') as nilai, sum(vol1*vol2) as vol')
            ->where('status_id', '=', $status_id->id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8;

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value->nilai,
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_4')
            ->selectRaw('kode_4, kode_9, sum(' . $nilaiRph .') as nilai, sum(vol1*vol2) as vol')
            ->where('status_id', '=', $status_id->id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_4 ;

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    $field => $value->nilai,
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_9')
            ->selectRaw('kode_9, sum(' . $nilaiRph .') as nilai, sum(vol1*vol2) as vol')
            ->where('status_id', '=', $status_id->id)
            ->get();

        $eselon_id = BagianEselon::where('bagian_id','=', Auth::user()->bagian_id)->first();
        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 ;

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->where('eselon_id', '=', $eselon_id['eselon_id'])
                ->update([
                    $field => $value->nilai,
                ]);
        }
    }

    public function kembaliUang($id)
    {
        $detail = DetailKegiatan::where('kegiatan_id', '=', $id)->get();
        foreach ($detail as $key => $value) {
            $rkakl = Rkakl::where('no_mak_sys', '=', $value->rincian_akun)->first();

            Rkakl::where('no_mak_sys', '=', $value->rincian_akun)
                ->update([
                    'realisasi'     => $rkakl->realisasi - $value->jml_rph,
                    'vol_pengajuan' => $rkakl->vol_pengajuan - ($value->vol1 * $value->vol2)
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_9', 'kode_8', 'kode_6', 'kode_7', 'kode_11')
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, kode_11, sum(jml_rph) as nilai, sum(vol1*vol2) as vol')
            ->where('kegiatan_id', '=', $id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8 .".". $value->kode_6 .".". $value->kode_7 .".". $value->kode_11;

            $rkakl = Rkakl::where('no_mak_sys', '=', $no_mak)->first();

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    'realisasi' => $rkakl->realisasi - $value->nilai
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_9', 'kode_8', 'kode_6', 'kode_7' )
            ->selectRaw('kode_9, kode_8, kode_6, kode_7, sum(jml_rph) as nilai, sum(vol1*vol2) as vol')
            ->where('kegiatan_id', '=', $id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8 .".". $value->kode_6 .".". $value->kode_7;

            $rkakl = Rkakl::where('no_mak_sys', '=', $no_mak)->first();

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    'realisasi' => $rkakl->realisasi - $value->nilai
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_9', 'kode_8', 'kode_6')
            ->selectRaw('kode_9, kode_8, kode_6, sum(jml_rph) as nilai, sum(vol1*vol2) as vol')
            ->where('kegiatan_id', '=', $id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8 .".". $value->kode_6;

            $rkakl = Rkakl::where('no_mak_sys', '=', $no_mak)->first();
            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    'realisasi' => $rkakl->realisasi - $value->nilai
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_9', 'kode_8' )
            ->selectRaw('kode_9, kode_8, sum(jml_rph) as nilai, sum(vol1*vol2) as vol')
            ->where('kegiatan_id', '=', $id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .".". $value->kode_8;

            $rkakl = Rkakl::where('no_mak_sys', '=', $no_mak)->first();

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    'realisasi' => $rkakl->realisasi - $value->nilai
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_9')
            ->selectRaw('kode_9, sum(jml_rph) as nilai, sum(vol1*vol2) as vol')
            ->where('kegiatan_id', '=', $id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9;

            $rkakl = Rkakl::where('no_mak_sys', '=', $no_mak)->first();

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    'realisasi' => $rkakl->realisasi - $value->nilai
                ]);
        }

        $detail = DetailKegiatan::groupby('kode_4')
            ->selectRaw('kode_4, kode_9, sum(jml_rph) as nilai, sum(vol1*vol2) as vol')
            ->where('kegiatan_id', '=', $id)
            ->get();

        foreach ($detail as $key => $value) {
            $no_mak = $value->kode_9 .'.'. $value->kode_4;

            $rkakl = Rkakl::where('no_mak_sys', '=', $no_mak)->first();

            Rkakl::where('no_mak_sys', '=', $no_mak)
                ->update([
                    'realisasi' => $rkakl->realisasi - $value->nilai
                ]);
        }
    }

    public function simpanBendahara(Request $request)
    {
        $metode =  Collect($request->input('metode_bayar_id'));
        $status = Collect($request->input('status_id'));

        foreach ($metode as $key => $value) {
            if($metode[$key] == 5)
            {
                \Session::flash('error', trans('backend/pengajuan.kegiatan.sent.messages.error.metode'));
                return redirect()->route('pengajuan.kegiatan.draft-kegiatan', $request->id);
            }
        }

        //========== UPDATE TABLE Detail_Akun ======================

        foreach ($metode as $key => $value) {
            DetailAkun::where('id' , '=' , $key)
                        ->update([
                            'metode_bayar_id' => $value,
                            'status_id' => $status[$key],
                        ]);
        }
        //==========================================================

        //====  Update Detail Kegiatan  ===
        $DetailAkun = DetailAkun::where('kegiatan_id' , '=' , $request->id)->get();
        foreach ($DetailAkun as $key => $value) {
            DetailKegiatan::where('kegiatan_id' , '=' , $request->id)
                            ->where('akun' , '=' , $value->akun)
                            ->update([
                                'status_id' => $value->status_id,
                                'metode_bayar_id' => $value->metode_bayar_id,
                            ]);
        }
        
       


        if ($request->keterangan == 'PG09') {
            $KG99 = Status::where('kode_status', '=', 'KG99')->first();
            Kegiatan::where('id', $request->id)
                ->update([
                    'status_id'  => $KG99->id,
                    'alasan'     => $request->alasan,
                ]);
        } else {


            $KG04 = Status::where('kode_status' , '=' , 'KG04')->first();
            $KG05 = Status::where('kode_status' , '=' , 'KG05')->first();
            $cekdata = DetailAkun::where('status_id' , '=' , $KG04->id )
                                    ->OrWhere('status_id' , '=' , $KG05->id)->get();

            
            if($cekdata->Count() >= 1)
            {

                $jmlKG04 = DetailAkun::where('status_id' , '=' , $KG04->id )->get();
                $jmlKG05 = DetailAkun::where('status_id' , '=' , $KG05->id )->get();

                if($jmlKG04 > $jmlKG05)
                {
                    $statusKeg = "KG04";
                }
                else
                {
                    $statusKeg = "KG05";
                }

                $KG = status::where('kode_status' , '=' , $statusKeg)->first();
                Kegiatan::where('id' , '=' , $request->id)
                        ->update([
                            'status_id' => $KG->id, 
                        ]);
            }
            else
            {
                $KG06 = Status::where('kode_status' , '=' , 'KG06')->first();
                Kegiatan::where('id' , '=' , $request->id)
                                ->update([
                                    'status_id' => $KG06->id,
                                ]);
            }

            // Kegiatan::where('id', $request->id)
            //     ->update([
            //         'status_id'       => $request->status_id,
            //         'metode_bayar_id' => $request->metode_bayar_id,
            //     ]);

            // DetailKegiatan::where('kegiatan_id', $request->id)
            //     ->update([
            //         'status_id' => $request->status_id,
            //     ]);

            // $this->hitungRealisasi($request->status_id, 'realisasi_2', 'vol_2', 'jml_rph');
        }

        \Session::flash('success', trans('backend/pengajuan.kegiatan.sent.messages.success'));
        return redirect()->route('pengajuan.kegiatan.index')->withInput();
    }

    public function sppdTerbit($id)
    {
        $KG15 = Status::where('kode_status', '=', 'KG15')->first();
        Kegiatan::where('id', $id)
            ->update([
                'status_id' => $KG15->id,
            ]);

        Transaksi::where('id_t', $id)
            ->where('keterangan', '=', 'keterangan')
            ->update([
                'status' => 'RL03'
            ]);

        app('App\Http\Controllers\Backend\Pengajuan\TransaksiController')->hitungTransaksi();

        \Session::flash('success', trans('backend/master/hotel.hotel.store.messages.success'));

        return redirect()->route('pengajuan.kegiatan.index')->withInput();
    }

    /**
     * @param $id
     * @return $this
     */
    public function terimaSppd($id)
    {
        $detail   = DetailKegiatan::where('kegiatan_id', $id)->get();
        $KG13     = Status::where('kode_status', '=', 'KG13')->first();
        $total_pj = 0;
        foreach ($detail as $key => $value) {
            DetailKegiatan::where('id', '=', $value->id)
                ->update([
                    'status_id'  => $KG13->id,
                    'pj_jml_rph' => $value->jml_rph,
                    'pj_vol1'    => $value->vol1,
                    'pj_vol2'    => $value->vol2,
                ]);
            $total_pj = $total_pj + $value->jml_rph;
        }

        Kegiatan::where('id', '=', $id)
            ->update([
                'status_id'       => $KG13->id,
                'total_realisasi' => $total_pj
            ]);

        \Session::flash('success', trans('backend/master/hotel.hotel.store.messages.success'));

        return redirect()->route('pengajuan.kegiatan.index')->withInput();
    }

    /**
     * @param $id
     * @return $this
     */
    public function persetujuanDirektur($id)
    {
        $KG02 = Status::where('kode_status', '=', 'KG02')->first();
        Kegiatan::where('id', '=', $id)
            ->update(
                array(
                    'status_id' => $KG02->id)
            );

        \Session::flash('success', trans('backend/master/hotel.hotel.store.messages.success'));

        return redirect()->route('pengajuan.kegiatan.index')->withInput();
    }

    /**
     * @param $id
     * @return $this
     */
    public function persetujuanPpk($id)
    {
        $KG03 = Status::where('kode_status', '=', 'KG03')->first();
        Kegiatan::where('id', '=', $id)
            ->update(
                array(
                    'status_id' => $KG03->id)
            );

        \Session::flash('success', trans('backend/master/hotel.hotel.store.messages.success'));

        return redirect()->route('pengajuan.kegiatan.index')->withInput();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function notaDinas($id)
    {
        $kegiatan = Kegiatan::find($id);

        $tanggalprint   = $this->tanggalIndonesia(Carbon::Now());
        $tanggalselesai = $this->tanggalIndonesia($kegiatan->tgl_akhir);

        $pimpinan = Pimpinan::where('bagian_id', \Auth::user()->bagian_id)->first();
        $pejabat  = Pejabat::where('jabatan', '=', 'Pejabat Pembuat Komitmen')->first();

        $detailkegiatans      = DetailKegiatan::where('kegiatan_id', $id)->get();
        $totaldetailkegiatans = DetailKegiatan::select(\DB::raw('sum(jml_rph) as jml_rph'))
            ->where('kegiatan_id', $id)
            ->where('header', '=', '0')->first();

        $rkakl = Rkakl::where('no_mak', $kegiatan->judul)->first();

        $pdf = PDF::loadView('backend.pengajuan.kegiatan.laporan.notadinas', [
            'kegiatan'             => $kegiatan,
            'tanggalprint'         => $tanggalprint,
            'tanggalselesai'       => $tanggalselesai,
            'pimpinan'             => $pimpinan,
            'pejabat'              => $pejabat,
            'detailkegiatans'      => $detailkegiatans,
            'totaldetailkegiatans' => $totaldetailkegiatans,
            'rkakl'                => $rkakl
        ]);

        return $pdf->stream('notadinas_'.Carbon::now()->format('d-m-Y').'.pdf');
    }

     public function surat_tugas($id)
    {
        $kegiatan = Kegiatan::find($id);

        $tanggalprint   = $this->tanggalIndonesia(Carbon::Now());
        $tanggalselesai = $this->tanggalIndonesia($kegiatan->tgl_akhir);

        $pimpinan = Pimpinan::where('bagian_id', \Auth::user()->bagian_id)->first();
        $pejabat  = Pejabat::where('jabatan', '=', 'Pejabat Pembuat Komitmen')->first();

        $detailkegiatans      = DetailKegiatan::where('kegiatan_id', $id)->get();
        $totaldetailkegiatans = DetailKegiatan::select(\DB::raw('sum(jml_rph) as jml_rph'))
            ->where('kegiatan_id', $id)
            ->where('header', '=', '0')->first();

        $rkakl = Rkakl::where('no_mak', $kegiatan->judul)->first();

        $pdf = PDF::loadView('backend.pengajuan.kegiatan.laporan.surattugas', [
            'kegiatan'             => $kegiatan,
            'tanggalprint'         => $tanggalprint,
            'tanggalselesai'       => $tanggalselesai,
            'pimpinan'             => $pimpinan,
            'pejabat'              => $pejabat,
            'detailkegiatans'      => $detailkegiatans,
            'totaldetailkegiatans' => $totaldetailkegiatans,
            'rkakl'                => $rkakl
        ]);

        return $pdf->stream('notadinas_'.Carbon::now()->format('d-m-Y').'.pdf');
    }

    /**
     * @param $tanggal
     * @return string
     */
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

    public function kuitansipembayaranlangsung($kegiatan_id)
    {
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();

        // Kegiatan::where('id', '=', $kegiatan_id)
        //     ->update([
        //         'status_id'      => $KG06->id,
        //         'flag_pengajuan' => 2
        //     ]);

        // DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)
        //                 ->update([
        //                     'status_id' => $KG06->id
        //                 ]);

        // Transaksi::where('id_t', '=', $kegiatan_id)
        //     ->where('keterangan', '=', 'Kegiatan')
        //     ->update(['status' => 'RL02']);

        $DT01 = Status::where('kode_status', '=', 'DT01')->first();
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $this->hitungrealisasi($DT01->id, 'realisasi', 'vol_pengajuan', 'jml_rph');
        $this->hitungrealisasi($KG06->id, 'realisasi_2', 'vol_2', 'jml_rph');

        $kegiatan       = Kegiatan::find($kegiatan_id);
        $detailkegiatan = DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)
                                        ->where('metode_bayar_id' , '=' , 1)->get();
        $tahun_ang      = Parameter::where('id', '=', 1)->first();
        // $namappk        = Parameter::where('id', '=', 3)->first();
        $datappk        = pejabat::where('jabatan', '=', 'Pejabat Pembuat Komitmen')->first();
        $databendahara  = pejabat::where('jabatan', '=', 'bendahara')->first();
        
        $pimpinan       = Pimpinan::where('bagian_id', \Auth::user()->bagian_id)->first();

        $bagian_eselon  = BagianEselon::where('bagian_id', \Auth::user()->bagian_id)->first();

        $total = 0;
        foreach ($detailkegiatan as $key => $value) {
            $total = $total + $value->jml_rph;
        }

        $text = $this->terbilang($total);

        $pdf = PDF::loadView('backend.pengajuan.kegiatan.laporan.kuitansipembayaranlangsung', ['kegiatan' => $kegiatan, 'detailkegiatan' => $detailkegiatan, 'pimpinan' => $pimpinan, 'tahun_ang' => $tahun_ang, 'total' => $text, 'namappk' => $datappk['nama'], 'nipppk' => $datappk['nip'], 'namabend' => $databendahara['nama'], 'nipbend' => $databendahara['nip'], 'bagian_eselon' => $bagian_eselon])->setPaper('legal' , 'potrait');

        return $pdf->stream('kuitansipembayaranlangsung_' . Carbon::now()->format('d-m-Y') . '.pdf');
    }

    public function kuitansipembayaranlangsungUP($kegiatan_id)
    {
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();

        // Kegiatan::where('id', '=', $kegiatan_id)
        //     ->update([
        //         'status_id'      => $KG06->id,
        //         'flag_pengajuan' => 2
        //     ]);

        // DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)
        //     ->update([
        //         'status_id' => $KG06->id
        //     ]);

        // Transaksi::where('id_t', '=', $kegiatan_id)
        //     ->where('keterangan', '=', 'Kegiatan')
        //     ->update(['status' => 'RL02']);

        $DT01 = Status::where('kode_status', '=', 'DT01')->first();
        $KG06 = Status::where('kode_status', '=', 'KG06')->first();
        $this->hitungrealisasi($DT01->id, 'realisasi', 'vol_pengajuan', 'jml_rph');
        $this->hitungrealisasi($KG06->id, 'realisasi_2', 'vol_2', 'jml_rph');

        $kegiatan       = Kegiatan::find($kegiatan_id);
        $detailkegiatan = DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)
                                        ->where('metode_bayar_id' , '=' , 2)->get();
        $tahun_ang      = Parameter::where('id', '=', 1)->first();
        // $namappk        = Parameter::where('id', '=', 3)->first();
        $datappk        = pejabat::where('jabatan', '=', 'Pejabat Pembuat Komitmen')->first();
        $databendahara  = pejabat::where('jabatan', '=', 'bendahara')->first();
        
        $pimpinan       = Pimpinan::where('bagian_id', \Auth::user()->bagian_id)->first();

        $bagian_eselon  = BagianEselon::where('bagian_id', \Auth::user()->bagian_id)->first();

        $total = 0;
        foreach ($detailkegiatan as $key => $value) {
            $total = $total + $value->jml_rph;
        }

        $text = $this->terbilang($total);

        $pdf = PDF::loadView('backend.pengajuan.kegiatan.laporan.kuitansipembayaranlangsungUP', ['kegiatan' => $kegiatan, 'detailkegiatan' => $detailkegiatan, 'pimpinan' => $pimpinan, 'tahun_ang' => $tahun_ang, 'total' => $text, 'namappk' => $datappk['nama'], 'nipppk' => $datappk['nip'], 'namabend' => $databendahara['nama'], 'nipbend' => $databendahara['nip'], 'bagian_eselon' => $bagian_eselon])->setPaper('legal' , 'potrait');

        return $pdf->stream('kuitansipembayaranlangsung_' . Carbon::now()->format('d-m-Y') . '.pdf');
    }

    public function terbilang($bilangan)
    {
         $bilangan = abs($bilangan);
         
         $angka = array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");
         $temp = "";
         
         if($bilangan < 12){
         $temp = " ".$angka[$bilangan];
         }else if($bilangan < 20){
         $temp = $this->terbilang($bilangan - 10)." belas";
         }else if($bilangan < 100){
         $temp = $this->terbilang($bilangan/10)." Puluh".$this->terbilang($bilangan%10);
         }else if ($bilangan < 200) {
         $temp = " Seratus".$this->terbilang($bilangan - 100);
         }else if ($bilangan < 1000) {
         $temp = $this->terbilang($bilangan/100). " Ratus". $this->terbilang($bilangan % 100);
         }else if ($bilangan < 2000) {
         $temp = " Seribu". $this->terbilang($bilangan - 1000);
         }else if ($bilangan < 1000000) {
         $temp = $this->terbilang($bilangan/1000)." ribu". $this->terbilang($bilangan % 1000);
         }else if ($bilangan < 1000000000) {
         $temp = $this->terbilang($bilangan/1000000)." juta". $this->terbilang($bilangan % 1000000);
         }
 
         return $temp ;
    }

    public function sptjb($kegiatan_id)
    {
        $kegiatan        = Kegiatan::find($kegiatan_id);
        $detailkegiatan  = DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)->first();
        $nominatif       = Nominatif::where('kegiatan_id', '=', $kegiatan_id)->get();
        $namappk         = Parameter::where('id', '=', 3)->first();
        $nipppk          = Parameter::where('id', '=', 4)->first();

        $pdf = PDF::loadView('backend.pengajuan.kegiatan.laporan.sptjb', ['kegiatan' => $kegiatan, 'detailkegiatan' => $detailkegiatan, 'nominatif' => $nominatif, 'namappk' => $namappk, 'nipppk' => $nipppk]);

        return $pdf->stream('sptjb_'.Carbon::now()->format('d-m-Y').'.pdf');

    }

    public function sptjb_hotel($kegiatan_id)
    {
        $kegiatan        = Kegiatan::find($kegiatan_id);
        $detailkegiatan  = DetailKegiatan::where('kegiatan_id', '=', $kegiatan_id)->get();
        $nominatif       = Nominatif::where('kegiatan_id', '=', $kegiatan_id)->get();
        $namappk         = Parameter::where('id', '=', 3)->first();
        $nipppk          = Parameter::where('id', '=', 4)->first();

        $pdf = PDF::loadView('backend.pengajuan.kegiatan.laporan.sptjb-hotel', ['kegiatan' => $kegiatan, 'detailkegiatan' => $detailkegiatan, 'nominatif' => $nominatif, 'namappk' => $namappk, 'nipppk' => $nipppk]);

        return $pdf->stream('sptjb-hotel_'.Carbon::now()->format('d-m-Y').'.pdf');

    }

    public function selesai_pengajuan($id)
    {
        $KG06 = status::where('kode_status' , '=' , 'KG06')->first();

        DetailKegiatan::where('kegiatan_id', '=', $id)
            ->update([
                'status_id' => $KG06->id
            ]);

        DetailAkun::where('kegiatan_id', '=', $id)
            ->update([
                'status_id' => $KG06->id
            ]);


        Kegiatan::where('id' , '=' , $id)
            ->update([
                'status_id'      => $KG06->id,
                'flag_pengajuan' => 2
            ]);

        Transaksi::where('id_t', '=', $id)
            ->where('keterangan', '=', 'Kegiatan')
            ->update(['status' => 'RL02']);

        \Session::flash('success', trans('backend/pengajuan.kegiatan.sent.messages.success'));
        return redirect()->route('pengajuan.kegiatan.index');


    }

}