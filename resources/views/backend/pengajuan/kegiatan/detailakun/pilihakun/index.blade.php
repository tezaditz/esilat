<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/22/2017
 * Time: 04:35 PM
 */
?>
@extends('backend.pengajuan.kegiatan.detailakun.pilihakun.base')

@section('title', trans('backend/pengajuan.kegiatan.submodule.pilih_akun.index.title'), @parent)

@section('actions')
    <a href="{{ route('pengajuan.kegiatan.detail-akun', $kegiatan_id) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
@endsection

@section('pilih-akun')
    <div class="row">
        <div class="col-xs-12">
            @include('backend._inc.alerts')
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">@yield('title')</h3>

                    <div class="pull-right box-tools">
                        <a href="{{ url()->current() }}" class="btn btn-default btn-flat btn-sm"><i class="fa fa-refresh"></i> </a>|
                        <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-default btn-flat btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <form action="{{ route('pengajuan.kegiatan.detail-akun.list-akun.store', $kegiatan_id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered" style="white-space: nowrap" id="table">
                            <tr>
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.no_mak')</th>
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.uraian')</th>
                                <!-- <th colspan="2">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.vol')</th>
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.hargasat')</th> -->
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.pagu')</th>
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.realisai')</th>
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.sisa_pagu')</th>
                                <!-- {{--<th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.sisa_vol')</th>--}} -->
                                <!-- <th colspan="2">@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.vol')</th> -->
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.hrg_pengajuan')</th>
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.total')</th>
                                <th>@lang('backend/pengajuan.kegiatan.submodule.pilih_akun.tables.sisa_anggaran')</th>
                                <th></th>

                            </tr>
                            @foreach($pilihakuns as $key => $pilihakun)
                                @if($pilihakun->level == 7)
                                    <tr class="bg-green color-palette">
                                @elseif($pilihakun->level == 11)
                                    <tr class="bg-yellow color-palette">
                                @elseif($pilihakun->header)
                                    <tr class="bg-light-blue color-palette">
                                @else
                                    <tr>
                                @endif
                                        <td>{{ $pilihakun->kode }}</td>
                                        <td>{{ $pilihakun->uraian }}</td>
                                        <!-- @if($pilihakun->hargasat > 0)
                                            <td class="text-right">{{ $pilihakun->vol }}</td>
                                        @else
                                            <td></td>
                                        @endif -->
                                        <!-- <td>
                                            {{ $pilihakun->sat }}
                                            <input type="hidden" name="sat[{{ $pilihakun->id }}]" value="{{ $pilihakun->sat }}">
                                        </td> -->
                                        <!-- @if($pilihakun->hargasat > 0)
                                            <td class="text-right">{{ number_format($pilihakun->hargasat, 0, ',', '.') }}</td>
                                            <td class="text-right">{{ number_format($pilihakun->hargasat * $pilihakun->vol, 0, ',', '.') }}</td> -->
                                        <!-- @else -->
                                            <!-- <td></td> -->
                                        @if($pilihakun->level == 11)
                                            <td class="text-right">{{ number_format(($pilihakun->rkakl->jumlah)), 0, ',', '.'  }}</td>
                                        @endif
                                        <!-- @endif -->
                                        @if($pilihakun->header)
                                            <td colspan="2"></td>
                                        @else
                                            @if($pilihakun->level == 11)
                                                <td class="text-right">{{ number_format($pilihakun->rkakl->realisasi + $pilihakun->rkakl->realisasi_2 + $pilihakun->rkakl->realisasi_3, 0, ',', '.') }}</td>
                                                <td class="text-right">{{ number_format($pilihakun->jumlah - ($pilihakun->rkakl->realisasi + $pilihakun->rkakl->realisasi_2 + $pilihakun->rkakl->realisasi_3), 0, ',', '.') }}</td>
                                            @else
                                                <td ></td>
                                                <td ></td>
                                            @endif
                                        @endif
                                        {{--<td class="text-center">--}}
                                            {{--@if($pilihakun->level == 11)--}}
                                                {{--{{ $pilihakun->vol - ($pilihakun->vol_pengajuan + $pilihakun->vol_2 + $pilihakun->vol_3) }}--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        @if($pilihakun->level == 11)
                                            <!-- <td>
                                                @if($pilihakun->vol - ($pilihakun->vol_pengajuan + $pilihakun->vol_2 + $pilihakun->vol_3) > 0)
                                                    <input class="form-control input-sm" style="text-align: right; width: 60px" id="satvol{{ $pilihakun->id }}" name="satvol[{{ $pilihakun->id }}]" placeholder="0" min="1"  type="number" onfocus="this.select();" onmouseup="return false;" readonly>
                                                @else
                                                    <input class="form-control input-sm" style="text-align: right; width: 60px" id="satvol{{ $pilihakun->id }}" name="satvol[{{ $pilihakun->id }}]" placeholder="0" min="1" type="number" onfocus="this.select();" onmouseup="return false;" readonly>
                                                @endif
                                            </td> -->
                                            <!-- <td>{{ $pilihakun->sat }}</td> -->
                                            <td>
                                                @if($pilihakun->vol - ( $pilihakun->vol_pengajuan + $pilihakun->vol_2 + $pilihakun->vol_3 ) > 0)
                                                    <input class="form-control input-sm" style="text-align: right; width: 110px;" id="hargasat{{ $pilihakun->id }}" name="hargasat[{{ $pilihakun->id }}]" type="text" onfocus="this.select();" onmouseup="return false;" readonly placeholder="0">
                                                @else
                                                    <input class="form-control input-sm" style="text-align: right; width: 110px;" id="hargasat{{ $pilihakun->id }}" name="hargasat[{{ $pilihakun->id }}]" type="text" onfocus="this.select();" onmouseup="return false;" readonly placeholder="0">
                                                @endif
                                            </td>
                                            <td><input class="form-control input-sm" style="text-align: right; width: 110px;" id="jumlah{{ $pilihakun->id }}" name="jumlah[{{ $pilihakun->id }}]" placeholder="0" type="text" readonly></td>
                                            <td><input class="form-control input-sm" style="text-align: right; width: 110px;" id="sisa_anggaran{{ $pilihakun->id }}" name="sisa_anggaran[{{ $pilihakun->id }}]" placeholder="0" type="text" readonly></td>
                                        @else
                                            <!-- <td></td>
                                            <td></td> -->
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                        <td>
                                            @if($pilihakun->level == 11)
                                                
                                                    
                                                        <input type="hidden" name="rkakl_id[{{ $pilihakun->id }}]" value="{{ $pilihakun->rkakl_id }}">
                                                        
                                                        <input type="checkbox" id="checkbox{{ $pilihakun->id }}" name="checkbox[{{ $pilihakun->id }}]" value="{{ $pilihakun->rkakl_id }}">
                                                        
                                                    
                                               
                                            @endif
                                        </td>
                                    </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        @yield('actions')
                        <button type="submit" class='btn bg-light-blue btn-flat btn-sm pull-right'><i class="fa fa-save"></i> @lang('backend/_globals.buttons.create')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent

    <script type="text/javascript">
        $(document).ready(function(){
            @foreach($pilihakuns as $key => $pilihakun)
                $('#checkbox{{ $pilihakun->id }}').change(function(){
                    if($('#checkbox{{ $pilihakun->id }}:checked').length) {
                        $('[name="satvol[{{ $pilihakun->id }}]"]').attr('readonly',false);
                        $('[name="hargasat[{{ $pilihakun->id }}]"]').attr('readonly',false);
                        // $('[name="satvol[{{ $pilihakun->id }}]"]').val('1');
                        $('[name="hargasat[{{ $pilihakun->id }}]"]').val('{{ number_format($pilihakun->hargasat ,0, ',', '.') }}');
                        {{--$('[name="hargasat[{{ $pilihakun->id }}]"]').val('0');--}}
                        $('[name="jumlah[{{ $pilihakun->id }}]"]').val('{{ number_format($pilihakun->hargasat ,0, ',', '.') }}');
                        // $('[name="sisa_anggaran[{{ $pilihakun->id }}]"]').val('{{ number_format(($pilihakun->hargasat))}}');

                        $('[name="sisa_anggaran[{{ $pilihakun->id }}]"]').val('{{ number_format($pilihakun->jumlah - ($pilihakun->rkakl->realisasi + $pilihakun->rkakl->realisasi_2 + $pilihakun->rkakl->realisasi_3) - $pilihakun->hargasat , 0, ',', '.') }}');

                        // $('[name="sisa_anggaran[{{ $pilihakun->id }}]"]').val('{{ number_format(($pilihakun->jumlah - ($pilihakun->realisasi + $pilihakun->realisasi_2 + $pilihakun->realisasi_3)) - $pilihakun->hargasat ,0, ',', '.') }}');
                    } else {
                        $('[name="satvol[{{ $pilihakun->id }}]"]').attr('readonly',true);
                        $('[name="hargasat[{{ $pilihakun->id }}]"]').attr('readonly',true);
                        // $('[name="satvol[{{ $pilihakun->id }}]"]').val('0');
                        $('[name="hargasat[{{ $pilihakun->id }}]"]').val('0');
                        $('[name="jumlah[{{ $pilihakun->id }}]"]').val('0');
                        $('[name="sisa_anggaran[{{ $pilihakun->id }}]"]').val('0');
                    }
                });

                $('#satvol{{ $pilihakun->id }}').keyup(function(){
                    var jumlah = parseFloat($(this).val());
                    var sisa_anggaran = parseFloat($(this).val());
                    var hargasat = parseFloat($('#hargasat{{ $pilihakun->id }}').val().replace(/\D/g, ''));
                    jumlah = (jumlah ? hargasat * jumlah : "0");
                    sisa_anggaran = (sisa_anggaran ? {{ $pilihakun->jumlah - $pilihakun->rkakl->realisasi_3 }} - jumlah : "0");

                    $('#jumlah{{ $pilihakun->id }}').val(jumlah.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                    $('#sisa_anggaran{{ $pilihakun->id }}').val(sisa_anggaran.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                    // if ($('#satvol{{ $pilihakun->id }}').val() > {{ $pilihakun->vol }} || jumlah > {{ $pilihakun->jumlah - $pilihakun->rkakl->realisasi_3 }}) {
                    //     alert('Volume tidak sesuai, silahkan masukin ulang.');
                    //     $('#satvol{{ $pilihakun->id }}').val('1');
                    // }
                });

                $('#hargasat{{ $pilihakun->id }}').keyup(function(){
                    if (/\D/g.test(this.value))
                    {
                        this.value = this.value.replace(/\D/g, '');
                    }

                    var hargasat = parseFloat($(this).val().replace(/\./g, ''));

                    // var volume = parseFloat($('#satvol{{ $pilihakun->id }}').val());
                    var jumlah = parseFloat($(this).val().replace(/\./g, ''));
                    jumlah = (jumlah ?  hargasat : "0"); //volume *
                    var sisa_anggaran = parseFloat($(this).val().replace(/\./g, ''));
                    sisa_anggaran = (sisa_anggaran ? {{ $pilihakun->jumlah - $pilihakun->rkakl->realisasi_3 }} - jumlah : "0");

                    if (hargasat > {{ $pilihakun->jumlah - $pilihakun->rkakl->realisasi_3 }} || jumlah > {{ $pilihakun->jumlah - $pilihakun->rkakl->realisasi_3 }}) {
                        alert('Pengajuan tidak sesuai, silahkan masukin ulang.');
                        $('#hargasat{{ $pilihakun->id }}').val('0');
                    }

                    $('#hargasat{{ $pilihakun->id }}').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                    $('#jumlah{{ $pilihakun->id }}').val(jumlah.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                    $('#sisa_anggaran{{ $pilihakun->id }}').val(sisa_anggaran.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                });
            @endforeach
        });
    </script>
@stop