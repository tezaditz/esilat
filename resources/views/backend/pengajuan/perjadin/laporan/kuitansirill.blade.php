<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<title>@yield('title') | {{ config('app.name</title>--}}
    {{--  <link rel="icon" type="image/png" href="public/img/logo-kemenkes.ico"/>--}}
    {{--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">--}}

    <link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css">

    <style>
        th, td, table, thead, tbody, tr {
            /*border: 1px solid #000;*/
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 14px;
            padding: 0px 2px;
        }
        td {
            vertical-align: top;
            
        }
        table.uraian, th.border, td.border {
            border: 1px solid #000;
            border-spacing: 0;
            font-size: 14px;
            padding: 0px 2px;
            
        }
        th.head {
            background-color: #efefef;
        }
    </style>
</head>
<body>
<table class="table" width="100%">
    <tr style="text-align: center"><th>DAFTAR PENGELUARAN RIIL</th></tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr><td>Yang bertanda tangan di bawah ini :</td></tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr>
        <td width="10px">Nama</td>
        <td width="5px">:</td>
        <td>{{ $dataperjadins->nama_pelaksana }}</td>
    </tr>
    <tr>
        <td>NIP</td>
        <td>:</td>
        <td>{{ $dataperjadins->nip }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>..................................................</td>
    </tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr><td>Berdasarkan Surat Perjalanan Dinas (SPD).</td></tr>
    <tr style="text-align: center"><td>&nbsp;</td></tr>
</table>
<table class="table" width="100%">
    <tr>
        <td width="10px">Nomor</td>
        <td width="5px">:</td>
        <td>.......................</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>{{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }}</td>
    </tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr>
        <td>Kami menyatakan dengan sesungguhnya bahwa :</td>
    </tr>
    <tr>
        <td style="text-align: justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Biaya transpor pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperolehbukti-bukti pengeluarannya, meliputi :
        </td>
    </tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table uraian" width="100%">
    <tr style="text-align: center">
        <th class="border head">Uraian</th>
        <th class="border head">Jumlah</th>
    </tr>
    <tr>
        <td class="border">Transport</td>
        <td class="border" style="text-align: right" width="150px">{{ number_format($dataperjadins->pj_taksi_provinsi + $dataperjadins->pj_taksi_kab_kota, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th class="border" style="text-align: right">Jumlah:</th>
        <th class="border" style="text-align: right">{{ number_format($dataperjadins->pj_taksi_provinsi + $dataperjadins->pj_taksi_kab_kota, 0, ',', '.') }}</th>
    </tr>
</table>
<table class="table" width="100%">
    <tr><th>&nbsp;</th></tr>
    <tr>
        <td>Kami menyatakan dengan sesungguhnya bahwa :</td>
    </tr>
    <tr>
        <td style="text-align: justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Jumlah uang tersebut pada angka 1 di atas benar-benar dikeluarkan untuk pelaksanaan perjalanan dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran,kami bersedia untuk menyetorkan Kembali kelebihan tersebut ke Kas Negara.
        </td>
    </tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr>
        <td style="text-align: justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.
        </td>
    </tr>
    <tr><th>&nbsp;</th></tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%" style="text-align: center">
    <tr>
        <td width="30%">Mengetahui/Menyetujui,</td>
        <td width="20%"></td>
        <td width="30%"></td>
    </tr>
    <tr>
        <td>{{ $ppk->jabatan }}</td>
        <td></td>
        <td>Pelaksana</td>
    </tr>
    <tr><th colspan="3">&nbsp;</th></tr>
    <tr><th colspan="3">&nbsp;</th></tr>
    <tr><th colspan="3">&nbsp;</th></tr>
    <tr><th colspan="3">&nbsp;</th></tr>
    <tr><th colspan="3">&nbsp;</th></tr>
    <tr>
        <td><u>{{ $ppk->nama }}</u></td>
        <td></td>
        <td><u>{{ $dataperjadins->nama_pelaksana }}</u></td>
    </tr>
    <tr>
        <td>NIP.{{ $ppk->nip }}</td>
        <td></td>
        <td>NIP.{{ $dataperjadins->nip }}</td>
    </tr>
</table>

<script src="public/jquery/dist/jquery.min.js"></script>
<script src="public/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>