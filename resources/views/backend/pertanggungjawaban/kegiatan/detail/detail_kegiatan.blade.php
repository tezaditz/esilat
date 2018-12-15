<div class="row">
    <div class="col-xs-12">
        <form action="{{ route('pertanggungjawaban.kegiatan.simpan-detail', $kegiatan->id) }}" method="post">
            <div class="table-responsive no-padding">
                {{ csrf_field() }}
                <table class="table table-hover">
                    <tr>
                        <th>Akun</th>
                        <th>Keterangan</th>
                        <th width="100px">Pagu</th>
                        <th width="100px">Sisa Pagu</th>
                        <th width="100px">Pengajuan</th>
                        <th width="170px">Pertanggungjawaban</th>
                        <th width="170px">Pengembalian</th>
                        @role('user')
                        @if($kegiatan->status->kode_status == 'KG06')
                            <th style="width: 5px"></th>
                        @endif
                        @endrole
                    </tr>
                    @forelse($details as $key => $detail)
                        <tr>
                            <td>{{ $detail->akun }}</td>
                            <td>{{ $detail->uraian }}</td>
                            <td class="text-right" width="70px">{{ number_format($detail->rkakl->jumlah, 0, ',', '.') }}</td>
                            <td class="text-right" width="70px">
                                {{ number_format($detail->rkakl->jumlah - ($detail->rkakl->realisasi_2 + $detail->rkakl->realisasi_3), 0, ',', '.') }}
                                {{--<input type="hidden" name="pengajuan[{{ $detail->id }}]" id="pengajuan[{{ $detail->id }}]" value="{{ $detail->sisa_pagu }}">--}}
                                <input type="hidden" name="id[{{ $detail->id }}]" id="id[{{ $detail->id }}]" value="{{ $detail->id }}">
                            </td>
                            <td class="text-right" width="70px">
                                {{ number_format($detail->jml_rph, 0, ',', '.') }}
                            </td>
                            <td width="70px">
                                @if($kegiatan->status->kode_status == 'KG09' or $kegiatan->status->kode_status == 'KG12')
                                    <input type="text" name="jml[{{ $detail->id }}]" id="jml{{ $detail->id }}" value="{{ number_format($detail->pj_jml_rph, 0, ',', '.') }}" class="form-control input-sm jumlah" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                                @else
                                    <input type="text" name="jml[{{ $detail->id }}]" id="jml{{ $detail->id }}" value="{{ number_format($detail->pj_jml_rph, 0, ',', '.') }}" class="form-control input-sm jumlah" style="text-align: right" onfocus="this.select();" onmouseup="return false;" readonly>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="sisa_ang[{{ $detail->id }}]" id="sisa_ang{{ $detail->id }}" class="form-control input-sm sisa_ang" style="text-align:right" onfocus="this.select();" onmouseup="return false;" readonly value="{{ number_format($detail->jml_rph - $detail->pj_jml_rph, 0, ',', '.') }}">
                            </td>
                            @role('user')
                            @if($kegiatan->status->kode_status == 'KG06')
                                <td class="text-right">
                                    <input type="checkbox" id="checkbox{{ $detail->id }}" name="checkbox[{{ $detail->id }}]" value="{{ $detail->rkakl_id }}">
                                </td>
                            @endif
                            @endrole
                        </tr>
                    @empty
                        <tr class="bg-gray disabled color-palette"><td colspan="5"></td></tr>
                        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="5"><i class="fa fa-exclamation-triangle fa-2x"></i></td></tr>
                        <tr class="bg-gray disabled color-palette"><td class="text-center" colspan="5">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.index.is_empty')</td></tr>
                        <tr class="bg-gray disabled color-palette"><td colspan="5"></td></tr>
                    @endforelse
                    <tr>
                        <th colspan="4" class="text-right">
                            Total
                        </th>
                        <th class="text-right">{{ number_format($totalpengajuan->jml_rph, 0, ',', '.') }}</th>
                        <th>
                            <input type="text" name="totalpj" id="totalpj" value="{{ number_format($totalpjpengajuan->pj_jml_rph, 0, ',', '.') }}" class="form-control input-sm text-right" readonly>
                        </th>
                        <th>
                            <input type="text" name="total_kembali" id="total_kembali" class="form-control input-sm" style="text-align: right" onfocus="this.select();" value="{{ number_format($totalpengajuan->jml_rph - $totalpjpengajuan->pj_jml_rph, 0, ',', '.') }}" onmouseup="return false;" readonly>
                        </th>
                        @role('user')
                        @if($kegiatan->status->kode_status == 'KG06')
                            <th></th>
                        @endif
                        @endrole
                    </tr>
                </table>
            </div>

            <a href="{{ route('pertanggungjawaban.kegiatan.index') }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</a>

            @role('user')
                @if($kegiatan->status->kode_status != 'KG09')
                    @if($kegiatan->status->kode_status != 'KG12')
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
    </div>
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function () {
            @foreach($details as $key => $detail)
            $('#checkbox{{ $detail->id }}').change(function () {
                if ($('#checkbox{{ $detail->id }}:checked').length) {
                    $('[name="jml[{{ $detail->id }}]"]').attr('readonly', false);
                    $('[name="jml[{{ $detail->id }}]"]').focus();
                    $('[name="jml[{{ $detail->id }}]"]').val('{{ number_format($detail->pj_jml_rph, 0, ',', '.') }}');
                } else {
                    $('[name="jml[{{ $detail->id }}]"]').attr('readonly', true);
                    {{--$('[name="jml[{{ $detail->id }}]"]').val('0');--}}
                    $('[name="sisa_ang[{{ $detail->id }}]"]').val('0');
                }

                var jml = parseFloat($('[name="jml[{{ $detail->id }}]"]').val().replace(/\./g, '')) || 0;
                pengembalian = (jml ? {{ $detail->jml_rph }} -jml : "0");
                $('#sisa_ang{{ $detail->id }}').val(pengembalian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

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


            $('#jml{{ $detail->id }}').keyup(function () {
                if (/\D/g.test(this.value)) {
                    this.value = this.value.replace(/\D/g, '');
                }

                $('#jml{{ $detail->id }}').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                if ($('[name="jml[{{ $detail->id }}]"]').val().replace(/\./g, '') > {{ $detail->jml_rph }}) {
                    alert('Masukan tidak sesuai.');
                    $('[name="jml[{{ $detail->id }}]"]').val('0');
                    $('[name="sisa_ang[{{ $detail->id }}]"]').val('0');
                }

                var jml = parseFloat($(this).val().replace(/\./g, '')) || 0;
                pengembalian = (jml ? {{ $detail->jml_rph }} -jml : {{ $detail->jml_rph }});
                $('#sisa_ang{{ $detail->id }}').val(pengembalian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

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
            @endforeach
        });
    </script>
@stop