@if($dataperjadins->count() == 2)
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s2f6{font-family:"Times New Roman", Times, serif !important;;text-align:center}
.tg .tg-gzo9{font-weight:bold;text-decoration:underline;font-size:16px;font-family:"Times New Roman", Times, serif !important;;text-align:center}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 122px">
<col style="width: 121px">
<col style="width: 121px">
<col style="width: 122px">
<col style="width: 122px">
<col style="width: 126px">
</colgroup>
  <tr>
    <th class="tg-s2f6"></th>
    <th class="tg-gzo9" colspan="4">TANDA TERIMA PENYERAHAN UANG MUKA PERJADIN</th>
    <th class="tg-031e"></th>
  </tr>
</table>

<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-x711{font-size:100%;font-family:"Times New Roman", Times, serif !important;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
.tg .tg-s2f6{font-family:"Times New Roman", Times, serif !important;;text-align:center}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 126px">
<col style="width: 124px">
<col style="width: 124px">
<col style="width: 125px">
<col style="width: 125px">
<col style="width: 129px">
</colgroup>
  <tr>
    <th class="tg-s2f6"></th>
    <th class="tg-x711"></th>
    <th class="tg-031e"></th>
    <th class="tg-qta8" colspan="3">TA : {{ $perjadin->thn_anggaran }}</th>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-smzr" colspan="3">MAK : {{ $perjadin->no_mak }}</td>
  </tr>
</table>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-x711{font-family:"Times New Roman", Times, serif !important;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 136px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 139px">
</colgroup>
  <tr>
    <th class="tg-qta8">Sudah Terima Dari</th>
    <th class="tg-qta8" colspan="5">: Bendahara Pengeluaran</th>
  </tr>
  <tr>
    <td class="tg-smzr">Kegiatan</td>
    <td class="tg-smzr" colspan="5">: {{ $perjadin->nama_kegiatan }}</td>
  </tr>
  <tr>
    <td class="tg-smzr">Tanggal</td>
    <td class="tg-smzr" colspan="5">: {{ date('d', strtotime($perjadin[0]['tanggal_awal'])) }} s.d {{ date('d M Y', strtotime($perjadin[0]['tanggal_akhir'])) }}</td>
  </tr>
  <tr>
    <td class="tg-smzr">Negara Tujuan</td>
    <td class="tg-smzr" colspan="5">: {{ $perjadin->negara->nama_negara }}</td>
  </tr>
  <tr>
    <td class="tg-smzr">Rincian</td>
    <td class="tg-smzr" colspan="5">:</td>
  </tr>
</table>

<br>
<?php  $count = 1; ?>
@foreach ($dataperjadins as $key => $dataperjadin)

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-123c{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 136px">
<col style="width: 133px">
<col style="width: 132px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 138px">
</colgroup>
  <tr>
    <th class="tg-123c" colspan="5">{{ $count++ }}. Uang Muka a.n {{ $dataperjadin->nama_pelaksana }}</th>
    <th class="tg-yw4l"></th>
  </tr>
</table>

<style type="text/css">
.tu  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tu td{font-family:Arial, sans-serif;font-size:14px;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tu th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tu .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tu .tg-gh1y{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tu .tg-baqh{text-align:center;vertical-align:top}
.tu .tg-pn81{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;text-align:right;vertical-align:top}
.tu .tg-4lem{font-family:"Times New Roman", Times, serif !important;;text-align:right;vertical-align:top}
.tu .tg-yw4l{vertical-align:top}
</style>
<table class="tu" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 142px">
<col style="width: 140px">
<col style="width: 139px">
<col style="width: 140px">
<col style="width: 140px">
<col style="width: 145px">
</colgroup>
  <tr>
    <th class="tg-gh1y" colspan="2">Rincian</th>
    <th class="tg-gh1y">Uang Muka</th>
    <th class="tg-gh1y" colspan="2">Dipertanggungjawabkan</th>
    <th class="tg-gh1y">DiKembalikan</th>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Uang Harian ( {{ $perjadin->lama }} Hari )</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->uang_harian, 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Penginapan ( {{ $perjadin->lama - 1 }} Hari )</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->penginapan, 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Taksi</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota , 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Pesawat</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->pesawat, 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  @if($dataperjadin->registration != 0)
  <tr>
      <td class="tg-smzr" colspan="2">Registration Fee</td>
      <td class="tg-4lem">{{ number_format($dataperjadin->registration, 0, ',', '.') }}</td>
      <td class="tg-yw4l" colspan="2"></td>
      <td class="tg-yw4l"></td>
  </tr>
  @endif
  <tr>
    <td class="tg-gh1y" colspan="2">Total</td>
    <td class="tg-pn81">{{ number_format($dataperjadin->uang_harian + $dataperjadin->penginapan + $dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota + $dataperjadin->pesawat + $dataperjadin->registration , 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
</table>

@endforeach

<br>

<style type="text/css">
.to  {border-collapse:collapse;border-spacing:0;border-color:#aaa;border:none;}
.to td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
.to th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f0f000;}
.to .tg-050i{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;background-color:#f0f000;color:#000000}
</style>
<table class="to" style="undefined;table-layout: fixed; width: 362px">
<colgroup>
<col style="width: 43px">
<col style="width: 98px">
<col style="width: 158px">
</colgroup>
  <tr>
    <th class="tg-050i" colspan="2">TOTAL DITERIMA </th>
    <th class="tg-050i">: {{ number_format($dataperjadins->sum('uang_harian') + $dataperjadins->sum('penginapan') + $dataperjadins->sum('taksi_provinsi') + $dataperjadins->sum('taksi_kab_kota') + $dataperjadins->sum('pesawat') + $dataperjadins->sum('registration') , 0, ',', '.') }}</th>
  </tr>
</table>

<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
</style>
<table class="tg">
  <tr>
    <th class="tg-qta8" colspan="6">Barang/Pekerjaan tersebut telah diterima dengan lengkap dan baik</th>
  </tr>
</table>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
</style>
<table class="tg">
  <tr>
    <th class="tg-qta8" colspan="6">Jakarta, {{ date('d M Y', strtotime($perjadin->tgl_pengajuan)) }}</th>
  </tr>
</table>

<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
</style>
<table class="tg" style="undefined; width: 100%">
<colgroup>
<col style="width: 133px">
<col style="width: 216px">
<col style="width: 155px">
<col style="width: 157px">
<col style="width: 158px">
<col style="width: 188px">
</colgroup>
  <tr>
    <th class="tg-g145" colspan="2" width="30%">Pelaksana I</th>
    <th class="tg-g145" colspan="2" width="30%">Pelaksana II</th>
    <th class="tg-g145" colspan="2">Mengetahui,</th>
  </tr>
</table>

<br>
<br>
<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tg .tg-vlr8{font-weight:bold;text-decoration:underline;font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
</style>
<table class="tg" style="undefined; width: 100%">
<colgroup>
<col style="width: 135px">
<col style="width: 221px">
<col style="width: 158px">
<col style="width: 160px">
<col style="width: 161px">
<col style="width: 192px">
</colgroup>
  <tr>
    <th class="tg-g145" colspan="2" rowspan="2" width="30%;">{{$dataperjadins[0]['nama_pelaksana']}}</th>
    <th class="tg-g145" colspan="2" rowspan="2">{{$dataperjadins[1]['nama_pelaksana']}}</th>
    <th class="tg-vlr8" colspan="2">{{ $pimpinan->nama }}</th>
  </tr>
  <tr>
    <td class="tg-g145" colspan="2">NIP. {{ $pimpinan->nip }}</td>
  </tr>
</table>

<hr color="#F5F5F5">

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 128px">
<col style="width: 208px">
<col style="width: 149px">
<col style="width: 152px">
<col style="width: 152px">
<col style="width: 181px">
</colgroup>
  <tr>
    <th class="tg-smzr" colspan="2">Diterima :</th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-g145" colspan="2"></th>
  </tr>
</table>

<br>
<br>
<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-dfxe{font-weight:bold;text-decoration:underline;font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 131px">
<col style="width: 213px">
<col style="width: 151px">
<col style="width: 154px">
<col style="width: 156px">
<col style="width: 185px">
</colgroup>
  <tr>
    <th class="tg-dfxe" colspan="2">{{ $bendahara->nama }}</th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-g145" colspan="2"></th>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">NIP. {{ $bendahara->nip }}</td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
</table>
@else

<?php  $count = 1; ?>
@foreach ($dataperjadins as $key => $dataperjadin)

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s2f6{font-family:"Times New Roman", Times, serif !important;;text-align:center}
.tg .tg-gzo9{font-weight:bold;text-decoration:underline;font-size:16px;font-family:"Times New Roman", Times, serif !important;;text-align:center}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 122px">
<col style="width: 121px">
<col style="width: 121px">
<col style="width: 122px">
<col style="width: 122px">
<col style="width: 126px">
</colgroup>
  <tr>
    <th class="tg-s2f6"></th>
    <th class="tg-gzo9" colspan="4">TANDA TERIMA PENYERAHAN UANG MUKA PERJADIN</th>
    <th class="tg-031e"></th>
  </tr>
</table>

<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-x711{font-size:100%;font-family:"Times New Roman", Times, serif !important;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
.tg .tg-s2f6{font-family:"Times New Roman", Times, serif !important;;text-align:center}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 126px">
<col style="width: 124px">
<col style="width: 124px">
<col style="width: 125px">
<col style="width: 125px">
<col style="width: 129px">
</colgroup>
  <tr>
    <th class="tg-s2f6"></th>
    <th class="tg-x711"></th>
    <th class="tg-031e"></th>
    <th class="tg-qta8" colspan="3">TA : {{ $perjadin->thn_anggaran }}</th>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-smzr" colspan="3">MAK : {{ $perjadin->no_mak }}</td>
  </tr>
</table>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-x711{font-family:"Times New Roman", Times, serif !important;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 136px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 139px">
</colgroup>
  <tr>
    <th class="tg-qta8">Sudah Terima Dari</th>
    <th class="tg-qta8" colspan="5">: Bendahara Pengeluaran</th>
  </tr>
  <tr>
    <td class="tg-smzr">Kegiatan</td>
    <td class="tg-smzr" colspan="5">: {{ $perjadin->nama_kegiatan }}</td>
  </tr>
  <tr>
    <td class="tg-smzr">Tanggal</td>
    <td class="tg-smzr" colspan="5">: {{ date('d', strtotime($perjadin[0]['tanggal_awal'])) }} s.d {{ date('d M Y', strtotime($perjadin[0]['tanggal_akhir'])) }}</td>
  </tr>
  <tr>
    <td class="tg-smzr">Negara Tujuan</td>
    <td class="tg-smzr" colspan="5">: {{ $perjadin->negara->nama_negara }}</td>
  </tr>
  <tr>
    <td class="tg-smzr">Rincian</td>
    <td class="tg-smzr" colspan="5">:</td>
  </tr>
</table>

<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-123c{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 136px">
<col style="width: 133px">
<col style="width: 132px">
<col style="width: 134px">
<col style="width: 134px">
<col style="width: 138px">
</colgroup>
  <tr>
    <th class="tg-123c" colspan="4">{{ $count++ }}. Uang Muka a.n {{ $dataperjadin->nama_pelaksana }}</th>
    <th class="tg-smzr"></th>
    <th class="tg-yw4l"></th>
  </tr>
</table>

<style type="text/css">
.tu  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tu td{font-family:Arial, sans-serif;font-size:14px;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tu th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:4px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tu .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tu .tg-gh1y{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tu .tg-baqh{text-align:center;vertical-align:top}
.tu .tg-pn81{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;text-align:right;vertical-align:top}
.tu .tg-4lem{font-family:"Times New Roman", Times, serif !important;;text-align:right;vertical-align:top}
.tu .tg-yw4l{vertical-align:top}
</style>
<table class="tu" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 142px">
<col style="width: 140px">
<col style="width: 139px">
<col style="width: 140px">
<col style="width: 140px">
<col style="width: 145px">
</colgroup>
  <tr>
    <th class="tg-gh1y" colspan="2">Rincian</th>
    <th class="tg-gh1y">Uang Muka</th>
    <th class="tg-gh1y" colspan="2">Dipertanggungjawabkan</th>
    <th class="tg-gh1y">DiKembalikan</th>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Uang Harian ( {{ $perjadin->lama }} Hari )</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->uang_harian, 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Penginapan ( {{ $perjadin->lama - 1 }} Hari )</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->penginapan, 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Taksi</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota , 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">Pesawat</td>
    <td class="tg-4lem">{{ number_format($dataperjadin->pesawat, 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
  @if($dataperjadin->registration != 0)
  <tr>
      <td class="tg-smzr" colspan="2">Registration Fee</td>
      <td class="tg-4lem">{{ number_format($dataperjadin->registration, 0, ',', '.') }}</td>
      <td class="tg-yw4l" colspan="2"></td>
      <td class="tg-yw4l"></td>
  </tr>
  @endif
  <tr>
    <td class="tg-gh1y" colspan="2">Total</td>
    <td class="tg-pn81">{{ number_format($dataperjadin->uang_harian + $dataperjadin->penginapan + $dataperjadin->taksi_provinsi + $dataperjadin->taksi_kab_kota + $dataperjadin->pesawat + $dataperjadin->registration , 0, ',', '.') }}</td>
    <td class="tg-yw4l" colspan="2"></td>
    <td class="tg-yw4l"></td>
  </tr>
</table>

<br>

<style type="text/css">
.to  {border-collapse:collapse;border-spacing:0;border-color:#aaa;border:none;}
.to td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
.to th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f0f000;}
.to .tg-050i{font-weight:bold;font-family:"Times New Roman", Times, serif !important;;background-color:#f0f000;color:#000000}
</style>
<table class="to" style="undefined;table-layout: fixed; width: 362px">
<colgroup>
<col style="width: 43px">
<col style="width: 98px">
<col style="width: 158px">
</colgroup>
  <tr>
    <th class="tg-050i" colspan="2">TOTAL DITERIMA </th>
    <th class="tg-050i">: {{ number_format($dataperjadins->sum('uang_harian') + $dataperjadins->sum('penginapan') + $dataperjadins->sum('taksi_provinsi') + $dataperjadins->sum('taksi_kab_kota') + $dataperjadins->sum('pesawat') + $dataperjadins->sum('registration') , 0, ',', '.') }}</th>
  </tr>
</table>

<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
</style>
<table class="tg">
  <tr>
    <th class="tg-qta8" colspan="6">Barang/Pekerjaan tersebut telah diterima dengan lengkap dan baik</th>
  </tr>
</table>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-qta8{font-family:"Times New Roman", Times, serif !important;}
</style>
<table class="tg">
  <tr>
    <th class="tg-qta8" colspan="6">Jakarta, {{ date('d M Y', strtotime($perjadin->tgl_pengajuan)) }}</th>
  </tr>
</table>

<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 133px">
<col style="width: 216px">
<col style="width: 155px">
<col style="width: 157px">
<col style="width: 158px">
<col style="width: 188px">
</colgroup>
  <tr>
    <th class="tg-g145" colspan="2">Pelaksana </th>
    <th class="tg-g145" colspan="2"></th>
    <th class="tg-g145" colspan="2">Mengetahui,</th>
  </tr>
</table>

<br>
<br>
<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tg .tg-vlr8{font-weight:bold;text-decoration:underline;font-family:"Times New Roman", Times, serif !important;;text-align:right;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 135px">
<col style="width: 221px">
<col style="width: 158px">
<col style="width: 160px">
<col style="width: 161px">
<col style="width: 192px">
</colgroup>
  <tr>
    <th class="tg-g145" colspan="2">{{ $dataperjadin->nama_pelaksana }}</th>
    <th class="tg-g145" colspan="1"></th>
    <th class="tg-vlr8" colspan="3">{{ $pimpinan->nama }}</th>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-g145" colspan="2">NIP. {{ $pimpinan->nip }}</td>
  </tr>
</table>

<hr color="#F5F5F5">

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 128px">
<col style="width: 208px">
<col style="width: 149px">
<col style="width: 152px">
<col style="width: 152px">
<col style="width: 181px">
</colgroup>
  <tr>
    <th class="tg-smzr" colspan="2">Diterima :</th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-g145" colspan="2"></th>
  </tr>
</table>

<br>
<br>
<br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 0px;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-g145{font-family:"Times New Roman", Times, serif !important;;text-align:center;vertical-align:top}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-dfxe{font-weight:bold;text-decoration:underline;font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 725px">
<colgroup>
<col style="width: 131px">
<col style="width: 213px">
<col style="width: 151px">
<col style="width: 154px">
<col style="width: 156px">
<col style="width: 185px">
</colgroup>
  <tr>
    <th class="tg-dfxe" colspan="2">{{ $bendahara->nama }}</th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l"></th>
    <th class="tg-g145" colspan="2"></th>
  </tr>
  <tr>
    <td class="tg-smzr" colspan="2">NIP. {{ $bendahara->nip }}</td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
</table>

<div style="page-break-before:always;"></div>

@endforeach
@endif

