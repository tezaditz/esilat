<form action="{{ route('pertanggungjawaban.perjadin-dalam-negeri.kirim', $perjadin->id) }}" method="post">
    {{ csrf_field() }}
    <table class="table table-hover">
        <tr>
            <th>Akun</th>
            <th>Uraian</th>
            <th>Sisa Pagu</th>
            <th>Pengajuan</th>
            <th width="170px">Pertanggungjawaban</th>
            <th width="170px">Pengembalian</th>
            <th width="30px"></th>
        </tr>
        @if($perjadinakuns->count() > 0)
            @foreach($perjadinakuns as $key => $perjadinakun)
                <tr>
                    <td>
                        {{ $perjadinakun->kode_11 }}
                        <input type="hidden" name="perjadinakun_id[{{ $perjadinakun->id }}]" value="{{ $perjadinakun->id }}">
                    </td>
                    <td>{{ $perjadinakun->uraian}}</td>
                    <td class="text-right" width="70px">{{ number_format($perjadinakun->sisa_pagu, 0, ',', '.') }}</td>
                    <td class="text-right" width="70px">{{ number_format($perjadinakun->jumlah_pengajuan, 0, ',', '.') }}</td>
                    <td>
                        <input type="text" name="nilai[{{ $perjadinakun->id }}]" id="nilai{{ $perjadinakun->id }}" class="form-control input-sm nilai" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                    </td>
                    <td>
                        <input type="text" name="sisa_ang[{{ $perjadinakun->id }}]" id="sisa_ang{{ $perjadinakun->id }}" class="form-control input-sm sisa_ang" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                    </td>
                    <td>
                        <input type="checkbox" id="checkbox{{ $perjadinakun->id }}" name="checkbox[{{ $perjadinakun->id }}]">
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="bg-gray disabled color-palette">
                <td colspan="7"></td>
            </tr>
            <tr class="bg-gray disabled color-palette">
                <td class="text-center" colspan="7"><i class="fa fa-exclamation-triangle fa-2x"></i></td>
            </tr>
            <tr class="bg-gray disabled color-palette">
                <td class="text-center"
                    colspan="7">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.index.is_empty')</td>
            </tr>
            <tr class="bg-gray disabled color-palette">
                <td colspan="7"></td>
            </tr>
        @endif
        <tr>
            <th colspan="2" class="text-right">Total:</th>
            <th class="text-right">{{ number_format($sisapagu->sisa_pagu, 0, ',', '.') }}</th>
            <th class="text-right">{{ number_format($jumlahpengajuan->jumlah_pengajuan, 0, ',', '.') }}</th>
            <th>
                <input type="text" name="total_pj" id="total_pj" class="form-control input-sm" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
            </th>
            <th>
                <input type="text" name="total_kembali" id="total_kembali" class="form-control input-sm" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
            </th>
        </tr>
    </table>

    @include('backend.pertanggungjawaban.perjadin.detailperjadin.data-pelaksana-pj')

    <div class="row">
        <div class="col-xs-12">
            <hr>
            <a href="{{ route('pertanggungjawaban.perjadin-dalam-negeri.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>
            <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-send"></i> @lang('backend/_globals.buttons.send')</button>
        </div>
    </div>
</form>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function(){
            @foreach($perjadinakuns as $key => $perjadinakun)
            $('#checkbox{{ $perjadinakun->id }}').change(function(){
                    if($('#checkbox{{ $perjadinakun->id }}:checked').length) {
                        $('[name="nilai[{{ $perjadinakun->id }}]"]').val('0').attr('readonly',false);
                        $('[name="nilai[{{ $perjadinakun->id }}]"]').val('{{ number_format($perjadinakun->jumlah_pengajuan, 0, ',', '.') }}');
                    } else {
                        $('[name="nilai[{{ $perjadinakun->id }}]"]').val('0').attr('readonly',true);
                        $('[name="nilai[{{ $perjadinakun->id }}]"]').val('0');
                        $('[name="sisa_ang[{{ $perjadinakun->id }}]"]').val('0');
                    }

                    var nilai = parseFloat($('[name="nilai[{{ $perjadinakun->id }}]"]').val().replace(/\./g, '')) || 0;
                    pengembalian = (nilai ? {{ $perjadinakun->jumlah_pengajuan }} - nilai : "0");
                    $('#sisa_ang{{ $perjadinakun->id }}').val(pengembalian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                    var total_pj = 0;
                    $('.nilai').each(function(){
                        jumlah = $(this).val().replace(/\./g, '') || 0;
                        total_pj += +jumlah;
                    });

                    $('#total_pj').val(total_pj.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                    var total_kembali = 0;
                    $('.sisa_ang').each(function(){
                        jumlah = $(this).val().replace(/\./g, '') || 0;
                        total_kembali += +jumlah;
                    });
                    $('#total_kembali').val(total_kembali.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                });




            $('#nilai{{ $perjadinakun->id }}').keyup(function(){
                if (/\D/g.test(this.value))
                    {
                        this.value = this.value.replace(/\D/g, '');
                    }

                $('#nilai{{ $perjadinakun->id }}').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));


                if ($('[name="nilai[{{ $perjadinakun->id }}]"]').val().replace(/\./g, '') > {{ $perjadinakun->jumlah_pengajuan }}) {
                    alert('Masukan tidak sesuai.');
                    $('[name="nilai[{{ $perjadinakun->id }}]"]').val('0');
                }

                var nilai = parseFloat($(this).val().replace(/\./g, '')) || 0;
                total_kembali = (nilai ? {{ $perjadinakun->jumlah_pengajuan }} - nilai : "0");
                $('#sisa_ang{{ $perjadinakun->id }}').val(total_kembali.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                var total_pj = 0;
                $('.nilai').each(function(){
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total_pj += +jumlah;
                });
                $('#total_pj').val(total_pj.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                var total_kembali = 0;
                $('.sisa_ang').each(function(){
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total_kembali += +jumlah;
                });
                $('#total_kembali').val(total_kembali.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                
            });
            @endforeach
        });
    </script>
@stop