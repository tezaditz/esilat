<form action="{{ route('pertanggungjawaban.layanan-perkantoran.simpan-detail', $perkantorans->id) }}" method="post" class="form-horizontal">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    {{ csrf_field() }}
                    <table class="table table-hover">
                        <tr>
                            <th>Akun</th>
                            <th>Keterangan</th>
                            <th width="100px">Sisa Pagu</th>
                            <th width="100px">Pengajuan</th>
                            <th width="170px">Pertanggungjawaban</th>
                            <th width="170px">Pengembalian</th>
                            @role('user')
                            @if($perkantorans->status->kode_status == 'PK15')
                                <th style="width: 5px"></th>
                            @endif
                            @endrole
                        </tr>
                        @forelse($detailPerkantorans as $detailPerkantoran)
                            <tr>
                                <td>{{ $detailPerkantoran->kode_11 }}</td>
                                <td>{{ $detailPerkantoran->uraian }}</td>
                                <td class="text-right" width="70px">
                                    {{ number_format($detailPerkantoran->sisa_pagu, 0, ',', '.') }}
                                    {{--<input type="hidden" name="pengajuan[{{ $detailPerkantoran->id }}]" id="pengajuan[{{ $detailPerkantoran->id }}]" value="{{ $detailPerkantoran->sisa_pagu }}">--}}
                                    <input type="hidden" name="id[{{ $detailPerkantoran->id }}]" id="id[{{ $detailPerkantoran->id }}]" value="{{ $detailPerkantoran->id }}">
                                </td>
                                <td class="text-right" width="70px">
                                    {{ number_format($detailPerkantoran->jumlah, 0, ',', '.') }}
                                </td>
                                <td width="70px">
                                @if($perkantorans->status->kode_status == 'PK09' || $perkantorans->status->kode_status == 'PK12')
                                    <input type="text" name="jml[{{ $detailPerkantoran->id }}]" id="jml1[{{ $detailPerkantoran->id }}]" value="{{ number_format($detailPerkantoran->pj_jumlah, 0, ',', '.') }}" class="form-control input-sm jumlah" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                                @else
                                    <input type="text" name="jml[{{ $detailPerkantoran->id }}]" id="jml2[{{ $detailPerkantoran->id }}]" value="{{ number_format($detailPerkantoran->pj_jumlah, 0, ',', '.') }}" class="form-control input-sm jumlah" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                                @endif
                                </td>
                                <td>
                                    <input type="text" name="sisa_ang[{{ $detailPerkantoran->id }}]" id="sisa_ang{{ $detailPerkantoran->id }}" class="form-control input-sm sisa_ang" style="text-align:right" onfocus="this.select();" onmouseup="return false;" readonly value="{{ number_format($detailPerkantoran->jumlah - $detailPerkantoran->pj_jumlah, 0, ',', '.') }}">
                                </td>
                                @role('user')
                                @if($perkantorans->status->kode_status == 'PK15')
                                    <td class="text-right">
                                        <input type="checkbox" id="checkbox{{ $detailPerkantoran->id }}" name="checkbox[{{ $detailPerkantoran->id }}]" value="{{ $detailPerkantoran->rkakl_id }}">
                                    </td>
                                @endif
                                @endrole
                        @empty
                            <tr class="bg-gray disabled color-palette"><td colspan="5"></td></tr>
                            <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="5"><i class="fa fa-exclamation-triangle fa-2x"></i></td></tr>
                            <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="5">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.index.is_empty')</td></tr>
                            <tr class="bg-gray disabled color-palette"><td colspan="5"></td></tr>
                        @endforelse
                        <tr>
                            <th class="text-right" colspan="3">Total</th>
                            <th class="text-right">{{ number_format($detailPerkantorans->sum('jumlah'), 0, ',', '.') }}</th>
                            <th>
                                <input type="text" name="total_pj" id="total_pj" value="{{ number_format($detailPerkantorans->sum('pj_jumlah'), 0, ',', '.') }}" class="form-control input-sm text-right" readonly>
                            </th>
                            <th>
                                <input type="text" name="total_kembali" id="total_kembali" class="form-control input-sm" style="text-align: right" onfocus="this.select();" value="{{ number_format($detailPerkantorans->sum('jumlah') - $detailPerkantorans->sum('pj_jumlah'), 0, ',', '.') }}" onmouseup="return false;" readonly>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>

    @role('user')
        @if($perkantorans->status->kode_status != 'PK09')
            @if($perkantorans->status->kode_status != 'PK12')   
            <button type="submit" class="btn btn-success btn-flat btn-sm pull-right"><i class="fa fa-save"></i> Simpan</button>
            <div class="input-group input-group-sm pull-right">
                <select name="rampung" class="form-control" id="rampung" style="width: 100%;" required>
                    <option></option>
                    <option value="0">Belum Rampung</option>
                    <option value="1">Rampung</option>
                </select>
            </div>
            @endif
        @endif
    @endrole
    
</form>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function(){
            @foreach($detailPerkantorans as $key => $detailPerkantoran)
            $('#checkbox{{ $detailPerkantoran->id }}').change(function () {
                if ($('#checkbox{{ $detailPerkantoran->id }}:checked').length) {
                    $('[name="jml[{{ $detailPerkantoran->id }}]"]').attr('readonly', false);
                    $('[name="jml[{{ $detailPerkantoran->id }}]"]').focus();
                    $('[name="jml[{{ $detailPerkantoran->id }}]"]').val('{{ number_format($detailPerkantoran->jumlah, 0, ',', '.') }}');
                    var total = 0;
                    $('.jumlah').each(function(){
                        jumlah = $(this).val().replace(/\./g, '') || 0;
                        total += +jumlah;
                    });
                    $('#total_pj').val(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                } else {
                    $('[name="jml[{{ $detailPerkantoran->id }}]"]').attr('readonly', true);
                    $('[name="jml[{{ $detailPerkantoran->id }}]"]').val('0');
                    $('[name="sisa_ang[{{ $detailPerkantoran->id }}]"]').val('0');
                    var total = 0;
                    $('.jumlah').each(function(){
                        jumlah = $(this).val().replace(/\./g, '') || 0;
                        total += +jumlah;
                    });
                    $('#total_pj').val(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                }

                var jml = parseFloat($('[name="jml[{{ $detailPerkantoran->id }}]"]').val().replace(/\./g, '')) || 0;
                pengembalian = (jml ? {{ $detailPerkantoran->jumlah }} - jml : {{ $detailPerkantoran->jumlah }});
                $('#sisa_ang{{ $detailPerkantoran->id }}').val(pengembalian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                var total_kembali = 0;
                $('.sisa_ang').each(function () {
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total_kembali += +jumlah;
                });
                $('#total_kembali').val(total_kembali.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                var total = 0;
                $('.jumlah').each(function () {
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total += +jumlah;
                });
                $('#totalpj').val(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            });

            $('[name="jml[{{ $detailPerkantoran->id }}]"]').keyup(function(){
                if (/\D/g.test(this.value)) {
                    this.value = this.value.replace(/\D/g, '');
                }

                $('[name="jml[{{ $detailPerkantoran->id }}]"]').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                if ($('[name="jml[{{ $detailPerkantoran->id }}]"]').val().replace(/\./g, '') > {{ $detailPerkantoran->jumlah }}) {
                    alert('Masukan tidak sesuai.');
                    $('[name="jml[{{ $detailPerkantoran->id }}]"]').val('0');
                }

                var jml = parseFloat($(this).val().replace(/\./g, '')) || 0;
                pengembalian = (jml ? {{ $detailPerkantoran->jumlah }} -jml : {{ $detailPerkantoran->jumlah }});
                $('#sisa_ang{{ $detailPerkantoran->id }}').val(pengembalian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                var total_kembali = 0;
                $('.sisa_ang').each(function () {
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total_kembali += +jumlah;
                });
                $('#total_kembali').val(total_kembali.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                var total = 0;
                $('.jumlah').each(function(){
                    jumlah = $(this).val().replace(/\./g, '') || 0;
                    total += +jumlah;
                });
                $('#total_pj').val(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            });
            @endforeach
        });
    </script>
@stop