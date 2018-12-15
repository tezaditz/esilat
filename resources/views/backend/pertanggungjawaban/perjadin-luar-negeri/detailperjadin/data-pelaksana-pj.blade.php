<hr>
<div class="row">
    @if($data_perjadins->count() > 0)
        @php $i = 0 @endphp
        @php $o = 0 @endphp
        @foreach($data_perjadins as $key => $data_perjadin)
            @php $o++ @endphp
                <div class="col-md-6">
                    <table class="table table-responsive table-hover table-bordered">
                        <tr>
                            <th class="bg-green color-palette" colspan="4">
                                {{ $data_perjadin->nama_pelaksana }}
                            </th>
                        </tr>
                        <tr>
                            <th>Uraian</th>
                            <th>Pengajuan</th>
                            <th>Pertanggungjawaban</th>
                            <th>Dikembalikan</th>
                        </tr>
                    @foreach($jenisbiayaperjadins as $jenisbiayaperjadin)
                        @php ++$i @endphp

                        @if($jenisbiayaperjadin->name == 'Tiket Pesawat')
                            @php
                                $nilai2 = $data_perjadin->pesawat;
                                $nilai3 = $data_perjadin->pj_pesawat;
                            @endphp
                        @elseif($jenisbiayaperjadin->name == 'Transport / Taksi')
                            @php
                                $nilai2 = $data_perjadin->taksi_provinsi;
                                $nilai3 = $data_perjadin->pj_taksi_provinsi;
                            @endphp
                        @elseif($jenisbiayaperjadin->name == 'Transport / Taksi (Kab / Kota)')
                            @php
                                $nilai2 = $data_perjadin->taksi_kab_kota;
                                $nilai3 = $data_perjadin->pj_taksi_kab_kota;
                            @endphp
                        @elseif($jenisbiayaperjadin->name == 'Uang Harian')
                            @php
                                $nilai2 = $data_perjadin->uang_harian;
                                $nilai3 = $data_perjadin->pj_uang_harian;
                            @endphp
                        @elseif($jenisbiayaperjadin->name == 'Penginapan')
                            @php
                                $nilai2 = $data_perjadin->penginapan;
                                $nilai3 = $data_perjadin->pj_penginapan;
                            @endphp
                        @elseif($jenisbiayaperjadin->name == 'Registrasion Fee')
                            @php
                                $nilai2 = $data_perjadin->registration;
                                $nilai3 = $data_perjadin->pj_registration;
                            @endphp
                        @endif

                        <tr>
                            <td>{{ $jenisbiayaperjadin->name }}</td>
                            <td class="text-right">{{ number_format($nilai2, 0, ',', '.') }}</td>
                            <td class="text-right">
                                <input type="text" name="nilai2[{{ $i }}]" id="nilai2[{{ $i }}]" class="form-control input-sm nilai2{{ $o }}" style="text-align: right" onfocus="this.select();" onmouseup="return false;">
                            </td>
                            <td class="text-right">
                                <input type="text" name="kembali[{{ $i }}]" id="kembali{{ $i }}" class="form-control input-sm kembali{{ $o }}" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th class="text-right">Total:</th>
                        <th class="text-right">{{ number_format($data_perjadin->total, 0, ',', '.') }}</th>
                        <th class="text-right">
                            <input type="text" name="total_aju" id="total_aju{{ $o }}" class="form-control input-sm" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                        </th>
                        <th class="text-right">
                            <input type="text" name="total_kembalian" id="total_kembalian{{ $o }}" class="form-control input-sm" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                        </th>
                    </tr>
                </table>
            </div>
        @endforeach
    @else
        <div class="text-center">
            <br><br>
            <i class="fa fa-exclamation-triangle fa-2x"></i>
            <h4 class="no-margins">Tidak ada Pelaksana yg teregistrasi.</h4>
            <br><br>
        </div>
    @endif
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function () {
            @php $i = 0 @endphp
            @php $o = 0 @endphp
            @foreach($data_perjadins as $key => $data_perjadin)
            @php ++$o @endphp
            @foreach($jenisbiayaperjadins as $jenisbiayaperjadin)
            @php ++$i @endphp
            @if($jenisbiayaperjadin->name == 'Tiket Pesawat')
            @php
                $nilai2 = $data_perjadin->pesawat;
                $nilai3 = $data_perjadin->pj_pesawat;
            @endphp
            @elseif($jenisbiayaperjadin->name == 'Transport / Taksi')
            @php
                $nilai2 = $data_perjadin->taksi_provinsi;
                $nilai3 = $data_perjadin->pj_taksi_provinsi;
            @endphp
            @elseif($jenisbiayaperjadin->name == 'Transport / Taksi (Kab / Kota)')
            @php
                $nilai2 = $data_perjadin->taksi_kab_kota;
                $nilai3 = $data_perjadin->pj_taksi_kab_kota;
            @endphp
            @elseif($jenisbiayaperjadin->name == 'Uang Harian')
            @php
                $nilai2 = $data_perjadin->uang_harian;
                $nilai3 = $data_perjadin->pj_uang_harian;
            @endphp
            @elseif($jenisbiayaperjadin->name == 'Penginapan')
            @php
                $nilai2 = $data_perjadin->penginapan;
                $nilai3 = $data_perjadin->pj_penginapan;
            @endphp
            @elseif($jenisbiayaperjadin->name == 'Registrasion Fee')
            @php
                $nilai2 = $data_perjadin->registration;
                $nilai3 = $data_perjadin->pj_registration;
            @endphp
            @endif

            $('[name="nilai2[{{ $i }}]"]').keyup(function () {
                if (/\D/g.test(this.value)) {
                    this.value = this.value.replace(/\D/g, '');
                }

                $('[name="nilai2[{{ $i }}]"]').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                if ($('[name="nilai2[{{ $i }}]"]').val().replace(/\./g, '') > {{ $nilai2 }}) {
                    alert('Masukan tidak sesuai.');
                    $('[name="nilai2[{{ $i }}]"]').val('0');
                }

                var nilai2 = parseFloat($(this).val().replace(/\./g, '')) || 0;
                total_kembali = (nilai2 ? {{ $nilai2 }} -nilai2 : "0");
                $('#kembali{{ $i }}').val(total_kembali.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            });
            @endforeach

            $('.nilai2{{ $o }}').keyup(function () {
                var total_aju = 0;
                $('.nilai2{{ $o }}').each(function () {
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total_aju += +jumlah;
                });

                $('#total_aju{{ $o }}').val(total_aju.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                var total_kembalian = 0;
                $('.kembali{{ $o }}').each(function () {
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total_kembalian += +jumlah;
                });
                $('#total_kembalian{{ $o }}').val(total_kembalian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            });
            @endforeach
        });
    </script>
@stop