@php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/07/2017
 * Time: 01:25 PM
 */
@endphp
<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal"
                  action="{{ route('pengajuan.perjadin-dalam-negeri.detail-pelaksana.store', $perjadin_id) }}"
                  method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('backend/_globals.buttons.create') @lang('backend/pertanggungjawaban.submodule.pelaksana')</h4>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nama_pelaksana" class="col-sm-2 control-label">
                            <th>@lang('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.tables.nama_pelaksana')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('nama_pelaksana') ? 'has-error' : '' }}">
                        @if($pegawai->count() > 0)
                            <div class="input-group input-group-sm">
                                <select name="nama_pelaksana" class="form-control select2" id="nama_pelaksana" style="width: 100%;" required>
                                            <option value=""></option>
                                            @foreach($pegawai as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                                            @endforeach
                                        </select>
                                <span class="input-group-btn">
                                    <a href="{{ route('master.pegawai.index') }}" class="btn  btn-flat"><i class="fa fa-upload"></i></a>
                                </span>
                            </div>
                        @else
                            <a href="{{ route('master.pegawai.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.upload')</a> @lang('backend/master/rkakl.rkakl.index.is_empty')
                        @endif

                        @if($errors->has('nama_pelaksana'))
                            <span class="help-block">
                                {{ $errors->first('nama_pelaksana') }}
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nip" class="col-sm-2 control-label">
                            <th>@lang('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.tables.nip')</th>
                        </label>
                        <div class="col-sm-10 {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <input type="text" name="nip" class="form-control" id="nip" placeholder="Ex: 195911211987031002"
                                   value="{{ old('nip') }}" readonly="">
                        @if($errors->has('nip'))
                                <span class="help-block">
                                    {{ $errors->first('nip') }}
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <th>@lang('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.tables.keterangan')</th>
                            <th colspan="3">@lang('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.tables.nilai_pengajuan')</th>
                            <th>@lang('backend/pertanggungjawaban.perjadin.submodule.detail_perjadin.tables.jumlah_pengajuan')</th>
                            @foreach($jenisbiaya as $key => $jenisbiayas)
                            @if($data_perjadin != null)
                                @if($jenisbiayas->name == 'Tiket Pesawat')
                                    @php
                                    $nilai2 = number_format(@$data_perjadin->pesawat ,0, ',', '.');
                                    
                                    @endphp
                                @elseif($jenisbiayas->name == 'Transport / Taksi')
                                    @php
                                    $nilai2 = number_format(@$data_perjadin->taksi_provinsi ,0, ',', '.');
                                    
                                    @endphp
                                @elseif($jenisbiayas->name == 'Transport / Taksi (Kab / Kota)')
                                    @php
                                    $nilai2 = number_format(@$data_perjadin->taksi_kab_kota ,0, ',', '.');
                                    
                                    @endphp
                                @elseif($jenisbiayas->name == 'Uang Harian')
                                    @php
                                    $nilai2 = number_format(@$data_perjadin->uang_harian / @$data_perjadin->lama ,0, ',', '.');
                                    $nilai3 = number_format(@$data_perjadin->uang_harian ,0, ',', '.');
                                    @endphp
                                @elseif($jenisbiayas->name == 'Penginapan')
                                    @php
                                    $nilai2 = number_format(@$data_perjadin->penginapan / @$data_perjadin->lama,0, ',', '.');
                                    $nilai3 = number_format(@$data_perjadin->penginapan,0, ',', '.');
                                    @endphp
                                @elseif($jenisbiayas->name == 'Registrasion Fee')
                                    @php
                                    $nilai2 = number_format(@$data_perjadin->registration ,0, ',', '.');
                                    
                                    @endphp
                                @endif
                            @endif
                                <tr>
                                    <td>{{ $jenisbiayas->name }}</td>
                                    @if($jenisbiayas->flag == 1)
                                        <td>
                                            <input class="form-control input-sm" style="text-align: right;" id="hari{{ $jenisbiayas->id }}" name="hari[{{ $jenisbiayas->id }}]" placeholder="0" type="text" value="@if ($data_perjadin != null){{ $data_perjadin->lama }} @endif">
                                        </td>
                                        <label for="No. Surat Tugas" control-label">
                                        <th>Hari x</th></label>
                                        <td>
                                            <input class="form-control input-sm" style="text-align: right;" id="nilai{{ $jenisbiayas->id }}" name="nilai[{{ $jenisbiayas->id }}]" placeholder="0" type="text" value="@if ($data_perjadin != null){{ $nilai2 }} @endif" >
                                        </td>
                                        <td>
                                            <input class="form-control input-sm jumlah" style="text-align: right;"
                                                   id="jumlah" name="jumlah[{{ $jenisbiayas->id }}]"
                                                   type="text" value="@if ($data_perjadin != null){{ $nilai3 }} @endif"
                                                   readonly>
                                        </td>
                                    @else
                                        <td colspan="3">
                                            <input class="form-control input-sm" style="text-align: right;"
                                                   id="nilai{{ $jenisbiayas->id }}" name="nilai[{{ $jenisbiayas->id }}]"
                                                   placeholder="0" type="text" value="@if ($data_perjadin != null){{ $nilai2 }} @endif">
                                        </td>
                                        <td>
                                            <input class="form-control input-sm jumlah" style="text-align: right;"
                                               id="jumlah" name="jumlah[{{ $jenisbiayas->id }}]"
                                               type="text" value="@if ($data_perjadin != null){{ $nilai2 }} @endif" readonly>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-right"
                                    colspan="4">@lang('backend/pengajuan.kegiatan.submodule.detail_akun.tables.total')</th>
                                <th><input class="form-control input-sm" style="text-align: right;" id="total2"
                                           name="total2" placeholder="0" value="{{ $data_perjadin != null ? number_format($data_perjadin->pesawat + $data_perjadin->taksi_provinsi + $data_perjadin->taksi_kab_kota + $data_perjadin->uang_harian + $data_perjadin->penginapan + $data_perjadin->registration ,0, ',', '.') : '' }}" type="text" readonly></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm pull-left"
                            data-dismiss="modal"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.cancel')</button>
                    <button type="submit"
                            class="btn bg-light-blue btn-sm"><i class="fa fa-plus"></i> @lang('backend/_globals.buttons.create')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function(){
            @foreach($jenisbiaya as $key => $jenisbiayas)
            
                $('#nilai{{ $jenisbiayas->id }}').keyup(function(){
                    if (/\D/g.test(this.value))
                    {
                        this.value = this.value.replace(/\D/g, '');
                    }

                    $('#nilai{{ $jenisbiayas->id }}').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));


                    // if ($('#nilai{{ $jenisbiayas->id }}').val() < 0) {
                    //     alert('Masukan tidak sesuai.');
                    //     $('#nilai{{ $jenisbiayas->id }}').val('0');
                    // }

                    var nilai = parseFloat($(this).val().replace(/\./g, '')) || 0;
                    var jumlah = parseFloat($(this).val().replace(/\./g, '')) || 0;

                    @if($jenisbiayas->flag == 1)
                        var hari = parseFloat($('#hari{{ $jenisbiayas->id }}').val().replace(/\./g, '')) || 0;
                        jumlah = (jumlah ? hari * nilai : "");
                    @endif

                    $('[name="jumlah[{{ $jenisbiayas->id }}]"]').val(jumlah.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                    var total = 0;
                    $('.jumlah').each(function(){
                        jumlah = $(this).val().replace(/\./g, '');
                        total += +jumlah;
                    });
                    $('#total2').val(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                });

                $('#hari{{ $jenisbiayas->id }}').keyup(function(){
                    if (/\D/g.test(this.value))
                    {
                        this.value = this.value.replace(/\D/g, '');
                    }

                    $('#hari{{ $jenisbiayas->id }}').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                    if ($('#hari{{ $jenisbiayas->id }}').val() < 0) {
                        alert('Masukan tidak sesuai.');
                        $('#hari{{ $jenisbiayas->id }}').val('0');
                    }

                    var hari = parseFloat($(this).val().replace(/\./g, '')) || 0;
                    var jumlah = parseFloat($(this).val().replace(/\./g, '')) || 0;
                    var nilai = parseFloat($('#nilai{{ $jenisbiayas->id }}').val().replace(/\./g, '')) || 0;

                    @if($jenisbiayas->flag == 1)
                        jumlah = (jumlah ? hari * nilai  : "");
                    @endif

                    $('[name="jumlah[{{ $jenisbiayas->id }}]"]').val(jumlah.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                    var total = 0;
                    $('.jumlah').each(function(){
                        jumlah = $(this).val().replace(/\./g, '');
                        total += +jumlah;
                    });
                    $('#total2').val(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                });
            @endforeach

            $(document).ready(function() {
                $('#nama_pelaksana').on('change', function() {
                    var id = this.value;
                    var url = "{{ route('pengajuan.perjadin-dalam-negeri.memuat-nip') }}"+'/'+id;
                    $.ajax({
                        type: "Get",
                        url: url,
                        data: {id: id},
                        dataType: 'json',
                        success: function(result) {
                            var uraian_data = result.uraian_data;
                            var $nip = $("#nip");
                            $nip.empty();
                            uraian_data.forEach(function(entry) {
                                $nip.val(entry.nip);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            }); 

        });
    </script>
@stop