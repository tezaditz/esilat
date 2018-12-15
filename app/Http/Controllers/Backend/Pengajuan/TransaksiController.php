<?php

namespace App\Http\Controllers\Backend\Pengajuan;

use App\Models\Backend\Master\Rkakl;
use App\Models\Backend\Pengajuan\Transaksi;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function hitungTransaksi()
    {
        $transaksi = Transaksi::groupBy('no_mak_sys', 'status')
            ->selectRaw('no_mak_sys , sum(jumlah) as nilai , status')
            ->get();
        foreach ($transaksi as $key => $value) {
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            Rkakl::where('no_mak_sys' , '=' , $value->no_mak_sys)
                ->update([
                    $field => $value->nilai
                ]);
        }

        $transaksi = Transaksi::groupby( 'kode_9' , 'kode_8' , 'kode_6' , 'kode_7' , 'kode_11' , 'status')
            ->selectRaw('kode_9 , kode_8 , kode_6 , kode_7 , kode_11 , sum(jumlah) as nilai , status')
            ->get();
        foreach ($transaksi as $key => $value) {
            $nomak = $value->kode_9 . '.' . $value->kode_8 . '.' . $value->kode_6 . '.' . $value->kode_7 . '.' . $value->kode_11;

            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            Rkakl::where('no_mak_sys' , '=' , $nomak)
                ->update([
                    $field => $value->nilai
                ]);
        }

        $transaksi = Transaksi::groupby( 'kode_9' , 'kode_8' , 'kode_6' , 'kode_7' , 'status')
            ->selectRaw('kode_9 , kode_8 , kode_6 , kode_7 , sum(jumlah) as nilai , status')
            ->get();
        foreach ($transaksi as $key => $value) {
            $nomak = $value->kode_9 . '.' . $value->kode_8 . '.' . $value->kode_6 . '.' . $value->kode_7;

            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            Rkakl::where('no_mak_sys' , '=' , $nomak)
                ->update([
                    $field => $value->nilai
                ]);
        }

        $transaksi = Transaksi::groupby( 'kode_9' , 'kode_8' , 'kode_6' , 'status')
            ->selectRaw('kode_9 , kode_8 , kode_6 , sum(jumlah) as nilai , status')
            ->get();
        foreach ($transaksi as $key => $value) {
            $nomak = $value->kode_9 . '.' . $value->kode_8 . '.' . $value->kode_6;
            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            Rkakl::where('no_mak_sys' , '=' , $nomak)
                ->update([
                    $field => $value->nilai
                ]);
        }

        $transaksi = Transaksi::groupby( 'kode_9' , 'kode_8'  , 'status')
            ->selectRaw('kode_9 , kode_8 ,  sum(jumlah) as nilai , status')
            ->get();
        foreach ($transaksi as $key => $value) {
            $nomak = $value->kode_9 . '.' . $value->kode_8 ;

            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            Rkakl::where('no_mak_sys' , '=' , $nomak)
                ->update([
                    $field => $value->nilai
                ]);
        }

        $transaksi = Transaksi::groupby( 'kode_9' , 'kode_4'  , 'status')
            ->selectRaw('kode_9 , kode_4 ,  sum(jumlah) as nilai , status')
            ->get();
        foreach ($transaksi as $key => $value) {
            $nomak = $value->kode_9 . '.' . $value->kode_4 ;

            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            Rkakl::where('no_mak_sys' , '=' , $nomak)
                ->update([
                    $field => $value->nilai
                ]);
        }

        $transaksi = Transaksi::groupby( 'kode_9'  , 'status')
            ->selectRaw('kode_9 ,  sum(jumlah) as nilai , status')
            ->get();
        foreach ($transaksi as $key => $value) {
            $nomak = $value->kode_9 ;

            switch ($value->status) {
                case 'RL01':
                    $field = 'realisasi';
                    break;
                case 'RL02':
                    $field = 'realisasi_2';
                    break;

                default:
                    $field = 'realisasi_3';
                    break;
            }

            Rkakl::where('no_mak_sys' , '=' , $nomak)
                ->update([
                    $field => $value->nilai
                ]);
        }
    }
}