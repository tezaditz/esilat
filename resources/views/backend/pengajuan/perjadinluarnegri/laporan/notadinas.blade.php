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
    <tr style="text-align: center"><th><u>NOTA DINAS</u></th></tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr><td style="text-align: right">{{ $tanggalprint }}</td></tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="690px">
    <tr>
        <td width="10px">No</td>
        <td width="5px">:</td>
        <td>AJU-{{ $perjadin->no_pengajuan }}/{{ $perjadin->bagian->kode }}/{{ $perjadin->thn_anggaran }}</td>
    </tr>
    <tr>
        <td>Lampiran</td>
        <td>:</td>
        <td>1 (satu) Berkas</td>
    </tr>
    <tr>
        <td>Hal</td>
        <td>:</td>
        <td>Permohonan Pelaksanaan Kegiatan <b>{{ $perjadin->nama_kegiatan }}</b></td>
    </tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr><td>Yang Terhormat</td></tr>
    <tr><td>Direktur Produksi dan Distribusi Kefarmasian</td></tr>
    <tr><td>di-</td></tr>
    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jakarta</td></tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr>
        <td style="text-align: justify">Sehubungan akan dilaksanakannya perjalanan dinas dalam rangka ( {{ $perjadin->nama_kegiatan }} ) ( MAK {{$perjadin->no_mak}} ) tanggal {{ date('d', strtotime($perjadin->tgl_awal)) }} s.d {{ date('d M Y', strtotime($perjadin->tgl_akhir)) }} , maka kami mengajukan rencana pembiayaan untuk kegiatan tersebut sebagai berikut:
        </td>
    </tr>
    <tr><th>&nbsp;</th></tr>
</table>

<table class="table" width="100%">
    <tr><td style="text-align: left">A. Permintaan Sekarang</td></tr>
    <tr><th>&nbsp;</th></tr>
</table>

<table class="table uraian" width="100%">
    <tr style="text-align: center">
        <th class="border head">Akun</th>
        <th class="border head">Rincian</th>
        <th class="border head">Sisa Pagu</th>
        <th class="border head">Jumlah Pernarikan</th>
    </tr>
      @foreach ($details as $key => $value)
    <tr>
        <td class="border">{{ $value->kode_11 }}</td>
        <td class="border">{{ $value->uraian }}</td>
        <td class="border" style="text-align: right">{{ number_format($value->sisa_pagu, 0, ',', '.') }}</td>
        <td class="border" style="text-align: right" width="150px">{{ number_format($value->jumlah_pengajuan, 0, ',', '.') }}</td>
    </tr>
      @endforeach
    <tr>
        <th class="border" style="text-align: right" colspan="2">Total:</th>
        <th class="border" style="text-align: right">{{ number_format($details->sum('sisa_pagu'), 0, ',', '.') }}</th>
        <th class="border" style="text-align: right">{{ number_format($details->sum('jumlah_pengajuan'), 0, ',', '.') }}</th>
    </tr>
</table>
<table class="table" width="100%">
    <tr><th>&nbsp;</th></tr>
    <tr><td style="text-align: left">B. Petugas yang ditunjuk untuk melaksanakan kegiatan terlampir.
</td></tr>
</table>
<table class="table" width="100%">
    <tr><td style="text-align: left">Demikian Permohonan ini kami sampaikan, atas perhatian ibu kami ucapkan termakasih
</td></tr>
    <tr><th>&nbsp;</th></tr>
</table>
<table class="table" width="100%">
    <tr>
      <td width="50%"></td>
      <td style="text-align: center"><b>Kepala Subbagian Tata Usaha</b></td>
    </tr>
    <tr><th colspan="2">&nbsp;</th></tr>
    <tr><th colspan="2">&nbsp;</th></tr>
    <tr><th colspan="2">&nbsp;</th></tr>
    <tr><th colspan="2">&nbsp;</th></tr>
    <tr><th colspan="2">&nbsp;</th></tr>
    <tr>
      <td></td>
      <td style="text-align: center"><b>{{ $pimpinan->nama }}</b></td>
    </tr>
    <tr>
      <td></td>
      <td style="text-align: center">NIP.{{ $pimpinan->nip }}</td>
    </tr>
</table>

<script src="public/jquery/dist/jquery.min.js"></script>
<script src="public/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>