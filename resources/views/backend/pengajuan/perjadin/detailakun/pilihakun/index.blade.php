<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/22/2017
 * Time: 04:35 PM
 */
?>
@extends('backend.pengajuan.perjadin.detailakun.pilihakun.base')

@section('title', trans('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.index.title'), @parent)

@section('actions')
    <a href="{{ route('pengajuan.perjadin-dalam-negeri.detail-akun', $perjadin_id) }}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-arrow-left"></i> @lang('backend/_globals.buttons.back')</a>
@endsection

@section('pilih-akun-perjadin')
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
                <form action="{{ route('pengajuan.perjadin-dalam-negeri.detail-akun.list-akun.store', $perjadin_id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered" style="white-space: nowrap" id="table">
                            <tr>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.no_mak')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.uraian')</th>
                                <th colspan="2">@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.vol')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.hargasat')</th>

                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.jumlah')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.realisai')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.sisa_pagu')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.vol2')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.hrg_pengajuan')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.total')</th>
                                <th>@lang('backend/pertanggungjawaban.perjadin.submodule.pilih_akun.tables.sisa_anggaran')</th>
                                <th></th>
                            </tr>
                            @foreach($rkakls as $key => $rkakl)
                                @if($rkakl->level == 11)
                                    <tr class="bg-yellow color-palette">
                                @elseif($rkakl->level == 7)
                                    <tr class="bg-green color-palette">
                                @elseif($rkakl->header == 1)
                                    <tr class="bg-blue color-palette">
                                @elseif($rkakl->header == 2)
                                    <tr class="bg-light-blue color-palette">
                                @else
                                    <tr>
                                @endif
                                        <td>{{ $rkakl->kode }}</td>
                                        <td>{{ $rkakl->uraian }}</td>
                                        @if($rkakl->vol - ($rkakl->vol_pengajuan + $rkakl->vol_2 + $rkakl->vol_3) > 0)
                                            <td class="text-center">{{ $rkakl->vol - ($rkakl->vol_pengajuan + $rkakl->vol_2 + $rkakl->vol_3) }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td class="text-center">{{ $rkakl->sat }}</td>
                                        @if($rkakl->hargasat > 0)
                                            <td class="text-right">{{ number_format($rkakl->hargasat, 0, ',', '.') }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td class="text-right">{{ number_format($rkakl->jumlah, 0, ',', '.') }}</td>
                                        <td class="text-right">{{ number_format($rkakl->realisai_3, 0, ',', '.') }}</td>
                                        <td class="text-right">{{ number_format($rkakl->jumlah - ($rkakl->realisasi_3), 0, ',', '.') }}</td>
                                        @if($rkakl->level == 0)
                                            @if($rkakl->header == 0)
                                                <td>
                                                    @if($rkakl->vol - ($rkakl->vol_pengajuan + $rkakl->vol_2 + $rkakl->vol_3) > 0)
                                                        <input class="form-control input-sm" style="text-align: right; width: 100%" id="satvol{{ $rkakl->id }}" name="satvol[{{ $rkakl->id }}]" placeholder="0" min="1" max="{{ $rkakl->vol - ($rkakl->vol_pengajuan + $rkakl->vol_2 + $rkakl->vol_3) }}" type="number" onfocus="this.select();" onmouseup="return false;" readonly>
                                                    @else
                                                        <input class="form-control input-sm" style="text-align: right; width: 100%" id="satvol{{ $rkakl->id }}" name="satvol[{{ $rkakl->id }}]" placeholder="0" min="1" max="{{ $rkakl->vol - ($rkakl->vol_pengajuan + $rkakl->vol_2 + $rkakl->vol_3) }}" type="number" onfocus="this.select();" onmouseup="return false;" readonly>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($rkakl->vol - ( $rkakl->vol_pengajuan + $rkakl->vol_2 + $rkakl->vol_3 ) > 0)
                                                        <input class="form-control input-sm" style="text-align: right; width: 110px;" id="nilai_pengajuan{{ $rkakl->id }}" name="nilai_pengajuan[{{ $rkakl->id }}]" type="text" onfocus="this.select();" onmouseup="return false;" readonly placeholder="0">
                                                    @else
                                                        <input class="form-control input-sm" style="text-align: right; width: 110px;" id="nilai_pengajuan{{ $rkakl->id }}" name="nilai_pengajuan[{{ $rkakl->id }}]" type="text" onfocus="this.select();" onmouseup="return false;" readonly placeholder="0">
                                                    @endif
                                                </td>
                                                <td>
                                                    <input class="form-control input-sm" style="text-align: right; width: 110px;" id="jumlah_pengajuan{{ $rkakl->id }}" name="jumlah_pengajuan[{{ $rkakl->id }}]" placeholder="0" type="text" readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control input-sm" style="text-align: right; width: 110px;" id="sisa_anggaran{{ $rkakl->id }}" name="sisa_anggaran[{{ $rkakl->id }}]" placeholder="0" type="text" readonly>
                                                </td>
                                                <td>
                                                    @if($rkakl->jumlah - ($rkakl->realisasi + $rkakl->realisasi_2 + $rkakl->realisasi_3) != 0 and $rkakl->vol - ($rkakl->vol_pengajuan + $rkakl->vol_2 + $rkakl->vol_3) > 0)
                                                        <input type="hidden" name="rkakl_id[{{ $rkakl->id }}]" value="{{ $rkakl->id }}">
                                                        <input type="checkbox" id="checkbox{{ $rkakl->id }}" name="checkbox[{{ $rkakl->id }}]" value="{{ $rkakl->id }}">
                                                    @endif
                                                </td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
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
        $(document).ready(function () {
            @foreach($rkakls as $key => $rkakl)
            $('#checkbox{{ $rkakl->id }}').change(function () {
                if ($('#checkbox{{ $rkakl->id }}:checked').length) {
                    $('[name="satvol[{{ $rkakl->id }}]"]').attr('readonly', false);
                    $('[name="satvol[{{ $rkakl->id }}]"]').val('1');
                    $('[name="satvol[{{ $rkakl->id }}]"]').focus();
                    $('[name="nilai_pengajuan[{{ $rkakl->id }}]"]').attr('readonly', false);
                    $('[name="nilai_pengajuan[{{ $rkakl->id }}]"]').val('{{ number_format($rkakl->hargasat, 0, ',', '.') }}');
                    $('[name="jumlah_pengajuan[{{ $rkakl->id }}]"]').val('{{ number_format($rkakl->hargasat, 0, ',', '.') }}');
                    $('[name="sisa_anggaran[{{ $rkakl->id }}]"]').val('{{ number_format(($rkakl->jumlah - ($rkakl->realisasi_3)) - $rkakl->hargasat, 0, ',', '.') }}');
                } else {
                    $('[name="satvol[{{ $rkakl->id }}]"]').attr('readonly', true);
                    $('[name="satvol[{{ $rkakl->id }}]"]').val('0');
                    $('[name="nilai_pengajuan[{{ $rkakl->id }}]"]').val('0');
                    $('[name="nilai_pengajuan[{{ $rkakl->id }}]"]').val('0').attr('readonly', true);
                    $('[name="jumlah_pengajuan[{{ $rkakl->id }}]"]').val('0');
                    $('[name="sisa_anggaran[{{ $rkakl->id }}]"]').val('0');
                }
            });

            $('#satvol{{ $rkakl->id }}').keyup(function () {
                var jumlah = parseFloat($(this).val());
                var sisa_anggaran = parseFloat($(this).val());
                var hargasat = parseFloat($('#nilai_pengajuan{{ $rkakl->id }}').val().replace(/\D/g, ''));
                jumlah = (jumlah ? hargasat * jumlah : "0");
                sisa_anggaran = (sisa_anggaran ? {{ $rkakl->jumlah - ($rkakl->realisasi + $rkakl->realisasi_2 + $rkakl->realisasi_3) }} -jumlah : "0");

                $('#jumlah_pengajuan{{ $rkakl->id }}').val(jumlah.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                $('#sisa_anggaran{{ $rkakl->id }}').val(sisa_anggaran.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

                if ($('#satvol{{ $rkakl->id }}').val() > {{ $rkakl->vol }} || jumlah > {{ $rkakl->jumlah - $rkakl->realisasi_3 }}) {
                    alert('Volume tidak sesuai, silahkan masukin ulang.');
                    $('#satvol{{ $rkakl->id }}').val('1');
                }
            });

            $('#nilai_pengajuan{{ $rkakl->id }}').keyup(function () {
                if (/\D/g.test(this.value)) {
                    this.value = this.value.replace(/\D/g, '');
                }

                var hargasat = parseFloat($(this).val().replace(/\./g, ''));

                var volume = parseFloat($('#satvol{{ $rkakl->id }}').val());
                var jumlah = parseFloat($(this).val().replace(/\./g, ''));
                jumlah = (jumlah ? volume * hargasat : "0");
                var sisa_anggaran = parseFloat($(this).val().replace(/\./g, ''));
                sisa_anggaran = (sisa_anggaran ? {{ ($rkakl->jumlah - $rkakl->realisasi_3) }} -jumlah : "0");

                if (hargasat > {{ $rkakl->jumlah - $rkakl->realisasi_3 }} || jumlah > {{ $rkakl->jumlah - $rkakl->realisasi_3 }}) {
                    alert('Pengajuan tidak sesuai, silahkan masukin ulang.');
                    $('#nilai_pengajuan{{ $rkakl->id }}').val('0');
                }

                $('#nilai_pengajuan{{ $rkakl->id }}').val($(this).val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                $('#jumlah_pengajuan{{ $rkakl->id }}').val(jumlah.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
                $('#sisa_anggaran{{ $rkakl->id }}').val(sisa_anggaran.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
            });
            @endforeach
        });
    </script>
@stop